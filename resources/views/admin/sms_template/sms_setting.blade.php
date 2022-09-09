@extends('include.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
         <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options ">
											 <button type="button" data-target="#tesSMSModal" data-toggle="modal" class="btn btn-success btn-sm  pull-right">Send Test SMS</button>
										</div>
									</div>
	           <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th>Short Code</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <th>@{{number}}</th>
                            <td>Number</td>
                        </tr>
                        <tr>
                            <th>@{{message}}</th>
                            <td>Message</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="card-title font-weight-normal pull-left text-white">{{ $page_title }}</h4>

            </div>
            <form action="{{ route('admin.sms-template.global') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>SMS API <span class="text-danger">*</span></label>
                            <input type="string" class="form-control" placeholder="SMS API Configuration" name="smsapi" value="{{ $general_setting->smsapi }}" required/>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div></div></div></div></div>
{{-- TEST MAIL MODAL --}}
<div id="tesSMSModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.email-template.sendTestSMS') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Sent to <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile number">
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
</div>
@endsection
