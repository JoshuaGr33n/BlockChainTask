@extends('include.user')

@section('content')

<!-- App-content opened -->
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Referral URL </h3>
                                        </div>
                                        <div class="card-body p-5">
                                            <div class="memberblock mb-0">
                                                <div class="row ">
                                                    <p class="lead">{{URL::to('/register').'/'.Auth::user()->username}}</p>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<!-- row opened -->
							<div class="row">
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Recently Referred</h3>
										</div>
										<div class="card-body p-5">
											<div class="memberblock mb-0">
												<div class="row ">
												 @if(count($follower) >0)
                                                @foreach($follower as $k=>$data)
													<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 pl-1 pr-1 mb-5 mb-xl-0">
														<a href="" class="member"><img src="{{ get_image(config('constants.user.profile.path') .'/'. $data->image) }}" alt="">
															<div class="memmbername">{{$data->username}}</div>
														</a>
													</div>
												@endforeach

                            @else
                                <tr>
                                    <td colspan="4"> @lang('No Referral Log Found')!</td>
                                </tr>
                            @endif

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- row closed -->


						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Referral Commission</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													 <tr>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Commission Via')</th>
                                <th scope="col">@lang('Description')</th>

                                <th scope="col">@lang('Level Commission')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('After Balance')</th>
                            </tr>
												</thead>
												<tbody>
                                                @foreach($trans as $k=>$data)
													<tr @if($data->amount < 0) style="background-color: #e4afaf" @endif>
                                    <td data-label="@lang('Date')">{{date('d M, Y h:i:s A', strtotime($data->created_at))}}</td>
                                    <td data-label="@lang('Commission Via')"><strong>{{$data->bywho->username}}</strong></td>
                                    <td data-label="@lang('Description')">{{__($data->title)}}</td>
                                    <td data-label="@lang('Level Commission')">{{__($data->level)}}</td>
                                    <td data-label="@lang('Amount')">{{__($general->cur_sym)}} {{formatter_money($data->amount)}}</td>
                                    <td data-label="@lang('After Balance')">{{__($general->cur_sym)}} {{formatter_money($data->main_amo)}}</td>
                                </tr>
												  @endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- App-content closed -->
			</div>

@stop

@section('script')
    <script>
        function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if(alertStatus == '1'){
                iziToast.success({message:"Copied: "+copyText.value, position: "topRight"});
            }else if(alertStatus == '2'){
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
@endsection
