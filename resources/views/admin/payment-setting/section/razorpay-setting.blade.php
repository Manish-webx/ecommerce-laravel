<div class="tab-pane fade" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.razorpay-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="form-group">
                        <label>Razorpay Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{$razorpay->status == '1' ? 'selected' : ''}} value="1">Enable</option>   
                            <option {{$razorpay->status == '0' ? 'selected' : ''}} value="0">Disable</option>                            
                        </select>
                    </div>                    
                   
                    <div class="form-group">
                        <label>Country Name</label>
                        <select name="country_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.country_list') as $country)
                               <option {{$country == $razorpay->country_name ? 'selected' : ''}}  value="{{$country}}">{{$country}}</option>
                            @endforeach
                            
                        </select>
                    </div> 
                    <style>
                        .select2-container{
                            display: block !important;
                            width: 100% !important;
                        }
                    </style>
                    <div class="form-group">
                        <label>Currency Name</label>
                        <select name="currency_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.currency') as $key => $currency)
                               <option  {{$currency == $razorpay->currency_name ? 'selected' : ''}}  value="{{$currency}}">{{$key}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Currency Rate(Per USD)</label>
                      <input type="text" class="form-control" name="currency_rate" value="{{ $razorpay->currency_rate}}">
                    </div>
                    <div class="form-group">
                      <label>Razorpay Key</label>
                      <input type="text" class="form-control" name="razorpay_key" value="{{ $razorpay->razorpay_key}}">
                    </div>
                    <div class="form-group">
                      <label>Razorpay Secret Key</label>
                      <input type="text" class="form-control" name="razorpay_secret_key" value="{{ $razorpay->razorpay_secret_key}}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>