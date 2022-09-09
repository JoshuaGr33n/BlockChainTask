@extends('include.admin')

@section('content')

<!-- row opened -->
						<div class="row">
							<div class="col-xs-12 col-lg-12 col-xl-12">
								<div class="card">
									<div class="section-title center-block text-center mt-6">
										<h3>Vault Plans</h3>
										<p>Click on the button below to create a new Vault Plan</p>
									</div>
									<div class="pricing-tabs">
										<div class=" text-center">
											<div class="pri-tabs-heading">
												<ul class="nav nav-price">
													<li><a class="active show"  href="{{route('admin.plan-create')}}" >Create New Plan</a></li>
												</ul>
											</div>
											<div class="tab-content">
												<div class="tab-pane active show pb-0" id="year" >
													<div class="row">
														 @foreach($plan as $data)
														<div class="col-sm-12 col-lg-6 col-xl-4">
															<div class="card overflow-hidden mb-0">
																<div class="text-center pricing pricing1">
																	<div class="card-category bg-primary">{{$data->name}}</div>
																	<div class="display-3 my-4">{{$data->interest}} @if($data->interest_status == 1)
                                                    % @else {{$general->cur_text}} @endif</div>
																	<ul class="list-unstyled leading-loose">
																		<li><i class="fa fa-check mr-2 text-primary"></i>Yield every {{$data->times}} Hours
                                        </li>
																		<li><i class="fa fa-check mr-2 text-primary"></i><strong>Tenure</strong> @if($data->lifetime_status == 0) {{$data->repeat_time}} Times @endif</li>
                                                                        @if($data->capital_back_status == 1)
																		<li><i class="fa fa-check mr-2 text-primary"></i>
																		 @elseif($data->capital_back_status == 0)
																		<li><i class="fa fa-close mr-2 text-danger"></i>
																		@endif

																		<strong>Capital Back</strong> </li>
																		@if($data->fixed_amount == 0)
																		<li><i class="fa fa-check mr-2 text-primary"></i><strong>Amount</strong> {{$general->cur_sym}} {{$data->maximum}}</li>
																		@else
																		<li><i class="fa fa-check mr-2 text-primary"></i><strong>Min</strong> {{$general->cur_sym}} {{$data->minimum}}</li>
																		<li><i class="fa fa-check mr-2 text-primary"></i><strong>Max</strong> {{$general->cur_sym}} {{$data->maximum}}</li>
																	    @endif
																	    </ul>
																	<div class="text-center m-4">
																		<a href="{{route('admin.plan-edit',$data->id)}}" class="btn btn-primary btn-block">Edit Plan</a>
																	</div>
																</div>
															</div>
														</div>
														@endforeach

													</div>
												</div>

											</div>
											 {{ $plan->links() }}
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
