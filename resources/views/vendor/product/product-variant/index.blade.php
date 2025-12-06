@extends('vendor.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Variant</h1>
      <h3></h3>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="card-header-action" style="text-align: right">
                <a href="{{ route('vendor.products-variant.create', ['product' => request()->product])}}" class="btn btn-primary">
                    + Create Variant
                  </a>
                  <a href="{{ route('vendor.products.index')}}" class="btn btn-info">
                    Back
                  </a>
              </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
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
    
              url : "{{ route('vendor.products-variant.change-status') }}",
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

