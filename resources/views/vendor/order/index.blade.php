@extends('vendor.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>All Orders</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">            
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


@endpush

