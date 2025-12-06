@extends('admin.layouts.master')

@php
    $data = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp


@section('content')

<section class="section">
    <div class="section-header">
      <h1>All Order</h1>
    
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Order #{{$order->invoice_id}}</div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-md-6">
                                <address>
                                <strong>Billed To:</strong><br>
                                    <b>Name : </b>{{$data->name}}<br>
                                    <b>Email : </b>{{$data->email}}<br>
                                    <b>Phone : </b>{{$data->phone}}<br>
                                    <b>Address : </b>{{$data->address}}<br>
                                    {{$data->city}}<br>
                                    {{$data->state}}, {{$data->zip}}, {{$data->country}}
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                <strong>Shipped To:</strong><br>
                                <b>Name : </b>{{$data->name}}<br>
                                    <b>Email : </b>{{$data->email}}<br>
                                    <b>Phone : </b>{{$data->phone}}<br>
                                    <b>Address : </b>{{$data->address}}<br>
                                    {{$data->city}}<br>
                                    {{$data->state}}, {{$data->zip}}, {{$data->country}}
                                </address>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <address>
                                <strong>Payment Information:</strong><br>
                                <b>Method: </b>{{$order->payment_method}}<br>
                                <b>Transaction ID: </b>{{$order->transaction->transaction_id}}<br>
                                <b>Status: </b>{{$order->payment_status == '1' ? 'Completed' :'Pending'}}<br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                <strong>Order Date:</strong><br>
                                {{date('d F, Y', strtotime($order->created_at))}}<br><br>
                                </address>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Product</th>
                                    <th>Vendor Name</th>
                                    <th>Variants</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Totals</th>
                                </tr>
                                @foreach ($order->orderProduct as $product)                            
                                    <tr>
                                        <td>{{++ $loop->index}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->vendor->shop_name}}</td>
                                        <td>
                                            @php
                                                $variants = json_decode($product->variants)
                                            @endphp
                                            @foreach ($variants as $key => $variant )
                                                <b>{{$key}} :</b> {{$variant->name}} ({{$setting->currency_icon}}{{$variant->price}})
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{$setting->currency_icon}}{{ $product->unit_price}}</td>
                                        <td class="text-center">{{ $product->qty}}</td>
                                        <td class="text-right">{{$setting->currency_icon}}{{($product->unit_price*$product->qty) + $product->variant_total}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            </div>
                            <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <lable>Payment Status</lable>
                                            <select class="form-control" id="payment_status" data-id="{{$order->id}}">                                                
                                                    <option {{$order->payment_status === 1 ? 'selected' : ''}} class="form-control" value="1">Completed</option>
                                                    <option {{$order->payment_status === 0 ? 'selected' : ''}} class="form-control" value="0">Pending</option>
                                                                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <lable>Order Status</lable>
                                            <select class="form-control" id="order_status" data-id="{{$order->id}}">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus )
                                                    <option {{$order->order_status === $key ? 'selected' : ''}} class="form-control" value="{{$key}}">{{$orderStatus['status']}}</option>
                                                @endforeach                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">{{$setting->currency_icon}}{{ $order->sub_total}}</div>
                                </div>
                                <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Shipping(+)</div>
                                <div class="invoice-detail-value">{{$setting->currency_icon}}{{ @$shipping->cost}}</div>
                                </div>
                                <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Coupon(-)</div>
                                <div class="invoice-detail-value">{{$setting->currency_icon}}{{ @$coupon->discount ? $coupon->discount : '0'}}</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">{{$setting->currency_icon}}{{ $order->amount}}</div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        
                        <button class="btn btn-warning btn-icon icon-left print-invoice"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>          
          </div>
        </div>
      </div>
  </section>


@endsection

@push('scripts')

<script>

 $(document).ready(function(){

    $('#order_status').on('change', function(){

        let id = $(this).data('id');  
        let status = $(this).val();
        
        $.ajax({
            method : 'GET',
            url : "{{route('admin.order.status')}}",
            data : {
                status: status,
                id: id
            },
            success: function(data){
                if(data.status === 'success'){
                    toastr.success(data.message);
                }
            },
            error: function(xhr, status, error){
                console.log(error);
            }
        })
    })

    $('#payment_status').on('change', function(){

        let id = $(this).data('id');  
        let status = $(this).val();
        
        $.ajax({
            method : 'GET',
            url : "{{route('admin.order.payment.status')}}",
            data : {
                status: status,
                id: id
            },
            success: function(data){
                if(data.status === 'success'){
                    toastr.success(data.message);
                }
            },
            error: function(xhr, status, error){
                console.log(error);
            }

        })

    })


    $('.print-invoice').on('click', function(){
        let printBody = $('.invoice-print');
        let originalPrint = $('body').html();

        $('body').html(printBody.html());
        window.print();
        $('body').html(originalPrint);
    })

 })

</script>
    
@endpush

