@extends('frontend.dashboard.layouts.master')

@php
    $user = json_decode($order->order_address)
@endphp


@section('content')

<section class="section">
    <div class="section-header">
      <h1>Order Details</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">            
            
            <div class="container">
            <div class="wsus__invoice_area invoice-print">
                <div class="wsus__invoice_header">
                    <div class="wsus__invoice_content">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    <h5>Invoice To</h5>
                                    <h6>{{$user->name}}</h6>
                                    <p>{{$user->email}}</p>
                                    <p>{{$user->phone}}</p>
                                    <p>{{$user->city}}, {{$user->state}},  {{$user->zip}}<br>{{$user->country}}</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>shipping information</h5>
                                    <h6>{{$user->name}}</h6>
                                    <p>{{$user->email}}</p>
                                    <p>{{$user->phone}}</p>
                                    <p>{{$user->city}}, {{$user->state}},  {{$user->zip}}<br>{{$user->country}}</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>Order ID:  #{{$order->invoice_id}}</h5>
                                    <h6>Order Status: {{config('order_status.order_status_admin')[$order->order_status]['status']}}</h6>
                                    <p>Payment Method: {{$order->payment_method}}</p>
                                    <p>Payment Status: {{$order->payment_status}}</p>
                                    <p>Transaction ID: {{$order->transaction->transaction_id}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>                                  

                                    <th class="name">
                                        product
                                    </th>

                                    <th class="amount">
                                        Vendor
                                    </th>

                                    <th class="amount">
                                        amount
                                    </th>

                                    <th class="quentity">
                                        quentity
                                    </th>
                                    <th class="total">
                                        total
                                    </th>
                                </tr>
                                @foreach ($order->orderProduct as $product)                                   
                                        <tr>
                                            

                                            <td class="name">
                                                <p>{{$product->product_name}}</p>
                                                @php
                                                    $variants = json_decode($product->variants);
                                                    
                                                    $total = 0; 
                                                    $total += $product->unit_price * $product->qty
                                                @endphp
                                                @foreach ($variants as $key => $variant)
                                                    <span>{{$key}} : {{$variant->name}}, {{$setting->currency_icon}}{{$variant->price}}</span>

                                                @endforeach
                                               
                                            </td>

                                            <td>
                                                  {{$product->vendor->shop_name}}
                                            </td>
                                            <td class="amount">
                                               {{$setting->currency_icon}}{{$product->unit_price}}
                                            </td>

                                            <td class="quentity">
                                                {{$product->unit_price}}
                                            </td>
                                            <td class="total">
                                               {{$setting->currency_icon}} {{$product->unit_price * $product->qty}}
                                            </td>
                                        </tr>                                        
                                     
                                 @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">                    
                    <p><span>Total Amount:</span> {{$setting->currency_icon}}{{$total}} </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-8">
                    <div class="float-end mt-5">
                        <button class="btn btn-warning print-invoice">Print</button>
                    </div>
                </div>
            </div>
        </div>
            
          </div>
        </div>
      </div>
  </section>


@endsection

@push('scripts')

<script>

 $('.print-invoice').on('click', function(){
        let printBody = $('.invoice-print');
        let originalPrint = $('body').html();

        $('body').html(printBody.html());
        window.print();
        $('body').html(originalPrint);
    })



</script>
    
@endpush



