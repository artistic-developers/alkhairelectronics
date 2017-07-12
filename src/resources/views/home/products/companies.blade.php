@extends('layouts.app')
@section('title')
Companies
@endsection
@section('breadcrumb')
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
            <th>company</th>
            @if(Auth::user()->type == "admin")
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($companies as $company)
          <tr>
            <td><span id="name_{{ $company->company_id }}">{{ $company->company_name }}</span>
            <form method="POST" action="/products/companies/edit/" id="form_{{ $company->company_id }}" style="display: none;">
              {{csrf_field()}}
              <input type="text" name="comp_id" value="{{ $company->company_id }}" class="hidden">
              <input type="text" name="company_name" value="{{ $company->company_name }}" />
              <button type="submit" class="btn waves-light waves-effect">Save</button>
            </form>
          </td>
          @if(Auth::user()->type == "admin")
          <td><a href="#" id="{{ $company->company_id }}" class="edit-comp">edit</a></td>
          @endif
        </tr>
        @empty
        No companies, yet.
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="col s5">
    <div class="form-module">
      <div class=""></div>
      <div class="form">
        <h5>Add company</h5>
        <form action="/products/companies/add" method="POST">
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
            <input id="company" type="text" name="company" required class="validate" />
            <label for="company">company</label>
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
$(".edit-comp").click(function(e)
{
e.preventDefault();
var id = $(this).attr('id');
$("#name_"+id).slideUp();
$("#form_"+id).slideDown();
});
});
</script>
@endsection