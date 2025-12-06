@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Child Category</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Edit Child Category</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.child-category.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{ route('admin.child-category.update', $childcategory->id) }}" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control  main-category" name="category">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                     <option {{ $category->id == $childcategory->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Sub Category</label>
              <select class="form-control sub-category" name="sub_category">
                <option value="">Select Category</option>
                @foreach ($subcategories as $subcategory)
                     <option {{ $subcategory->id == $childcategory->sub_category_id ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $childcategory->name }}">
            </div>
          </div>         
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{  $childcategory->status == '1' ? 'selected' : '' }} value="1">Active</option>
                <option  {{  $childcategory->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
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


@push('scripts')

<script>

    $(document).ready(function(){

      $('body').on('change', '.main-category', function(){
          let id = $(this).val()
          
          $.ajax({

            url:"{{route('admin.get-subcategories')}}",
            method:'GET',
            data:{
                id: id
            },
            success: function(data){
                $('.sub-category').html('<option value="">Select Category</option>')
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

  
@endpush