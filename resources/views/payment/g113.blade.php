@extends('include.user')

@section('content')
  	<!-- row opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">2Checkout</h3>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">


										<div class="">
											<p class="mb-1 mt-5"><span class="font-weight-semibold">Invoice Date : </span> {{date('d-M-Y', strtotime($deposit->created_at))}}</p>
											<p class="mb-1"><span class="font-weight-semibold">OrdDeposit Status : </span>Pending</p>
										</div>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover">
												<tr>
													<th class="text-center "></th>
													<th>Gateway</th>
													<th class="text-center" >Currency</th>
													<th class="text-right" >Charge</th>
													<th class="text-right">Amount</th>
												</tr>
												<tr>
													<td class="text-center">1</td>
													<td>
														<p class="font-w600 mb-1">2Checkout</p>
														<div class="text-muted d-none d-sm-block">Online Payment</div>
													</td>
													<td class="text-center">{{$data->currency}}</td>
													<td class="text-right">{{number_format($deposit->charge,2)}}{{$data->currency}}</td>
													<td class="text-right">{{number_format($data->amount,2)}}{{$data->currency}}</td>
												</tr>

												<tr>
													<td colspan="4" class="font-w600 text-right">Total</td>
													<td class="text-right">{{number_format($data->amount + $deposit->charge,2)}}{{$data->currency}}</td>
												</tr>
												<tr>
													<td colspan="5" class="text-right">
														  <form  id="myCCForm" method="{{$data->method}}" action="{{$data->url}}">
                                            {{csrf_field()}}
                                            <input name="token" type="hidden" value="" />
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label for="cardNumber">@lang('CARD NUMBER')</label>
                                                    <div class="form-group">
                                                        <input id="ccNo" type="text" value="" autocomplete="off" required placeholder="Card Number"/>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mt-4">

                                                <div class="col-md-6">
                                                    <label for="cardNumber">@lang('Expiration Date (MM/YYYY)')</label>
                                                    <div class="form-group">
                                                        <input id="expMonth" type="text" size="2" value="" required placeholder="MM" style="width: 30%"/>
                                                        <span> / </span>
                                                        <input id="expYear" type="text" size="4" value="" placeholder="YYYY" required style="width: 50%"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <label for="cardCVC">@lang('CVC CODE')</label>
                                                    <input id="cvv" type="text" value="" placeholder="CVC" autocomplete="off" required />
                                                </div>

                                                <div class="col-md-12 ">
                                                    <button class="custom-btn  btn-lg btn-block" type="button" id="ssbb"> @lang('PAY NOW')</button>
                                                </div>

                                            </div>

                                        </form>

													</td>
												</tr>
											</table>
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

