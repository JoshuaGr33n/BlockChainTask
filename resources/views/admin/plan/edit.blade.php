@extends('include.admin')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-12">



								<div class="card">
									<div class="card-header">
										<div class="card-title">Update Plan</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
												<div class="card  box-shadow-0">
													<div class="card-header">
														<h4 class="card-title">Update Vault Plan</h4>
													</div>
													<div class="card-body">
														<form method="post" class="form-horizontal" action="{{route('admin.plan-update', $plan->id)}}">
                        @csrf
                        @method('put')

                        <div class="form-body">

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <strong>Plan Name</strong>
                                    <input type="text" class="form-control" name="name" value="{{$plan->name}}" required>
                                </div>




                                <div class="form-group offman col-md-3">
                                    <strong>Minimum Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$plan->minimum}}" name="minimum">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group offman col-md-3" >
                                    <strong>Maximum Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$plan->maximum}}" name="maximum">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group onman col-md-3" style="display: none">
                                    <strong>Fixed Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$plan->fixed_amount}}" name="amount">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">{{$general->cur_sym}}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Time</strong>
                                    <select class="form-control" name="times">
                                        @foreach($time as $data)
                                            <option {{$plan->times == $data->time? 'selected': ''}} value="{{$data->time}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group return col-md-3" style="display: none">
                                    <div class="form-group">
                                        <strong>Return Times</strong>
                                        <input type="text" class="form-control" value="{{$plan->repeat_time}}" name="repeat_time">
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Return /Interest</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="interest"  value="{{$plan->interest}}" required>
                                        <div class="input-group-append" style="height: 45px">
                                            <div class="input-group-text">
                                                <select name="interest_status" class="form-control" style="height: 35px !important;">
                                                    <option {{$plan->interest_status == '1'? 'selected': ''}} value="%">%</option>
                                                    <option {{$plan->interest_status == '0'? 'selected': ''}} value="{{$general->cur_sym}}">{{$general->cur_sym}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                 <div class="form-group col-md-3">
                                    <strong>Fixed Amount</strong>
                                     <label class="custom-switch">
													  <input data-toggle="toggle"  class="custom-switch-input"  id="amount" class="amount" data-onstyle="success"
                                           data-offstyle="info" data-on="Fixed" data-off="Range" data-width="100%" type="checkbox" {{$plan->fixed_amount != 0 ? 'checked': ''}} name="amount_type">
													<span class="custom-switch-indicator"></span>

												</label>


                                </div>




                                <div class="form-group col-md-3" id="capitalBack">
                                    <strong>Capital Back</strong>
                                    <label class="custom-switch">
													  <input data-toggle="toggle"  class="custom-switch-input"  class="amount"data-onstyle="success" {{$plan->capital_back_status == 1? 'checked':''}} data-offstyle="danger"
                                           data-on="Yes" data-off="No" data-width="100%" type="checkbox" name="capital_back_status" >
													<span class="custom-switch-indicator"></span>

												</label>

                                </div>

                                <div class="form-group col-md-3" >
                                    <strong>Status</strong>
                                     <label class="custom-switch">
													  <input data-toggle="toggle"  class="custom-switch-input"  data-onstyle="success" {{$plan->status == 1? 'checked':''}} data-offstyle="danger"
                                           data-on="Active" data-off="Disable" data-width="100%" type="checkbox" name="status" >
													<span class="custom-switch-indicator"></span>

												</label>

                                </div>

                                <div class="form-group col-md-3" >
                                    <strong>Featured</strong>
                                     <label class="custom-switch">
													  <input data-toggle="toggle"  class="custom-switch-input"  data-onstyle="success" {{$plan->featured == 1? 'checked':''}} data-offstyle="danger"
                                           data-on="Yes" data-off="No" data-width="100%" type="checkbox" name="featured" >
													<span class="custom-switch-indicator"></span>

												</label>

                                </div>

                                 <div class="form-group col-md-3">
                                    <strong>Return Interest</strong>
                                      <label class="custom-switch">
													  <input data-toggle="toggle"  class="custom-switch-input"  data-onstyle="success" data-offstyle="danger"
                                           data-on="Times Wise" data-off="Lifetime" data-width="100%" type="checkbox" {{$plan->lifetime_status == 0? 'checked':''}} name="lifetime_status" >
													<span class="custom-switch-indicator"></span>

												</label>


                                </div>




                            </div>

                        </div>

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary btn-block">Update</button>

                        </div>
                    </form>
													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


					</div>
				</div>
				<!-- App-content closed -->
			</div>

@endsection

@section('javascript')
<script>
        $(document).ready(function () {


            $('#amount').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == false)
                {
                    $('.offman').css('display', 'block');
                    $('.onman').css('display', 'none');
                }else {
                    $('.offman').css('display', 'none');
                    $('.onman').css('display', 'block');
                }
            });

            $('#lifetime').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == true)
                {
                    $('.return').css('display', 'block');

                }else {

                    $('.return').css('display', 'none');

                }
            });

        })
    </script>
@endsection
