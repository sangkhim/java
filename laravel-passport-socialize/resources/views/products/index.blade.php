@extends('layouts/app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Products</div>
    <div class="panel-body">    
        @if(count($products) > 0)
            @foreach($products as $product)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width: 100%" src="/storage/product_images/{{$product->product_image}}" />
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/products/{{$product->id}}">{{$product->name}}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$products->links()}}
        @else
            <p>No products found</p>
        @endif
        <div><a href="/products/create" class="btn btn-primary">Create Product</a></div>
    </div>
</div>
@endsection
