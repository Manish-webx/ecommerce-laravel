@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Vendor Profile</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Vendor Profile Update</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.vendor-profile.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.vendor-profile.store') }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                  <label>Preview</label><br>
                  <img src="{{ asset($profile->banner) }}" width="200px">
                </div>
            </div>
          <div class="col-12">
            <div class="form-group">
              <label>Banner</label>
              <input type="file" class="form-control" name="banner">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Shop Name</label>
              <input type="text" class="form-control" name="shop_name" value="{{ $profile->shop_name }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="{{ $profile->email }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" name="address" value="{{ $profile->address }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Description</label>
              <textarea class="summernote" type="text" name="description">{{ $profile->description }}</textarea>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Facebook Link</label>
              <input type="text" class="form-control" name="fb_link" value="{{ $profile->fb_link }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Instagram Link</label>
              <input type="text" class="form-control" name="insta_link" value="{{ $profile->insta_link }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Twitter Link</label>
              <input type="text" class="form-control" name="tw_link" value="{{ $profile->tw_link }}">
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </form>
      
  </section>


@endsection