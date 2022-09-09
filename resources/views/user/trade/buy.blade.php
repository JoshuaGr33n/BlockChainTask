@extends('include.user')

@section('content')

    <!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card bg-dark1">
									<div class="js-conveyor-example">
										<ul class="news-crypto">
										@foreach($currency as $data)
											<li>
												<div>
													<div class="row">
														<div class="d-flex">
															<div class="">
																<img src="{{url('/')}}/back/images/crypto-currencies/regular/{{$data->image}}" class="w-5 h-6 mt-1" alt="icon">
															</div>
															<div class="ml-3">
																<p class="text-white mb-1 fs-12">{{$data->name}}</p>
																<div class="h5 m-0 fs-14 text-warning">$1.00<span class="text-success ml-2"> = {{$general->cur_sym}}{{number_format($data->buy,2)}}</span></div>
															</div>
														</div>
													</div>
												</div>
											</li>
										    @endforeach

										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h3 class="card-title">{{$page_title}}</h3>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form class="contact-form" action="{{route('user.buycoin')}}" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="form-group col-6">
											<script>
function myFunction() {
 var rate = $("#currency option:selected").attr('data-rate');
 var name = $("#currency option:selected").attr('data-name');
 var symbol = $("#currency option:selected").attr('data-symbol');
 var price = $("#currency option:selected").attr('data-price');
 var range = $("#currency option:selected").attr('data-range');
 var amount = $('#usd').val() ;
 var topay = rate*amount
 var toget = amount/price
  document.getElementById("pay").value = "{{$general->cur_sym}}"+topay;
  document.getElementById("address").innerHTML = "Enter "+name+" Address";
  document.getElementById("rate").innerHTML = "1"+symbol+" = $"+price;
  document.getElementById("button").innerHTML = "Buy "+name;
  document.getElementById("get").innerHTML = "You Get "+toget+symbol;
  document.getElementById("range").innerHTML = range;

 };
</script>

<script>
function myFunction2() {
 var balance = $("#wallet option:selected").attr('data-balance');

  document.getElementById("balance").innerHTML = balance;

 };
</script>

												<label class="form-label font-weight-normal fs-14">Choose Currency</label>
												<select name="currency" id="currency" onchange="myFunction()"  class="form-control select2 custom-select" data-placeholder="Bitcoin">
													<option label="Choose one">Select Currency
													</option>
													@foreach($currency as $data)
													<option data-rate="{{$data->buy}}" data-price="{{$data->price}}" data-range="Min: ${{$data->min}} - Max:${{$data->min}}" data-symbol="{{$data->symbol}}" data-name="{{$data->name}}" value="{{$data->id}}">{{$data->name}}</option>
													@endforeach
												</select>
												<h5 id="range" class="text-info"></h5>
											</div>
											<div class="form-group col-6">
												<label class="form-label font-weight-normal fs-14">Payments Method</label>
												<select id="wallet" onchange="myFunction2()"  class="form-control select2 custom-select" name="payment_method" data-placeholder="choose">
													<option label="Choose one">
													</option>
													@foreach($authWallets as $data)
													<option data-balance="Bal: {{$general->cur_sym}}{{number_format($data->balance,2)}}" value="{{$data->type}}">@if($data->type == 'deposit_wallet') Fiat Balance @elseif($data->type == 'interest_wallet') Vault Balance @endif</option>
													@endforeach
												</select>
												<h5 id="balance" class="text-info"></h5>
											</div>
										</div>
										<div class="row">
											<div class="form-group mb-5 fs-14 col-xl-6 col-sm-12">
												<label class="">Amount To Buy (USD)</label>
												<input class="form-control" name="amount"  id="usd" onkeyup="myFunction()" type="number" placeholder="$0.00">
												<h5 id="rate" class="text-info"></h5>
											</div>
											<div class="form-group mb-5 fs-14 col-xl-6 col-sm-12">
												<label class="">You Pay</label>
												<input class="form-control" name="pay" id="pay" readonly type="text" placeholder="0.00">
												<h5 id="get" class="text-info"></h5>
											</div>
										</div>
											<h3 class="form-label font-weight-bold mb-5 fs-14" id="address">Wallet Address</h3>
											<div class="form-group ">
											   <input class="form-control" type="text" name="wallet" placeholder="Enter Wallet">
											</div>
											<div class="text-center">
												<div class="exchange mt-2 mb-2"><i class="fa fa-wallet inline-block"></i></div>
											</div>
											<div class="form-group ">
												<input class="form-control" type="text" name="confirm_wallet" placeholder="Confirm Wallet Address">
											</div>
											<button  style="background-color: {{$general->bclr}}"  class="btn btn-primary btn-block mt-5" type="submit" id="button">Buy Coin</button>
										</form>
									</div>
								</div>
							</div>

						</div>
						<!-- row closed -->

						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Recent Buying Orders </div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table card-table table-striped text-nowrap table-bordered border-top">
												<thead>
													<tr>
														<th>ID</th>
														<th>Type</th>
														<th>Units</th>
														<th>USD</th>
														<th>Paid</th>
														<th>Fund</th>
														<th>Wallet</th>
														<th>Status</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												@foreach($trade as $data)
													<tr>
														<td>#{{$data->trx}}</td>
														<td class="text-success">Buy</td>
														<td> {{number_format($data->getamo,6)}}<a class="cc -alt text-primary">{{App\Currency::whereId($data->currency_id)->first()->symbol ?? ''}}</a></td>
														<td><i class="fa fa-usd text-primary"></i> {{number_format($data->amount,2)}}</td>
														<td>{{$general->cur_sym}} {{number_format($data->main_amo,2)}}</td>
														<td>@if($data->method == 'deposit_wallet') Fiat Balance @elseif($data->method == 'interest_wallet') Vault Balance @endif</td>
														<td>{{$data->wallet}}</td>
														@if($data->status == 0)
														<td><span class="badge badge-warning-light badge-pill">Pending</span></td>
														@elseif($data->status == 1)
														<td><span class="badge badge-success-light badge-pill">Completed</span></td>
														@else
														<td><span class="badge badge-danger-light badge-pill">Declined</span></td>
														@endif
														<td>{{date(' d M, Y ', strtotime($data->created_at))}} {{date('h:i A', strtotime($data->created_at))}}</td>
													</tr>
											  @endforeach


												</tbody>
											</table>
											 @if(count($trade) < 1)
											 <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Hey Boss!</strong>   You dont have any trade at the moment</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>

											  @endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row opened -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@endsection
