@extends('include.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
         <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">            <form action="{{ route('admin.email-template.setting') }}" method="POST">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h6 class="mb-4">Email Send Method</h6>
                            <select name="email_method" class="form-control select2 custom-select" >
                                <option value="php" @if($general_setting->mail_config->name == 'php') selected @endif>PHP Mail</option>
                                <option value="smtp" @if($general_setting->mail_config->name == 'smtp') selected @endif>SMTP</option>
                                <option value="sendgrid" @if($general_setting->mail_config->name == 'sendgrid') selected @endif>SendGrid API</option>
                                <option value="mailjet" @if($general_setting->mail_config->name == 'mailjet') selected @endif>Mailjet API</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 text-right">
                            <h6 class="mb-4">&nbsp;</h6>

                            <button type="button" data-target="#testMailModal" data-toggle="modal" class="btn btn-info">Send Test Mail</button>
                        </div>
                    </div>
                    <div class="form-row mt-4 d-none configForm" id="smtp">
                        <div class="col-md-12">
                            <h6 class="mb-2">SMTP Configuration</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Host <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g. smtp.googlemail.com" name="host" value="{{ $general_setting->mail_config->host ?? '' }}"/>
                        </div>

                        <div class="form-group col-md-2">
                            <label>Port <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Available port" name="port" value="{{ $general_setting->mail_config->port ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Driver</label>
                            <input type="text" class="form-control" placeholder="e.g. smtp" name="driver" value="{{ $general_setting->mail_config->driver ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Encryption</label>
                            <input type="text" class="form-control" placeholder="e.g. ssl" name="enc" value="{{ $general_setting->mail_config->enc ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Normally your email address" name="username" value="{{ $general_setting->mail_config->username ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Normally your email password" name="password" value="{{ $general_setting->mail_config->password ?? '' }}"/>
                        </div>
                    </div>
                    <div class="form-row mt-4 d-none configForm" id="sendgrid">
                        <div class="col-md-12">
                            <h6 class="mb-2">SendGrid API Configuration</h6>
                        </div>
                        <div class="form-group col-md-12">
                            <label>APP KEY <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="SendGrid app key" name="appkey" value="{{ $general_setting->mail_config->appkey ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Sendgrid Sender Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="SendGrid Sender Email" name="sender" value="{{ $general_setting->mail_config->sender ?? '' }}"/>
                        </div>
                    </div>
                    <div class="form-row mt-4 d-none configForm" id="mailjet">
                        <div class="col-md-12">
                            <h6 class="mb-2">Mailjet API Configuration</h6>
                        </div>
                        <div class="form-group col-md-6">
                            <label>API PUBLIC KEY <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mailjet API PUBLIC KEY" name="public_key" value="{{ $general_setting->mail_config->public_key ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>API SECRET KEY <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Mailjet API SECRET KEY" name="secret_key" value="{{ $general_setting->mail_config->secret_key ?? '' }}"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

{{-- TEST MAIL MODAL --}}
<div id="testMailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test Mail Setup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.email-template.sendTestMail') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Sent to <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div></div></div>
@endsection

@section('javascript')
<script>
$('select[name=email_method]').on('change', function() {
    var method = $(this).val();
    $('.configForm').addClass('d-none');
    if(method != 'php') {
        $(`#${method}`).removeClass('d-none');
    }
}).change();

</script>
@endsection
