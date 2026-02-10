@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Footer</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Footer Info</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.footer-info.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.footer-info.update', 1) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <img src="{{ asset($footerInfo->logo) }}" alt="Logo" width="100">
              <label>Logo</label>
              <input type="file" class="form-control" name="logo" value="{{ old('logo') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $footerInfo->phone ?? old('phone') }}">
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $footerInfo->email ?? old('email') }}">
                    </div>
                </div>
            </div>
          </div>         
            <div class="col-12">
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" rows="4">{{ $footerInfo->address }}</textarea>
                </div>
            </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </form>
      
  </section>


@endsection