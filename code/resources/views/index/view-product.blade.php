@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <a href="/" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>

            <h1>{{ $product['name'] }}</h1>

            <p>{{ $product['description'] }}</p>

            <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-gbp"></span> Buy now for £{{ $product['price'] }}!</a>
            <a href="#" class="btn btn-info"><span class="glyphicon glyphicon-tag"></span> {{ $product['quantity'] }} In Stock</a>
        </div>
    </div>
@endsection