@extends('frontend.layouts.master')

@section('title')
  Payment | {{$setting->site_name}}
@endsection

@section('content')

<!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment Success</h4>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>                           
                            <li><a href="javascript:;">payment Success</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
               <div class="row">
                  <div class="col-12">
                       <h2>Payment Successful !</h2>
                  </div>
               </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->


@endsection

