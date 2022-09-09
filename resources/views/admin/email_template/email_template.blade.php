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
                            <th>@{{name}}</th>
                            <td>User Name</td>
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
                <h4 class="card-title font-weight-normal">{{ $page_title }}</h4>
            </div>
            <form action="{{ route('admin.email-template.global') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Email Sent From <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email address" name="efrom" value="{{ $general_setting->efrom }}"  required/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email Body <span class="text-danger">*</span></label>
                            <textarea name="etemp" rows="10" class="form-control nicEdit" placeholder="Your email template">{!! $general_setting->etemp !!}</textarea>
                        </div>
                    </div>
                </div>
                {!! $general_setting->etemp !!}
                <div class="card-footer">
                    <div class="form-group col-md-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div>


@endsection
