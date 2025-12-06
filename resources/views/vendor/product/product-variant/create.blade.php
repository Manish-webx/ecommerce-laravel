@extends('vendor.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Create Variants</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="card-header-action" style="text-align: right">
                <a href="{{ route('vendor.products-variant.index', ['product' => request()->product])}}" class="btn btn-primary">
                    Back
                  </a>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.products-variant.store', ['product' => request()->product]) }}" enctype="multipart/form-data" method="POST"> 
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mt-3">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                      </div>   
                      <input type="hidden" class="form-control" name="product" value="{{ request()->product }}">      
                      <div class="col-12">
                        <div class="form-group mt-3">
                          <label>Status</label>
                          <select class="form-control " name="status" value="{{ old('status') }}">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                      </div>
                    </div>
                  </form>
            </div>            
          </div>
        </div>
      </div>
  </section>


@endsection

