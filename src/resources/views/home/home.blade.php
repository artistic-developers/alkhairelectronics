@extends('layouts.app')

@section('title')
Home - Main Branch
@endsection

@section('content')
<div class="container">
    <div class="row">





        <div class="col s3">
            <div class="collection">
                <a href="/home" class="collection-item active">Home</a>
                @if(Auth::user()->type == "admin")
                <a href="/products/add" class="collection-item">Add Products</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                @endif
            </div>
        </div>



        <div class="col s9">



        </div>




    </div>
</div>
@endsection
