@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Brand</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Update Brand</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.brand.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.brand.update', $brand->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Preview</label><br>
                <img src="{{ asset($brand->logo) }}" width="100px">
            </div>
        </div>
          <div class="col-12">
            <div class="form-group">
              <label>Logo</label><br>
              <input type="file" class="form-control" name="logo">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Is Feature</label>
              <select class="form-control form-control-lg" name="is_featured">
                <option {{ $brand->is_featured == '1' ? 'selected' : ''  }}  value="1">Yes</option>
                <option {{ $brand->is_featured == '0' ? 'selected' : ''  }}  value="0">No</option>
              </select>
            </div>
          </div>       
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{ $brand->status == '1' ? 'selected' : ''  }}  value="1">Active</option>
                <option  {{ $brand->status == '0' ? 'selected' : ''  }}  value="0">Inactive</option>
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