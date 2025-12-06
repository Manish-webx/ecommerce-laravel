@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Flash Sale Product</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Flash Sale End Date</h4>
              
            </div>
            <div class="card-body">
               <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control datepicker" name="end_date" value="{{ @$flashSale->end_date }}">
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                    </div>
                    
                  </div>
               </form>
            </div>            
          </div>
        </div>
      </div>
    </div>

    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Add Flash Sale Product</h4>
                
              </div>
              <div class="card-body">
                <form action="{{route('admin.flash-sale.add-product')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="display: block">Sale End Date</label>
                        <select class="form-control select2" name="product">
                            <option>Select Product</option>
                            @foreach ($products as $product )
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach                           
                            
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label style="display: block">Show at Home?</label>
                          <select class="form-control select2" name="show_at_home">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      
                        <div class="col-md-6">
                          <label style="display: block">Status</label>
                          <select class="form-control select2" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Create</button>
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>All Flash Sale Product</h4>
                
              </div>
              <div class="card-body">
                  {{ $dataTable->table() }}
              </div>
              
            </div>
          </div>
        </div>
      </div>

      
  </section>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}



    <script>

      $(document).ready(function(){
    
        $('body').on('click', '.change-status', function(){   
          
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
    
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');            
          
            $.ajax({
    
              url : "{{ route('admin.flash-sale.change-status') }}",
              method : 'PUT',
              
              data : {
                status : isChecked,
                id : id
              },
    
              success: function(data){
                 toastr.success(data.message);
              },
              error: function(xhr, status, error){
                 console.log(error);
              }   
    
            });
    
        });

        $('body').on('click', '.show-at-home-change-status', function(){   
          
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
    
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');            
          
            $.ajax({
    
              url : "{{ route('admin.flash-sale.show-at-home.change-status') }}",
              method : 'PUT',
              
              data : {
                status : isChecked,
                id : id
              },
    
              success: function(data){
                 toastr.success(data.message);
              },
              error: function(xhr, status, error){
                 console.log(error);
              }   
    
            });
    
        });
    
      });
    
    </script> 
@endpush

