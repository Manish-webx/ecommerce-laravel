@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="">
      <h1 style="display:block">Newsletter Subscribers</h1>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Send Newsletter to All Subscribers</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter.send') }}" method="POST">
                            @csrf
                            <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" required> 
                            </div>
                            <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Newsletter</button>
                        </form>
                    </div>     
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
              <h4>All Newsletter Subscribers</h4>
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


  
@endpush

