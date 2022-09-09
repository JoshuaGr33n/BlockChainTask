@extends('include.admin')

@section('content')<!-- row opened -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="single-productslide">
										<div class="row no-gutter">
											<div class="col-lg-12 col-xl-5 col-md-12 border-right pr-0">
												<div class="product-gallery pt-5 pl-5 pr-5 pb-0">
													<div class="product-slider">
														<div id="carousel2" class="carousel slide" data-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active"> <img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($trade->user_id)->first()->image ?? 'N/A') }}" alt="img"></div>

															</div>
														</div>

													</div>
												</div>
											</div>
											<div class="col-lg-12 col-xl-7 col-md-12">
												<div class="product-gallery-data mb-0">
													<h4 class="mb-3 font-weight-semibold">Buyer: {{App\User::whereId($trade->user_id)->first()->firstname ?? 'N/A'}} {{App\User::whereId($trade->user_id)->first()->lastname ?? 'N/A'}} <small>({{App\User::whereId($trade->user_id)->first()->username ?? 'N/A'}}</small>)</h4>
													<div class="mb-3">
														<span class="font-weight-semibold h5 text-info">Amount: ${{number_format($trade->amount,2)}}</span>
													</div>
													<h6 class="font-weight-semibold">DESCRIPTION</h6>
													<p class="text-muted">This transaction was carried out on {{date(' d M, Y ', strtotime($trade->created_at))}} {{date('h:i A', strtotime($trade->created_at))}}</p>
													<dl class="product-gallery-data1">
														<dt>Currency</dt>
														<dd>{{App\Currency::whereId($trade->currency_id)->first()->symbol ?? 'N/A'}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Amount Paid</dt>
														<dd>{{$general->cur_sym}} {{number_format($trade->main_amo,2)}} </dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Fund Source</dt>
														<dd>@if($trade->method == 'deposit_wallet') Fiat Balance @elseif($trade->method == 'interest_wallet') Vault Balance @endif</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Wallet</dt>
														<dd>{{$trade->wallet}}</dd>
													</dl>
													<div class="product-gallery-rats">
														<ul class="product-gallery-rating">
															<li>
															@if($trade->status == 1)
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
															@elseif($trade->status == 0)
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
															@endif
															</li>
														</ul>


													</div>
													@if($trade->status == 0)
													<a href="{{ route('admin.approve.buy', $trade->trx) }}" class="btn btn-primary mt-1"><i class="fa fa-check"></i>  Approve </a>
													<a href="{{ route('admin.decline.buy', $trade->trx) }}" class="btn btn-secondary mt-1"> <i class="fa fa-close"></i> Decline</a>
													@elseif($trade->status == 1)
                                                    <a href="#" class="btn btn-success mt-1">Order Approved</a>
													@elseif($trade->status == 2)
													<a href="#" class="btn btn-secondary mt-1">Order Declined</a>
                                                    @endif

												</div>
											</div>
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
