@extends('include.user')
@section('content')
  	<!-- row opened -->


						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Stripe Credit/Debit Card</h3>
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
														<p class="font-w600 mb-1">Stripe</p>
														<div class="text-muted d-none d-sm-block">Online Payment</div>
													</td>
													<td class="text-center">{{$deposit->currency}}</td>
													<td class="text-right">{{number_format($deposit->charge,2)}}{{$deposit->currency}}</td>
													<td class="text-right">{{number_format($deposit->amount,2)}}{{$deposit->currency}}</td>
												</tr>

												<tr>
													<td colspan="4" class="font-w600 text-right">Total</td>
													<td class="text-right">{{number_format($deposit->amount + $deposit->charge,2)}}{{$deposit->currency}}</td>
												</tr>
												<tr>
													<td colspan="5" class="text-right">



													</td>
												</tr>
											</table>
										</div>

										 <form role="form" id="payment-form" method="{{$data->method}}" action="{{$data->url}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$data->track}}" name="track">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">@lang('CARD NAME')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg custom-input" name="name" placeholder="Card Name" autocomplete="off" autofocus/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user text-info"></i></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="cardNumber">@lang('CARD NUMBER')</label>
                                <div class="input-group">
															<input type="tel" class="form-control form-control-lg custom-input" name="cardNumber" placeholder="Valid Card Number" autocomplete="off" required autofocus >
															<span class="input-group-append">
																<button class="btn btn-info" type="button"><i class="fa fa-cc-visa"></i> &nbsp; <i class="fa fa-cc-amex"></i> &nbsp;
																<i class="fa fa-cc-mastercard"></i></button>
															</span>
														</div>

                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="cardExpiry">@lang('EXPIRATION DATE')</label>
                                <input type="tel" class="form-control form-control-lg input-sz custom-input" name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required />
                            </div>
                            <div class="col-md-6 ">

                                <label for="cardCVC">@lang('CVC CODE')</label>
                                <input type="tel" class="form-control form-control-lg input-sz custom-input" name="cardCVC" placeholder="CVC" autocomplete="off" required />
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary custom-sbtn btn-lg btn-block" type="submit"> @lang('PAY NOW')
                        </button>

                    </form>

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

@section('js')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@stop

