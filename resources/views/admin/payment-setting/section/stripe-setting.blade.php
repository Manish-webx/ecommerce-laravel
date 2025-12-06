<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.stripe-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="form-group">
                        <label>Stripe Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{$stripe->status == '1' ? 'selected' : ''}} value="1">Enable</option>   
                            <option {{$stripe->status == '0' ? 'selected' : ''}} value="0">Disable</option>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Account Mode</label>
                        <select name="mode" id="" class="form-control">
                            <option {{$stripe->mode == '0' ? 'selected' : ''}}  value="0">Sandbox</option>   
                            <option {{$stripe->mode == '1' ? 'selected' : ''}}  value="1">Live</option>                            
                        </select>
                    </div>                     
                   
                    <div class="form-group">
                        <label>Country Name</label>
                        <select name="country_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.country_list') as $country)
                               <option {{$country == $stripe->country_name ? 'selected' : ''}}  value="{{$country}}">{{$country}}</option>
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
                               <option  {{$currency == $stripe->currency_name ? 'selected' : ''}}  value="{{$currency}}">{{$key}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Currency Rate(Per USD)</label>
                      <input type="text" class="form-control" name="currency_rate" value="{{ $stripe->currency_rate}}">
                    </div>

                    <div class="form-group">
                      <label>Stripe Client ID</label>
                      <input type="text" class="form-control" name="client_id" value="{{ $stripe->client_id}}">
                    </div>
                    <div class="form-group">
                      <label>Stripe Secret Key</label>
                      <input type="text" class="form-control" name="secret_key" value="{{ $stripe->secret_key}}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>