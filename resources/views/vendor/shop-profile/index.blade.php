@extends('vendor.layouts.master')


@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-12">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Shop Profile</h4>
                
                  <div class="row">
                    <form action="{{ route('vendor.shop-profile.store') }}" enctype="multipart/form-data" method="POST"> 
                      @csrf
                      <div class="row">
                          <div class="col-12">
                              <div class="wsus-input mt-3">
                                <label>Preview</label><br>
                                <img src="{{ asset($profile->banner) }}" width="200px">
                              </div>
                          </div>
                        <div class="col-12">
                          <div class="form-group wsus-input  mt-3">
                            <label>Banner</label>
                            <input type="file" class="form-control" name="banner">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Shop Name</label>
                            <input type="text" class="form-control" name="shop_name" value="{{ $profile->shop_name }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $profile->email }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $profile->address }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="wsus__input mt-3">
                            <label>Description</label>
                            <textarea class="summernote form-control" type="text" name="description" style="width:100%;">{{ $profile->description }}</textarea>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Facebook Link</label>
                            <input type="text" class="form-control" name="fb_link" value="{{ $profile->fb_link }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Instagram Link</label>
                            <input type="text" class="form-control" name="insta_link" value="{{ $profile->insta_link }}">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group wsus__input mt-3">
                            <label>Twitter Link</label>
                            <input type="text" class="form-control" name="tw_link" value="{{ $profile->tw_link }}">
                          </div>
                        </div>
                        <div class="col-12 mt-3">
                          <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                      </div>
                    </form>
                  </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection