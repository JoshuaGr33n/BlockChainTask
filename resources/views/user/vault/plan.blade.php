@extends('include.user')

@section('content')


						<!-- row opened -->
						<div class="row">
						@foreach($plans as $k => $data)
                    @php
                        $time_name = \App\TimeSetting::where('time', $data->times)->first();
                    @endphp

							<div class="col-md-4 col-lg-4">
								<div class="card text-center overflow-hidden">
									<div class="card-status bg-danger"></div>
									<div class="ribbon ribbon-top-left text-danger"><span  style="background-color: {{$general->bclr}}" >{{$data->name ?? ""}}</span></div>
									<div class="card-header text-center mx-auto">
										<h3 class="card-title font-weight-bold">{{$data->name ?? ""}}</h3>
									</div>
									<div class="card-body">
										<h1 class="pricing-card-title mb-5">{{__($data->interest ?? "")}} @if($data->interest_status == 1) % @else {{__($general->cur_text)}} @endif<small class="text-muted fs-20"> /
										{{__($time_name->name ?? "")}}
										</small></h1>

										<ul class="list-unstyled leading-loose">
																		<li><i class="fa fa-check mr-2 text-success"></i><strong>Duration </strong> @if($data->lifetime_status == 0) {{__($data->repeat_time)}} {{__($time_name->slug ?? "")}} @else @lang('Lifetime') @endif</li>
																		<li><i class="fa fa-check mr-2 text-success"></i><strong>Minimum</strong> {{__($general->cur_sym)}}{{__($data->minimum)}}</li>
																		<li><i class="fa fa-check mr-2 text-success"></i><strong>Maximum</strong> {{__($general->cur_sym)}}{{__($data->maximum)}}</li>
																		 @if($data->capital_back_status == 1)
                                                                        <li><i class="fa fa-check mr-2 text-success"></i><strong>Capital Back</strong> Yes</li>
                                                                            @elseif($data->capital_back_status == 0)
                                                                        <li><i class="fa fa-close mr-2 text-danger"></i><strong>Capital Back</strong> No</li>
                                                                        @endif

																		<li><i class="fa fa-check mr-2 text-success"></i><strong>24/7</strong> Support</li>
																	</ul>
										<button role="button" data-toggle="collapse"
												  href="#collapseExample{{$data->id}}" aria-expanded="false"
												  aria-controls="collapseExample{{$data->id}}" type="button"  style="background-color: {{$general->bclr}}"class="btn btn-primary">Select Plan</button>
									    <div class="collapse shosw" id="collapseExample{{$data->id}}">
												<div class="well">
												<form action="{{route('user.buy.plan')}}" method="post">
                    @csrf
                    <div class="modal-body">
                    You are about to Vault your Fiat in {{$data->name}} Vault Plan. Please select your Fiat Wallet and enter amount to vault below and click on the Go button to proceed

                        <div class="form-group">
                                <h3 class="text-center investAmountRenge"></h3>

                                <p class="text-center interestDetails"></p>
                                <p class="text-center interestValidaty"></p>
                                <input type="hidden" value="{{$data->id}}" name="plan_id" class="plan_id">

                                <div class="form-group">
                                    <strong>@lang('Select Wallet')</strong>
                                    <select class="form-control"  name="wallet_type">
                                        @foreach($wallets as $k=>$data)
                                        <option value="{{$data->id}}"> {{__(str_replace('_',' ',$data->type))}} ({{formatter_money($data->balance)}} {{__($general->currency)}})</option>
                                        @endforeach
                                    </select>
                                </div>


                            <div class="input-group">
														<input type="number" name="amount" class="form-control" placeholder="0.00" value="{{old('amount')}}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
														@auth
														<span class="input-group-append">
															<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-primary" type="button">Go!</button>
														</span>
														@endif
													</div>


                        </div>
                    </div>

                </form>
												</div>
										</div>

									</div>
								</div>
							</div>






					  @endforeach

						</div>
						<!-- row closed -->


					</div>
				</div>
				<!-- App-content closed -->
			</div>



@endsection
