<?php

/**
 * @SWG\Tag(
 *   name="product",
 *   description="Product",
 * )
 */

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProductRestController extends Controller
{
    /**
     * @SWG\Get(
     *   tags={"product"},
     *   path="/api/products",
     *   summary="Get all products (pagination)",
     *   operationId="getProducts",
     *   @SWG\Response(response=200, description="Successful operation"),
     *   @SWG\Response(response=401, description="Unauthorized"),
     *   @SWG\Response(response=500, description="I nternal server error")
     * )
     */
    public function index()
    {
        return Product::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * @SWG\Get(
     *   tags={"product"},
     *   path="/api/products/{id}",
     *   summary="Get product by ID",
     *   operationId="getProductById",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the product to show",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Successful operation"),
     *   @SWG\Response(response=401, description="Unauthorized"),
     *   @SWG\Response(response=404, description="Product not found"),
     *   @SWG\Response(response=500, description="I nternal server error")
     * )
     */
    public function show($id)
    {
        // Check if product exists
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json(array(
                'code' => 404,
                'message' => 'Product not found'
            ), 404);
        }

        return response($product, 200);
    }

    /**
     * @SWG\Product(
     *   tags={"product"},
     *   path="/api/products",
     *   summary="Add a new product",
     *   operationId="createProduct",
     *   consumes={"multipart/form-data"},
     *   @SWG\Parameter(
     *     name="cost",
     *     in="formData",
     *     description="Cost",
     *     required=true,
     *     type="number", format="double"
     *   ),
     *   @SWG\Parameter(
     *     name="price",
     *     in="formData",
     *     description="Cost",
     *     required=true,
     *     type="number", format="double"
     *   ),
     *   @SWG\Parameter(
     *     name="product_image",
     *     in="formData",
     *     description="Cover Image",
     *     required=false,
     *     type="file"
     *   ),
     *   @SWG\Response(response=200, description="Successful operation"),
     *   @SWG\Response(response=401, description="Unauthorized"),
     *   @SWG\Response(response=422, description="Unprocessable entity"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     */
    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

        // Handle File Upload
        if ($request->hasFile('product_image')) {
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
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Product
        $product = new Product;
        $product->title = $request->input('title');
        $product->body = $request->input('body');
        $product->user_id = auth()->user()->id;
        $product->product_image = $fileNameToStore;
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * @SWG\Product(
     *   tags={"product"},
     *   path="/api/update-products/{id}",
     *   summary="Update product by ID",
     *   operationId="createProduct",
     *   consumes={"multipart/form-data"},
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the product to update",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cost",
     *     in="formData",
     *     description="Cost",
     *     required=true,
     *     type="number", format="double"
     *   ),
     *   @SWG\Parameter(
     *     name="price",
     *     in="formData",
     *     description="Cost",
     *     required=true,
     *     type="number", format="double"
     *   ),
     *   @SWG\Parameter(
     *     name="product_image",
     *     in="formData",
     *     description="Cover Image",
     *     required=false,
     *     type="file"
     *   ),
     *   @SWG\Response(response=200, description="Successful operation"),
     *   @SWG\Response(response=401, description="Unauthorized"),
     *   @SWG\Response(response=404, description="Product not found"),
     *   @SWG\Response(response=422, description="Unprocessable entity"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     */
    public function update(Request $request, $id)
    {
        // Check if product exists
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json(array(
                'code' => 404,
                'message' => 'Product not found'
            ), 404);
        }

        // validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 422);
        }

        // Handle File Upload
        if ($request->hasFile('product_image')) {
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
        $product->title = $request->input('title');
        $product->body = $request->input('body');
        if ($request->hasFile('product_image')) {
            $product->product_image = $fileNameToStore;
        }
        $product->update();

        return response()->json($product, 200);
    }

    /**
     * @SWG\Delete(
     *   tags={"product"},
     *   path="/api/products/{id}",
     *   summary="Delete product by ID",
     *   operationId="deleteProductById",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the product to delete",
     *     required=true,
     *     type="integer"
     *   ),
     *   security={{"oauth2":{}}},
     *   @SWG\Response(response=200, description="Successful operation"),
     *   @SWG\Response(response=401, description="Unauthorized"),
     *   @SWG\Response(response=404, description="Product not found"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     */
    public function destroy($id)
    {
        // Check if product exists
        $product = Product::find($id);
        if (empty($product)) {
            return response()->json(array(
                'code' => 404,
                'message' => 'Product not found'
            ), 404);
        }

        // Check for correct user
        if (auth()->user()->id !== $product->user_id) {
            return response()->json(array(
                'code' => 401,
                'message' => 'Unauthorized'
            ), 401);
        }

        if ($product->product_image != 'noimage.jpg') {
            // Delete Image
            Storage::delete('public/product_images/' . $product->product_image);
        }

        $product->delete();

        return response()->json(null, 200);
    }

}
