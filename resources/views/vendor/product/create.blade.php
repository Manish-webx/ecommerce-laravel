@extends('vendor.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Create Product</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <div class="card-header-action" style="text-align: right">
                  <a href="{{ route('vendor.products.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('vendor.products.store') }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Thumb Image</label>
              <input type="file" class="form-control" name="image">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group mt-3">
                  <label>Category</label>
                  <select class="form-control main-category" name="category">
                    <option>Select</option>  
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>  
                    @endforeach               
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mt-3">
                  <label>Sub Category</label>
                  <select class="form-control sub-category" name="sub_category">
                    <option>Select</option>                 
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mt-3">
                  <label>Child Category</label>
                  <select class="form-control  child-category" name="child_category">
                    <option>Select</option>                 
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Brand</label>
              <select class="form-control" name="brand" value="{{ old('brand') }}">
                <option>Select</option>
                  @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>  
                  @endforeach   
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3 wsus__input">
              <label>SKU</label>
              <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mt-3 wsus__input">
                  <label>Price</label>
                  <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mt-3 wsus__input">
                  <label>Offer Price</label>
                  <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mt-3 wsus__input">
                  <label>Offer Start Date</label>
                  <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ old('offer_start_date') }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mt-3 wsus__input">
                  <label>Offer End Date</label>
                  <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ old('offer_end_date') }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Stock Quantity</label>
              <input type="text" class="form-control" min="0" name="qty" value="{{ old('qty') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Video Link</label>
              <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group mt-3">
              <label>Short Description</label>
              <textarea class="form-control" name="short_description">{{ old('short_description') }}</textarea>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group mt-3">
              <label>Long Description</label>
              <textarea class="summernote" type="text" name="long_description">{{ old('long_description') }}</textarea>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Product Type</label>
              <select class="form-control" name="product_type">
                <option>Select</option>
                <option value="new_arrival">New Arrival</option>
                <option value="featured">Featured</option>
                <option value="top_product">Top Product</option>
                <option value="best_product">Best Product</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Seo Title</label>
              <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group mt-3">
              <label>Seo Description</label>
              <input type="text" class="form-control" name="seo_description" value="{{ old('seo_description') }}">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group mt-3">
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



@push('scripts')

<script>

    $(document).ready(function(){

      $('body').on('change', '.main-category', function(){
          let id = $(this).val()
          
          $.ajax({

            url:"{{route('vendor.getproduct-subcategories')}}",
            method:'GET',
            data:{
                id: id
            },
            success: function(data){
                $('.sub-category').html('<option value="">Select Sub Category</option>')
                $.each(data, function(i, item){
                    $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                })
            },
            error:function(xhr, status, error){
                console.log(error)
            }             

          })         

      })

    })

</script>

<script>

$(document).ready(function(){

  $('body').on('change', '.sub-category', function(){
      let sub_id = $(this).val()
      
      $.ajax({

        url:"{{route('vendor.getproduct-childcategories')}}",
        method:'GET',
        data:{
            id: sub_id
        },
        success: function(data){
            $('.child-category').html('<option value="">Select Child Category</option>')
            $.each(data, function(i, item){
                $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
            })
        },
        error:function(xhr, status, error){
            console.log(error)
        }             

      })         

  })

})

</script>

  
@endpush