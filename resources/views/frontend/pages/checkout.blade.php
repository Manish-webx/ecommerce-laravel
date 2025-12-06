@extends('frontend.layouts.master')

@section('title')
  Checkout | {{$setting->site_name}}
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
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li><a href="javascript:void">peoduct</a></li>
                            <li><a href="javascript:void">check out</a></li>
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
        CHECK OUT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
           
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                    new address</a></h5>
                            
                            <div class="row">
                                @foreach ($addresses as $address)                                   
                                
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input shipping_address" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault-{{$loop->index}}" data-id="{{$address->id}}">
                                                <label class="form-check-label" for="flexRadioDefault-{{$loop->index}}">
                                                    Select Address
                                                </label>
                                            </div>
                                            <ul>
                                                <li><span>Name :</span> {{$address->name}}</li>
                                                <li><span>Phone :</span> {{$address->phone}}</li>
                                                <li><span>Email :</span> {{$address->email}}</li>
                                                <li><span>Country :</span> {{$address->country}}</li>
                                                <li><span>City :</span> {{$address->city}}</li>
                                                <li><span>Zip Code :</span> {{$address->zip}}</li>
                                                <li><span>Company :</span> {{$address->name}}</li>
                                                <li><span>Address :</span> {{$address->address}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            @foreach ($shipRules as $rule)

                                @if ($rule->type === 'min_cost' && sidebarProductTotal() >= $rule->min_cost)
                                    
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                            value="{{$rule->id}}" data-id="{{$rule->cost}}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{$rule->name}}
                                            <span>({{$setting->currency_icon}}{{$rule->cost}})</span>
                                        </label>
                                    </div>

                                @elseif ($rule->type === 'flat_cost')
                                   
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios2"
                                            value="{{$rule->id}}" data-id="{{$rule->cost}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{$rule->name}}
                                            <span>({{$setting->currency_icon}}{{$rule->cost}})</span>
                                        </label>
                                    </div>

                                @endif                               

                            @endforeach
                            
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{$setting->currency_icon}}{{sidebarProductTotal()}}</span></p>
                                <p>shipping fee(+): <span id="shipping_fee">{{$setting->currency_icon}}0</span></p>
                                <p>Coupon(-): <span>{{$setting->currency_icon}}{{getCartDiscount()}}</span></p>
                                <p><b>total:</b><b> <span id="total_amount" data-id="{{getMainCartTotal()}}">{{$setting->currency_icon}}{{getMainCartTotal()}}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input agree_term" type="checkbox" value="" id="flexCheckChecked3"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>
                            <form action="" id="checkoutForm">                                
                                <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                                <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                            </form>
                            <a href="" id="submitCheckoutForm" class="common_btn">Place Order</a>
                        </div>
                    </div>
                </div>
           
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{route('user.create-address')}}" method="POST">    
                                @csrf                        
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Name *" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Phone *" name="phone" value="{{old('phone')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email *" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="AL">Country / Region *</option>
                                                @foreach (config('settings.country_list') as $country)
                                                    <option {{$country == old('country') ? 'selected' : ''}} value="{{$country}}">{{$country}}</option> 
                                                @endforeach                                                                                      
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="State *" name="state"  value="{{old('state')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Town / City *" name="city"  value="{{old('city')}}">
                                        </div>
                                    </div>                            
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Zip *" name="zip" value="{{old('zip')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Address *" name="address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->



@endsection

@push('scripts')
   <script>
    
   $(document).ready(function(){

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $('input[type="radio"]').prop('checked', false);
       $('#shipping_address_id').val('');
       $('#shipping_method_id').val('');
       $('.shipping_method').on('click', function(){
           $('#shipping_method_id').val($(this).val());
           $('#shipping_fee').text("{{$setting->currency_icon}}"+$(this).data('id'));

           let currentTotal = $('#total_amount').data('id');
           let total_amount = currentTotal + $(this).data('id');
           $('#total_amount').text("{{$setting->currency_icon}}"+total_amount);
       })

       $('.shipping_address').on('click', function(){
           $('#shipping_address_id').val($(this).data('id'));
       })


       $('#submitCheckoutForm').on('click', function(e){
          e.preventDefault();

          if($('#shipping_address_id').val() == ''){
            toastr.error('Shipping address is required')
          }else if($('#shipping_method_id').val() == ''){
            toastr.error('Shipping method is required')
          }else if(!$('.agree_term').prop('checked')){
            toastr.error('You have to agree terms and conditions')
          }else{

            $.ajax({
                url: "{{route('user.submit-checkout')}}",
                method: 'POST',
                data:  $('#checkoutForm').serialize(),
                beforeSend: function(){
                    $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>')
                },
                success: function(data){
                    if(data.status === 'success'){
                        $('#submitCheckoutForm').text('Place Order')
                        window.location.href = data.redirect_url;
                    }
                },
                error: function(data){
                   console.log(data);
                }

            })

          }

          
       })


   })

   </script>

@endpush