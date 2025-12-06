@extends('admin.layouts.master')


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Setting</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">            
            <div class="card">
                <div class="card-header">
                  <h4>JavaScript Behavior</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <div class="list-group" id="list-tab" role="tablist">
                    
                        <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Popular Product Section</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Popular Category Section One</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Popular Category Section Two</a>
                        <a class="list-group-item list-group-item-action" id="list-three-list" data-toggle="list" href="#list-three" role="tab">Popular Category Section Three</a>
                      </div>
                    </div>
                    <div class="col-9">
                      <div class="tab-content" id="nav-tabContent">
                        
                        @include('admin.home-page-setting.sections.popular-category-section')
                        
                        @include('admin.home-page-setting.sections.popular-slider-section-one')
                        
                        @include('admin.home-page-setting.sections.popular-slider-section-two')

                        @include('admin.home-page-setting.sections.popular-slider-section-three')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
  </section>


@endsection

