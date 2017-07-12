@extends('layouts.app')

@section('title')
Products
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
    <div class="col s12">
      
      
      <h5>Showing products {{ count($products) }} out of {{ $products->total() }}</h5>
      <table class="highlight striped bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Retail</th>
            <th>Category</th>
            @if(Auth::user()->type == "admin")
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($products as $product)
          <tr>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ number_format($product->cost_price, 2) }}</td>
            <td>{{ number_format($product->retail_price, 2) }}</td>
            <td>{{ $product->category_name }}</td>
            @if(Auth::user()->type == "admin")
            <td><a class="waves-effect waves-light btn" href="/products/edit/{{ $product->product_id }}">edit</a></td>
            @endif
            @empty
            No products, yet.
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div>
      {{ $products->links() }}
    </div>
  </div>
@endsection
