<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.paypal-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="form-group">
                        <label>Paypal Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{$paypal->status == '1' ? 'selected' : ''}} value="1">Enable</option>   
                            <option {{$paypal->status == '0' ? 'selected' : ''}} value="0">Disable</option>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Account Mode</label>
                        <select name="mode" id="" class="form-control">
                            <option {{$paypal->mode == '0' ? 'selected' : ''}}  value="0">Sandbox</option>   
                            <option {{$paypal->mode == '1' ? 'selected' : ''}}  value="1">Live</option>                            
                        </select>
                    </div>                     
                   
                    <div class="form-group">
                        <label>Country Name</label>
                        <select name="country_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.country_list') as $country)
                               <option {{$country == $paypal->country_name ? 'selected' : ''}}  value="{{$country}}">{{$country}}</option>
                            @endforeach
                            
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Currency Name</label>
                        <select name="currency_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.currency') as $key => $currency)
                               <option  {{$currency == $paypal->currency_name ? 'selected' : ''}}  value="{{$currency}}">{{$key}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Currency Rate(Per USD)</label>
                      <input type="text" class="form-control" name="currency_rate" value="{{ $paypal->currency_rate}}">
                    </div>

                    <div class="form-group">
                      <label>Paypal Client ID</label>
                      <input type="text" class="form-control" name="client_id" value="{{ $paypal->client_id}}">
                    </div>
                    <div class="form-group">
                      <label>Paypal Secret Key</label>
                      <input type="text" class="form-control" name="secret_key" value="{{ $paypal->secret_key}}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>