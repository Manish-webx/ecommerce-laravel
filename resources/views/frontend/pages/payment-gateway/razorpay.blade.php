<div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel"
    aria-labelledby="v-pills-razorpay-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.razorpay.payment') }}" method="POST" >
                @csrf

                @php
                    $razorpaySetting = \App\Models\RazorpaySetting::first();
                    $payableAmount = round(getPayableAmount() * $razorpaySetting->currency_rate, 2);
                @endphp

                <script src="https://checkout.razorpay.com/v1/checkout.js"

                            data-key="{{ $razorpaySetting->razorpay_key }}"
                            data-amount="{{ $payableAmount * 100 }}"
                            data-buttontext="Pay with Razorpay"
                            data-name="test payment"
                            data-description="Rozerpay"
                            data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                            data-prefill.name="{{Auth::user()->name}}"
                            data-prefill.email="{{Auth::user()->email}}"
                            data-theme.color="#ff7529">

                    </script>

                </form>
            </div>
        </div>
    </div>
</div>



@push('scripts')

<script>
    

</script>
    
@endpush