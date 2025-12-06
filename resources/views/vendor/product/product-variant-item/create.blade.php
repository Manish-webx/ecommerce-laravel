@extends('vendor.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Variants Items</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Create Variant Item</h4> 
                <div class="card-header-action">
                  <a href="{{ route('vendor.products-variant-items.index', ['productId' => $product->id, 'variantId' => $variant->id] )}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('vendor.products-variant-items.store') }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Variant Name</label>
              <input type="text" class="form-control" name="variant_name" value="{{ $variant->name }}" readonly>
            </div>
          </div> 
          <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
          <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Item Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('item_name') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Price<code>(set 0 for make it free)</code></label>
              <input type="text" class="form-control" name="price" value="{{ old('price') }}">
            </div>
          </div>    
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Is Default</label>
              <select class="form-control" name="is_default" value="{{ old('is_default') }}">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group  mt-3">
              <label>Status</label>
              <select class="form-control" name="status" value="{{ old('status') }}">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </form>
      
  </section>


@endsection