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
																<div class="h5 m-0 fs-14 text-warning">${{number_format($data->price,2)}}</div>
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
						 @foreach($authWallets as $data)
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">@if($data->type == 'deposit_wallet') Fiat Balance @elseif($data->type == 'interest_wallet') Vault Balance @endif</h6>
										<h3 class="mb-1 font-weight-semibold">{{$general->cur_sym}}{{number_format($data->balance,2)}}<span class="text-success fs-13 ml-2">({{$general->cur_text}})</span></h3>
										<p class="mb-2 mt-3 text-muted">Overview of Balance</p>
										<div class="progress h-1 mb-2">
										@php $percent = $data->balance/$balance*100; @endphp
											<div class="progress-bar bg-primary w-100 " role="progressbar"></div>
										</div>
										<small class="mb-0">Ratio : Total Balance<span class="float-right text-muted">{{number_format($data->balance/$balance*100)}}%</span></small>
									</div>
								</div>
							</div>
						  @endforeach
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Overall Balance</h6>
										<h3 class="mb-1 font-weight-semibold">{{$general->cur_sym}}{{number_format($balance,2)}}<span class="text-success fs-13 ml-2">({{$general->cur_text}})</span></h3>
										<p class="mb-2 mt-3 text-muted">Overview of Total Balance</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-secondary w-100" role="progressbar"></div>
										</div>
										<small class="mb-0">Ratio : Total Balance<span class="float-right text-muted">{{number_format($balance/$balance*100)}}%</span></small>
									</div>
								</div>
							</div>
                        <div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Total Deposit</h6>
										<h3 class="mb-1 font-weight-semibold">{{$general->cur_sym}}{{number_format($totalDeposit,2)}}<span class="text-success fs-13 ml-2">({{$general->cur_text}})</span></h3>
										<p class="mb-2 mt-3 text-muted">Overview of Last month</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-success w-100" role="progressbar"></div>
										</div>
										<small class="mb-0">Ratio : Total Balance<span class="float-right text-muted">{{number_format($totalDeposit/$balance*100)}}%</span></small>
									</div>
								</div>
							</div>
                        <div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Total Withdrawal</h6>
										<h3 class="mb-1 font-weight-semibold">{{$general->cur_sym}}{{number_format($totalWithdraw,2)}}<span class="text-success fs-13 ml-2">({{$general->cur_text}})</span></h3>
										<p class="mb-2 mt-3 text-muted">Overview of Last month</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-secondary w-100" role="progressbar"></div>
										</div>
										<small class="mb-0">Ratio : Total Balance<span class="float-right text-muted">{{number_format($totalWithdraw/$balance*100)}}%</span></small>
									</div>
								</div>
							</div>
                        <div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Total Vault</h6>
										<h3 class="mb-1 font-weight-semibold">{{$general->cur_sym}}{{number_format($totalInvest,2)}}<span class="text-success fs-13 ml-2">({{$general->cur_text}})</span></h3>
										<p class="mb-2 mt-3 text-muted">Overview of Last month</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-secondary w-100" role="progressbar"></div>
										</div>
										<small class="mb-0">Ratio : Total Balance<span class="float-right text-muted">{{number_format($totalInvest/$balance*100)}}%</span></small>
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
