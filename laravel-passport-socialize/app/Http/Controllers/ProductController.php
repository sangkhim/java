<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Illuminate\Support\Facades\Storage;

// for using raw SQL
use DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        // $products = Product::all();
        // $products = Product::orderBy('title', 'asc')->take(1)->get();
        // $products = Product::where('title', 'Product Two')->get();
        // $products = DB::select('SELECT * FROM products');
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('product_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Product
        $product = new Product;
        $product->name = $request->input('name');
        $product->cost = $request->input('cost');
        $product->price = $request->input('price');
        $product->product_image = $fileNameToStore;
        $product->save();

        return redirect('/products')->with('success', 'Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Product::find($id);
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        // Check for correct user
        if(auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized Page');
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'cost' => 'required',
            'price' => 'required'
        ]);

        // Handle File Upload
        if($request->hasFile('product_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        }

        // Update Product
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->cost = $request->input('cost');
        $product->price = $request->input('price');
        if($request->hasFile('product_image')) {
            $product->product_image = $fileNameToStore;
        }
        $product->update();

        return redirect('/products')->with('success', 'Product Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        // Check for correct user
        if(auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized Page');
        }

        if($product->product_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/product_images/' . $product->product_image);
        }
        
        $product->delete();
        return redirect('/products')->with('success', 'Product Removed');
    }

}
