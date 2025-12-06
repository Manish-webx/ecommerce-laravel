<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.general-setting-update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="form-group">
                      <label>Site Name</label>
                      <input type="text" class="form-control" name="site_name" value="{{ $setting->site_name }}">
                    </div>
                    <div class="form-group">
                        <label>Layout</label>
                        <select name="layout" id="" class="form-control" value="{{old('layout')}}">
                            <option {{$setting->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                            <option {{$setting->layout == 'RTL' ? 'selected' : ''}} value="RTL">RTL</option>
                        </select>
                    </div>                  
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" value="{{ $setting->contact_email }}">
                    </div>
                    <div class="form-group">
                        <label>Default Currency Name</label>
                        <select name="currency_name" id="" class="form-control select2">
                            <option>Select</option>
                            @foreach (config('settings.currency') as $currency)
                               <option {{$currency == $setting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
                            @endforeach
                            
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Currency Icon</label>
                        <input class="form-control" name="currency_icon" value="{{ $setting->currency_icon }}">
                    </div>
                    <div class="form-group">
                        <label>Timezone</label>
                        <select name="time_zone" id="" class="form-control select2" value="{{ old('time_zone') }}">
                            <option>Select</option>
                            @foreach (config('settings.time_zone') as $key => $timezone)
                               <option {{$key == $setting->time_zone ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div> 
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>