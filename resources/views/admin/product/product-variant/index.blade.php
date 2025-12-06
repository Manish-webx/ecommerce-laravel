@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header" style="display: block">
        <h1>Product Variant </h1>
        <div class="card-header-action" style='float:inline-end'>
          <a href="{{ route('admin.product.index')}}" class="btn btn-primary float-end">
            Back
          </a>
        </div> 
      </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Product Variants</h4>
              <div class="card-header-action">
                <a href="{{ route('admin.products-variant.create', ['product' => request()->product])}}" class="btn btn-primary">
                  + Create Variant
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

          url : "{{ route('admin.products-variant.change-status') }}",
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