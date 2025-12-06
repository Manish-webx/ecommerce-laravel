@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Slider</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Create Slider</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.slider.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.slider.store') }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Banner Image</label>
              <input type="file" class="form-control" name="banner">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" name="type" value="{{ old('type') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Starting Price</label>
              <input type="text" class="form-control" name="starting_price" value="{{ old('starting_price') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Button Url</label>
              <input type="text" class="form-control" name="btn_url" value="{{ old('btn_url') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Serial</label>
              <input type="text" class="form-control" name="serial" value="{{ old('serial') }}">
            </div>
          </div>
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