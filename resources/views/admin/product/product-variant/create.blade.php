@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Variants</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Create Variant</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.products-variant.index', ['product' => request()->product])}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.products-variant.store', ['product' => request()->product]) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
          </div>   
          <input type="hidden" class="form-control" name="product" value="{{ request()->product }}">      
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status" value="{{ old('status') }}">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </form>
      
  </section>


@endsection