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
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>                           
                            <li><a href="javascript:;">payment</a></li>
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
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal"
                                    aria-selected="true">Paypal</button>
                                <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-stripe" type="button" role="tab" aria-controls="v-pills-stripe"
                                aria-selected="true">Stripe</button>
                                <button class="nav-link common_btn" id="v-pills-razorpay-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-razorpay" type="button" role="tab" aria-controls="v-pills-razorpay"
                                aria-selected="true">Razorpay</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-paypal-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a class="text-center w-100" href="{{route('user.paypal.payment')}}"><button class="common_btn">Pay with Paypal</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('frontend.pages.payment-gateway.stripe')

                            @include('frontend.pages.payment-gateway.razorpay')
                            
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Booking Amount</h5>
                            <p>subtotal: <span>{{$setting->currency_icon}}{{sidebarProductTotal()}}</span></p>
                            <p>shipping fee(+): <span>{{$setting->currency_icon}}{{shippingCharge()}} </span></p>
                            <p>coupon(-): <span>{{$setting->currency_icon}}{{getCartDiscount()}}</span></p>
                            <h6>total <span>{{$setting->currency_icon}}{{getPayableAmount()}}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->


@endsection

