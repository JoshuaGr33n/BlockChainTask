@extends('include.user')

@section('content')
    <div class="">
							<div class="card big-deal onsale">
								<div class="card-body p-4 text-white">
									<div class="row">
										<div class="col-xl-8 col-lg-12 col-md-12">
											<div class="d-sm-flex">
												<img src="{{url('/')}}/back/images/svg/wallet.svg" alt="" class="h-120">
												<div class="ml-4">
													<h3 class="text-uppercase mb-0 mt-1">Amount: {{ formatter_money($data['amount'])  }} {{$data['method_currency']}} </b>
													<p class="mt-2 mb-0">Please make payment to the bank account below and upload a proof of your transaction if applicable. Your wallet will be credited once payment has been confirmed on out server</p>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- Banner closed -->


                    <div class="dashboard-inner-content">

                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 mb-4">

                                <div class="card">



                                    <div class="card-body">
                                        <form action="{{ route('user.manualDeposit.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                @php
                                                    $extra = $data->gateway->extra;
                                                @endphp

                                                <div class="col-md-12">
                                                    <p class="text-center mt-2">@lang('AMOUNT ') <b class="text-success">{{ formatter_money($data['amount'])  }} {{$data['method_currency']}}</b><br> @lang('TOTAL ') <b class="text-success">{{$data['final_amo'] .' '.$data['method_currency'] }}</b> </p>
                                                    <h4 class="text-center mb-4">@lang('Please follow the instruction bellow to make your payment')</h4>

                                                    <p class="my-4">@php echo  $data->gateway->description @endphp</p>
                                                    <p class="text-center mt-3">@lang('Processing Time:') @php echo  $extra->delay @endphp Days</p>

                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group mt-4">
                                                        <label for="a-trans"> {{__($extra->verify_image)}}</label>
                                                        <input type="file" class="form-control" name="verify_image">
                                                    </div>
                                                </div>

                                                @foreach(json_decode($method->parameter) as $input)
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="a-trans">{{__($input)}}</label>
                                                            <input type="text" class="form-control" name="ud[{{str_slug($input) }}]" placeholder="{{ $input }}">
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-success custom-success  btn-block mt-2 text-center">@lang('Pay Now')</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




@endsection

