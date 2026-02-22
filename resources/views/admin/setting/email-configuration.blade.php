 <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.email-setting-update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="{{$emailConfig->mail_mailer}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Host</label>
                              <input type="text" class="form-control" name="host" value="{{$emailConfig->mail_host}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>SMTP Username</label>
                              <input type="text" class="form-control" name="smtp_username" value="{{$emailConfig->mail_username}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>SMTP Password</label>
                              <input type="password" class="form-control" name="smtp_password" value="{{$emailConfig->mail_password}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Mail Port</label>
                              <input type="text" class="form-control" name="mail_port" value="{{$emailConfig->mail_port}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Mail Encryption</label>
                                <select name="mail_encryption" id="" class="form-control">
                                    <option  value="ssl" @selected($emailConfig->mail_encryption == 'ssl')>SSL</option>
                                    <option value="tls" @selected($emailConfig->mail_encryption == 'tls')>TLS</option>
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>