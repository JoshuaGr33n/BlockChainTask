@extends('include.user')

@section('content')
  	<!-- row opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Checkout</h3>
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
														<p class="font-w600 mb-1">Checkout</p>
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
														 <form action="{{$data->url}}" method="{{$data->method}}">
                        <script src="{{$data->checkout_js}}"
                                @foreach($data->val as $key=>$value)
                                data-{{$key}}="{{$value}}"
                                @endforeach >

                        </script>

                        <input type="hidden" custom="{{$data->custom}}" name="hidden">

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

