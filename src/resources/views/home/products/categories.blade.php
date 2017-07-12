@extends('layouts.app')
@section('title')
Categories
@endsection
@section('breadcrumb')
<li>Products   |    </li>
<li>Categories</li>
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
    
    <div class="col s4">
      <table class="highlight striped bordered">
        <thead>
          <tr>
            <th>Category</th>
            @if(Auth::user()->type == "admin")
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $category)
          <tr>
            <td><span id="name_{{ $category->category_id }}">{{ $category->category_name }}</span>
            <form method="POST" action="/products/categories/edit/" id="form_{{ $category->category_id }}" style="display: none;">
              {{csrf_field()}}
              <input type="text" name="cat_id" value="{{ $category->category_id }}" class="hidden">
              <input type="text" name="category_name" value="{{ $category->category_name }}" />
              <button type="submit" class="btn waves-light waves-effect">Save</button>
            </form>
          </td>
          @if(Auth::user()->type == "admin")
          <td><a href="#" id="{{ $category->category_id }}" class="edit-cat">edit</a></td>
          @endif
        </tr>
        @empty
        No categories, yet.
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="col s5">
    <div class="form-module">
      <div class=""></div>
      <div class="form">
        <h5>Add Category</h5>
        <form action="/products/categories/add" method="POST">
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
          {{csrf_field()}}
          <div class="input-field">
            <input id="category" type="text" name="category" required class="validate" />
            <label for="category">Category</label>
          </div>
          <div class="input-field">
            <button type="submit" class="btn waves-effect waves-light" type="submit">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
$(document).ready(function()
{
$(".edit-cat").click(function(e)
{
e.preventDefault();
var id = $(this).attr('id');
$("#name_"+id).slideUp();
$("#form_"+id).slideDown();
});
});
</script>
@endsection