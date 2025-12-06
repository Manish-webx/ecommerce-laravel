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
                <h4>basic information</h4>
                
                  <div class="row">
                    <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-xl-12">
                            <div class="row">
                              <div class="col-xl-3 col-sm-6 col-md-6">
                                  <div class="wsus__dash_pro_img">
                                    <img src="{{ Auth::user()->image ?  asset(Auth::user()->image) :   asset('frontend/images/ts-2.jpg')}}" alt="img" class="img-fluid w-100">
                                    <input type="file" name="image">
                                  </div>
                                </div>
                              <div class="col-xl-12">
                                <div class="wsus__dash_pro_single mt-4">
                                  <i class="fas fa-user-tie"></i>
                                  <input type="text" placeholder="First Name" name="name" value="{{ Auth::user()->name }}">
                                </div>
                              </div>
                              
                              <div class="col-xl-12">
                                <div class="wsus__dash_pro_single">
                                  <i class="fal fa-envelope-open"></i>
                                  <input type="email" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                              </div>
                              
                       
                            </div>
                        </div>
                          
                        <div class="col-xl-12">
                             <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                        </div>
                    </form>
                    


                    <div class="wsus__dash_pass_change mt-2">
                      <form action="{{ route('vendor.profile.password.update') }}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-unlock-alt"></i>
                              <input type="password" placeholder="Current Password" name="current_password">
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-lock-alt"></i>
                              <input type="password" placeholder="New Password" name="password">
                            </div>
                          </div>
                          <div class="col-xl-4">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-lock-alt"></i>
                              <input type="password" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                          </div>
                          <div class="col-xl-12">
                            <button class="common_btn" type="submit">upload</button>
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
    </div>
  </section>


@endsection