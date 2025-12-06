@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Shipping Rule</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Create Shipping Rule</h4> 
                <div class="card-header-action">
                  <a href="{{ route('admin.shipping-rule.index')}}" class="btn btn-primary">
                    Back
                  </a>
                </div>               
              </div>            
          </div>
        </div>        
      </div>
      <form action="{{route('admin.shipping-rule.store')}}" method="POST"> 
        @csrf
        <div class="row">
          
          <div class="col-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
          </div> 
          <div class="col-12">
            <div class="form-group">
              <label>Type</label>
              <select class="form-control form-control-lg cost-type" name="type" value="{{ old('type') }}">
                <option value="flat_cost">Flat Cost</option>
                <option value="min_cost">Minimum Order Amount</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Cost</label>
              <input type="number" class="form-control" name="cost" value="{{ old('cost') }}">
            </div>
          </div> 
          
          <div class="col-12 min-cost d-none">
            <div class="form-group">
              <label>Minimum Cost</label>
              <input type="number" class="form-control" name="min_cost" value="{{ old('min_cost') }}">
            </div>
          </div>  
               
          <div class="col-12">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status" value="{{ old('status') }}">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
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

      $('.cost-type').on('change', function(){
          let cost_type = $(this).val()
          
          if(cost_type != 'min_cost'){
            $('.min-cost').addClass('d-none');
          }else{
            $('.min-cost').removeClass('d-none');
          }

      })

    })

</script>

  
@endpush