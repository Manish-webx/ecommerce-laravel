@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Socials</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Edit Socials</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.footer-socials.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.footer-socials.update', $footerSocial->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Icon</label><br>
              <button class="btn btn-primary" data-icon="{$footerSocial->icon}}" data-arrow-class="btn-primary" data-selected-class="btn-danger"
              data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name', $footerSocial->name ?? '') }}">
            </div>
          </div>  
          <div class="col-12">
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" name="url" value="{{$footerSocial->url}}">
            </div>
          </div>         
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status" value="{{ old('status') }}">
                <option {{$footerSocial->status == 1 ? 'selected' : ''}} value="1">Active</option>
                <option {{$footerSocial->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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