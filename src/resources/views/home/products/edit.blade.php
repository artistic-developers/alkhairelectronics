@extends('layouts.app')
@section('title')
Edit Product
@endsection
@section('breadcrumb')
<li><a href="/products">Products</a><span>|</span></li>
<li>Edit Product</li>
@endsection
@section('content')
<div class="">
  <nav>
    <div class="nav-wrapper">
      <ul class="hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn" href="/products">All Products</a></li>
        <li><a class="waves-effect waves-light btn" href="/products/add">Add Product</a></li>
        <li><a class="waves-effect waves-light btn" href="/products/categories">Add Category</a></li>
        <li><a class="waves-effect waves-light btn" href="/products/companies">Add Company</a></li>
      </ul>
    </div>
  </nav>
  <div class="row">
    <div class="col s9">
      <h1>{{ $product->product_name }}</h1>
      <div class="row">
        <form class="col s12" action="/products/edit" method="POST">
          <input value="{{ $product_id }}" class="hidden" name="product_id" />
          @if ($errors->has('status'))
          <div class="alert alert-danger">
            {{ $errors->first('status') }}
          </div>
          @endif
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          <div class="row">
            {{csrf_field()}}
            <div class="input-field col s12">
              <select name="category">
                <option disabled selected>Choose your option</option>
                @forelse($categories as $category)
                <option value="{{ $category->category_id }}" @if($category->category_id == $product->category_id) selected @endif>{{ $category->category_name }}</option>
                @empty
                <option disabled selected>No categories added</option>
                @endforelse
              </select>
              <label>Category</label>
            </div>
            <div class="input-field col s6">
              <select name="company">
                <option disabled selected>Choose your option</option>
                @forelse($companies as $company)
                <option value="{{ $company->company_id }}" @if($company->company_id == $product->company_id) selected @endif>{{ $company->company_name }}</option>
                @empty
                <option disabled selected>No companies added</option>
                @endforelse
              </select>
              <label>Company</label>
            </div>
            <div class="input-field col s3">
              <input placeholder="" id="code" value="{{ $product->product_code }}" type="text" class="validate" name="product_code">
              <label for="code">Code</label>
            </div>
            <div class="input-field col s3">
              <input placeholder="" id="nick" value="{{ $product->nick }}" type="text" class="validate" name="product_nick">
              <label for="nick">Nick</label>
            </div>
            <div class="input-field col s12">
              <input placeholder="" value="{{ $product->product_name }}" id="name" type="text" class="validate" name="product_name" required>
              <label for="name">Product Name</label>
            </div>
            <div class="input-field col s12">
              <textarea id="textarea1" class="materialize-textarea" name="description">{{ $product->description }}</textarea>
              <label for="textarea1">Description</label>
            </div>
            
            <div class="input-field col s4">
              <input value="{{ $product->quantity }}" placeholder="" id="quantity" type="text" class="validate" name="product_quantity" required>
              <label for="quantity">Quantity</label>
            </div>
            <div class="input-field col s4">
              <input value="{{ $product->color }}" placeholder="" id="color" type="text" class="validate" name="product_color">
              <label for="color">Color</label>
            </div>
            <div class="input-field col s4">
              <input value="{{ $product->model }}" placeholder="" id="model" type="text" class="validate" name="product_model">
              <label for="model">Model</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="" value="{{ $product->cost_price }}" id="cost_price" type="text" class="validate" name="product_cost_price" required>
              <label for="cost_price">Cost Price</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="" value="{{ $product->retail_price }}" id="retail_price" type="text" class="validate" name="product_retail_price" required>
              <label for="retail_price">Retail Price</label>
            </div>
            <div class="input-field col s4">
              <input value="{{ $product->discount }}" placeholder="" id="discount" type="text" class="validate" name="product_discount">
              <label for="discount">Discount</label>
            </div>
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light" type="submit">Save</button>
              
            </div>
            
          </div>
        </form>
      </div>
    </div>
    
  </div>
</div>
@endsection