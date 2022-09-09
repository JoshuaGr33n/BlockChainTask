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
									<div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label>Site Title</label>
                            <input type="text" class="form-control" placeholder="Your Company Title" name="sitename" value="{{ $general_setting->sitename }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Currency</label>
                            <input type="text" class="form-control" placeholder="Your Transaction Currency" name="cur_text" value="{{ $general_setting->cur_text }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Currency Symbol</label>
                            <input type="text" class="form-control" placeholder="Your Currency Symbol" name="cur_sym" value="{{ $general_setting->cur_sym }}" />
                        </div>
                        <div class="form-group col">
                            <label>Email Verification</label>
                            <label class="custom-switch">
                             <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" class="custom-switch-input"  name="ev" @if($general_setting->ev) checked @endif>

                            		<span class="custom-switch-indicator"></span>

												</label>

                        </div>
                        <div class="form-group col">
                        <label class="custom-switch">
                         <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" name="en"  class="custom-switch-input"  @if($general_setting->en) checked @endif>

                            		<span class="custom-switch-indicator"></span>

												</label>
                            <label>Email Notification</label>

                        </div>
                        <div class="form-group col">
                         <label class="custom-switch">
                          <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" class="custom-switch-input" name="sv" @if($general_setting->sv) checked @endif>

                            		<span class="custom-switch-indicator"></span>

												</label>
                            <label>SMS Verification</label>

                        </div>
                        <div class="form-group col">
                             <label class="custom-switch">
                             <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="sn" @if($general_setting->sn) checked @endif>
                            		<span class="custom-switch-indicator"></span>

												</label>
							<label>SMS Notification</label>

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                        <label class="custom-switch">
                        <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="reg" @if($general_setting->reg) checked @endif>
                            		<span class="custom-switch-indicator"></span>

												</label>
                            <label>User Registration</label>

                        </div>


                        <div class="form-group col-md-12">
                            <label>Alert Type</label>
                            <select name="alert" class="form-control select2">
                                <option value="0" @if($general_setting->alert == 0) selected @endif>No Alert</option>
                                <option value="1" @if($general_setting->alert == 1) selected @endif>Toast</option>
                                <option value="2" @if($general_setting->alert == 2) selected @endif>Sweet Alert</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">

                             <label>System Theme Color</label>
                                <input type="color" class="form-control" name="bclr" value="{{ $general_setting->bclr }}" />

                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div></div></div></div>
@endsection

@section('javascript')
<script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>

<script>
    $('.colorPicker').spectrum({
        color: $(this).data('color'),
        change: function (color) {
            $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
        }
    });

    $('.colorCode').on('input', function() {
        var clr = $(this).val();
        $(this).parents('.input-group').find('.colorPicker').spectrum({
            color: clr,
        });
    });
</script>
@endsection
