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
                        @forelse($sms_template->shortcodes as $shortcode => $key)
                        <tr>
                            <th>@php echo "{{". $shortcode ."}}"  @endphp</th>
                            <td>{{ $key }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="100%" class="text-muted text-center">No shortcode available</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="card-title font-weight-normal text-white">{{ $page_title }}</h4>
            </div>
            <form action="{{ route('admin.sms-template.update', $sms_template->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md- 12">
                            <label>Status <span class="text-danger">*</span></label>
                             <label class="custom-switch">
                              <input type="checkbox" id="emailSendStatus" data-height="46px" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" class="custom-switch-input"  data-on="Send SMS" data-off="Don't Send" name="sms_status" @if($sms_template->sms_status) checked @endif>

                            		<span class="custom-switch-indicator"></span>

												</label>


                        </div>
                        <div class="form-group col-md-12">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea name="sms_body" rows="10" class="form-control" placeholder="Your message using shortcodes">{{ $sms_template->sms_body }}</textarea>
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
</div></div></div></div></div></div>
@endsection


