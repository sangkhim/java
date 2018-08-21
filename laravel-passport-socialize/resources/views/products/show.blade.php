@extends('layouts/app')

@section('content')
    <a href="/products" class="btn btn-default">Go Back</a>
    <h1>{{$product->title}}</h1>
    @if($product->product_image != "noimage.jpg")
    <div>
        <img style="width: 100%; margin: 10px 0 20px 0;" src="/storage/product_images/{{$product->product_image}}" />
    </div>
    @endif
    <div>
        {!!$product->body!!}
    </div>
    <small>Written on {{$product->created_at}}</small>
    <hr>
    @if(!@Auth::guest())
        <a href="/products/{{$product->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['ProductController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!! Form::close() !!}
    @endif
@endsection
