@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Coupon</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Update Coupon</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.coupons.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{route('admin.coupons.update', $coupon->id)}}" method="POST"> 
        @csrf
        @method('PUT')
        <div class="row">
          
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $coupon->name }}">
            </div>
          </div> 
          <div class="col-12">
            <div class="form-group">
              <label>Code</label>
              <input type="text" class="form-control" name="code" value="{{ $coupon->code }}">
            </div>
          </div> 
          <div class="col-12">
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control" name="quantity" value="{{ $coupon->quantity }}">
            </div>
          </div> 
          <div class="col-12">
            <div class="form-group">
              <label>Max Use Per Person</label>
              <input type="text" class="form-control" name="max_use" value="{{ $coupon->max_use }}">
            </div>
          </div>  
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Start Date</label>
                  <input type="text" class="form-control datepicker" name="start_date" value="{{ $coupon->start_date }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>End Date</label>
                  <input type="text" class="form-control datepicker" name="end_date" value="{{ $coupon->end_date }}">
                </div>
              </div>
            </div>
          </div> 
          <div class="col-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Discount Type</label>
                  <select class="form-control form-control-lg" name="discount_type">
                    <option {{$coupon->discount_type == 'Percent' ? 'selected' : '' }} value="Percent">Percentage(%)</option>
                    <option {{$coupon->discount_type == 'Amount' ? 'selected' : '' }} value="Amount">Amount ({{$setting->currency_icon}})</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Discount Value</label>
                  <input type="text" class="form-control" name="discount" value="{{ $coupon->discount }}">
                </div>
              </div>
            </div>
          </div>       
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option {{$coupon->status == '1' ? 'selected' : '' }} value="1">Active</option>
                <option {{$coupon->status == '0' ? 'selected' : '' }} value="0">Inactive</option>
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