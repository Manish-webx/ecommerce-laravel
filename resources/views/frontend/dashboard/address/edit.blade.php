@extends('frontend.dashboard.layouts.master')

@section('content')

<div class="wsus__dashboard">
    <div class="row">
        <div class="col-12">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Update address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{route('user.address.update', $address->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" name="name" value="{{$address->name}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>email</label>
                      <input type="email" placeholder="Email" name="email" value="{{$address->email}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone" value="{{$address->phone}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Country <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" name="country">
                          <option>Country</option>
                          @foreach (config('settings.country_list') as $country)
                            <option {{$country == $address->country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                          @endforeach                        
                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>state <b>*</b></label>
                      <input type="text" placeholder="State" name="state" value="{{$address->state}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>city <b>*</b></label>
                      <input type="text" placeholder="city" name="city" value="{{$address->city}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>zip code <b>*</b></label>
                      <input type="text" placeholder="Zip Code" name="zip" value="{{$address->zip}}">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>address type <b>*</b></label>
                      <input type="text" placeholder="Home / Office / others" name="address" value="{{$address->address}}">
                    </div>
                  </div>
                 
                  <div class="col-xl-6">
                    <button type="submit" class="common_btn">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection