@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Sub Category</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Update Sub Category</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.sub-category.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.sub-category.update', $subcategory->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="category">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                     <option  {{ $category->id ==  $subcategory->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $subcategory->name }}">
            </div>
          </div>         
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{ $subcategory->status == '1' ? 'selected' : ''  }} value="1">Active</option>
                <option {{ $subcategory->status == '0' ? 'selected' : ''  }}  value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </form>
      
  </section>


@endsection