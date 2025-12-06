@extends('frontend.dashboard.layouts.master')

@section('content')

<div class="wsus__dashboard">
    <div class="row">
        <div class="col-12">
          <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> address</h3>
            <div class="wsus__dashboard_add">
              <div class="row">
                @foreach ($address as $add)
                <div class="col-xl-6">
                    <div class="wsus__dash_add_single">
                      <h4>Billing Address <span>office</span></h4>
                      <ul>
                        <li><span>name :</span> {{ $add->name }}</li>
                        <li><span>Phone :</span>  {{ $add->phone }}</li>
                        <li><span>email :</span>  {{ $add->email }}</li>
                        <li><span>country :</span>  {{ $add->country }}</li>
                        <li><span>city :</span>  {{ $add->city }}</li>
                        <li><span>zip code :</span>  {{ $add->zip }}</li>
                        <li><span>city :</span>  {{ $add->city }}</li>
                        <li><span>address :</span>  {{ $add->address }}</li>
                      </ul>
                      <div class="wsus__address_btn">
                        <a href="{{route('user.address.edit', $add->id)}}" class="edit"><i class="fal fa-edit"></i> edit</a>
                        <a href="{{route('user.address.destroy', $add->id)}}" class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                      </div>
                    </div>
                  </div>                  
                @endforeach
                
                <div class="col-12">
                  <a href="{{route('user.address.create')}}" class="add_address_btn common_btn"><i class="far fa-plus"></i>
                    add new address</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    
</div>

@endsection