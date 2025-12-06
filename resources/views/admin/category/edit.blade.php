@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Category</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Update Category</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.category.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Icon</label><br>
              <button class="btn btn-primary" data-arrow-class="btn-primary" data-selected-class="btn-danger"
              data-unselected-class="btn-info" data-icon="{{$category->icon}}" role="iconpicker" name="icon"></button>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $category->name }}">
            </div>
          </div>         
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{ $category->status == '1' ? 'selected' : ''  }} value="1">Active</option>
                <option {{ $category->status == '0' ? 'selected' : ''  }}  value="0">Inactive</option>
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