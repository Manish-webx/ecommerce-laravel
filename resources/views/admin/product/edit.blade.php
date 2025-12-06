@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Update Product</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.product.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Preview</label><br>
              <img src="{{ asset($product->thumb_img) }}" width="200"> 
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Thumb Image</label>
              <input type="file" class="form-control" name="image">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $product->name }}">
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control form-control-lg main-category" name="category">
                    <option>Select</option>  
                    @foreach ($categories as $category)
                    <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{ $category->name }}</option>  
                    @endforeach               
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Sub Category</label>
                  <select class="form-control form-control-lg sub-category" name="sub_category">
                    <option>Select</option>  
                    @foreach ($subcategories as $subcategory)
                    <option {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }} value="{{$subcategory->id}}">{{ $subcategory->name }}</option>  
                    @endforeach                  
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Child Category</label>
                  <select class="form-control form-control-lg child-category" name="child_category">
                    <option>Select</option>   
                    @foreach ($childcategories as $childcategory)
                    <option {{ $product->child_category_id == $childcategory->id ? 'selected' : '' }} value="{{$childcategory->id}}">{{ $childcategory->name }}</option>  
                    @endforeach                
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Brand</label>
              <select class="form-control form-control-lg" name="brand">
                <option>Select</option>
                  @foreach ($brands as $brand)
                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>  
                  @endforeach   
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>SKU</label>
              <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Price</label>
                  <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Offer Price</label>
                  <input type="text" class="form-control" name="offer_price" value="{{ $product->offer_price }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Offer Start Date</label>
                  <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ $product->offer_start_date }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Offer End Date</label>
                  <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ $product->offer_end_date }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Stock Quantity</label>
              <input type="text" class="form-control" min="0" name="qty" value="{{ $product->qty }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Video Link</label>
              <input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label>Short Description</label>
              <textarea class="form-control" name="short_description">{{ $product->short_description }}</textarea>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label>Long Description</label>
              <textarea class="summernote" type="text" name="long_description">{{ $product->long_description }}</textarea>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Product Type</label>
              <select class="form-control form-control-lg" name="product_type">
                <option>Select</option>
                <option {{ $product->product_type == "new_arrival" ? 'selected' : '' }} value="new_arrival">New Arrival</option>
                <option {{ $product->product_type == "featured" ? 'selected' : '' }} value="featured">Featured</option>
                <option {{ $product->product_type == "top_product" ? 'selected' : '' }} value="top_product">Top Product</option>
                <option {{ $product->product_type == "best_product" ? 'selected' : '' }} value="best_product">Best Product</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Seo Title</label>
              <input type="text" class="form-control" name="seo_title" value="{{ $product->seo_title }}">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Seo Description</label>
              <input type="text" class="form-control" name="seo_description" value="{{ $product->seo_description }}">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{ $product->status == "1" ? 'selected' : '' }} value="1">Active</option>
                <option {{ $product->status == "0" ? 'selected' : '' }} value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-12">
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
          $('.child-category').html('<option value="">Select Child Category</option>')
          $.ajax({

            url:"{{route('admin.getproduct-subcategories')}}",
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

        url:"{{route('admin.getproduct-childcategories')}}",
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