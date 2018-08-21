@extends('layouts/app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['id' => 'frm', 'action' => 'ProductController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('cost', 'Cost')}}
            {{Form::text('cost', '', ['class' => 'form-control', 'placeholder' => 'Cost'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price'])}}
        </div>
        <div class="form-group">
            {{Form::file('product_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <button id="btn-ajax" class="btn btn-primary">Submit Ajax</button>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#btn-ajax").click(function() {
            var formData = new FormData($("#frm")[0]);
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '/products', // This is the url we gave in the route
                data:formData,
                processData: false,
                contentType: false,
                success: function(response){ // What to do if we succeed
                    console.log(response); 
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

                    alert(jqXHR.responseJSON.message);
                }
            });
        });
    });
</script>

<!--
// send JSON object
data: {
    "_token" : "{{ csrf_token() }}",
    'name' : $("#name").val(),
},
-->
