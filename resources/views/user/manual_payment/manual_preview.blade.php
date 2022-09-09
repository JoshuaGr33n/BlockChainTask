@extends('include.user')

@section('content')

   <div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header ">
										<div class="card-title">Deposit Summery</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row mb-4">
											<div class="col-6"><input class="productcart form-control" type="text" placeholder="Coupon Code"></div>
											<div class="col-6"><a href="#" class="btn btn-primary btn-md">Apply</a></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>Amount</td>
														<td class="text-right">{{formatter_money($data->amount)}} {{$general->cur_text}}</td>
													</tr>
													<tr>
														<td><span>Charges</span></td>
														<td class="text-right text-muted"><span>{{formatter_money($data->charge)}} {{$data->baseCurrency()}}</span></td>
													</tr>
													<tr>
														<td><span>Total</span></td>
														<td><h2 class="price text-right mb-0">{{$data->final_amo}}{{$general->cur_text}}</h2></td>
													</tr>
												</tbody>
											</table>
										</div>
										<form class="text-center">
											<a href="{{route('user.deposit')}}" class="btn btn-secondary float-left mt-2 m-b-20 ">Cancel Deposit</a>
											<a href="{{route('user.manualDeposit.confirm')}}"  style="background-color: {{$general->bclr}}" class="btn btn-success mt-2 float-right">Continue</a>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


        </div>
    </div>
@endsection

