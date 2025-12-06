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
                <h4>Update Slider</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.slider.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.slider.update', $slider->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                  <label>Preview</label><br>
                  <img src="{{ asset($slider->banner) }}" width="100px">
                </div>
            </div>
          <div class="col-12">
            <div class="form-group">
              <label>Banner Image</label>
              <input type="file" class="form-control" name="banner">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Type</label>
              <input type="text" class="form-control" name="type" value="{{ $slider->type }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Starting Price</label>
              <input type="text" class="form-control" name="starting_price" value="{{ $slider->starting_price }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Button Url</label>
              <input type="text" class="form-control" name="btn_url" value="{{ $slider->btn_url }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Serial</label>
              <input type="text" class="form-control" name="serial" value="{{ $slider->serial }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0"  {{ $slider->status == 0 ? 'selected' : '' }}>Inactive</option>
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