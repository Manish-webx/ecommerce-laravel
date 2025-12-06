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
                <a href="{{ route('vendor.products-variant.index', ['product' => $variant->product_id])}}" class="btn btn-primary">
                    Back
                  </a>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('vendor.products-variant.update', $variant->id) }}" enctype="multipart/form-data" method="POST"> 
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mt-3">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="{{ $variant->name }}">
                        </div>
                      </div>   
                      <div class="col-12">
                        <div class="form-group mt-3">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option {{ $variant->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $variant->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                      </div>
                    </div>
                </form>
            </div>            
          </div>
        </div>
      </div>
  </section>


@endsection

