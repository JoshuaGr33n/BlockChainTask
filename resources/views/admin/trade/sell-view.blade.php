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
													<h4 class="mb-3 font-weight-semibold">Seller: {{App\User::whereId($trade->user_id)->first()->firstname ?? 'N/A'}} {{App\User::whereId($trade->user_id)->first()->lastname ?? 'N/A'}} <small>({{App\User::whereId($trade->user_id)->first()->username ?? 'N/A'}}</small>)</h4>
													<div class="mb-6">
														<span class="font-weight-semibold h5 text-info">Amount: ${{number_format($trade->amount,2)}}<br>
														Units: {{$trade->coin_amo}}{{App\Currency::whereId($trade->currency_id)->first()->symbol ?? ''}}
														</span>
													</div>
													<h6 class="font-weight-semibold">DESCRIPTION</h6>
													<p class="text-muted">This transaction was carried out on {{date(' d M, Y ', strtotime($trade->created_at))}} {{date('h:i A', strtotime($trade->created_at))}}</p>
													<dl class="product-gallery-data1">
														<dt>Currency</dt>
														<dd>{{App\Currency::whereId($trade->currency_id)->first()->symbol ?? 'N/A'}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>To Get</dt>
														<dd>{{$general->cur_sym}} {{number_format($trade->main_amo,2)}} <br><b><small>Amount To Credit User</small></b></dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Wallet</dt>
														<dd>{{$trade->coin_wallet}}<br><b><small>{{App\Currency::whereId($trade->currency_id)->first()->name ?? ''}} Wallet Address user paid into</small></b></dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Invoice Id</dt>
														<dd>{{$trade->invoiceid}}</dd>
													</dl>
													<div class="product-gallery-rats">
														<ul class="product-gallery-rating">
															<li>
															@if($trade->status == 2)
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
															@elseif($trade->status == 1)
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
															@endif
															</li>
														</ul>


													</div>
													<a href="{{ route('admin.validate.sell', $trade->trx) }}"  type="button" class="btn btn-info mb-3" ><i class="fa fa-rss"></i> Verify</a>
													@if($trade->status < 2)
													<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-approve"><i class="fa fa-check"></i> Approve</button>

													<button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modal-decline"><i class="fa fa-close"></i> Decline</button>

													@elseif($trade->status == 2)
                                                    <button type="button" class="btn btn-success disabled mb-3">Order Approved</button>
													@elseif($trade->status == 3)
													  <button type="button" class="btn btn-danger disabled mb-3">Order Declined</button>
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


											<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
												<div class="modal-dialog " role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Approve Transaction</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<p>Are you sure you want to approve this transaction?</p>
															<p class="mb-0">{{$general->cur_sym}} {{number_format($trade->main_amo,2)}} will be  paid into seller's fiat wallet</p>
														</div>
														<div class="modal-footer">
															<a href="{{ route('admin.approve.sell', $trade->trx) }}"  type="button" class="btn btn-primary">Approve</a>
															<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>


										<div class="modal fade" id="modal-decline" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
												<div class="modal-dialog " role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Decline Transaction</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<p>Are you sure you want to reject this transaction</p>
														</div>
														<div class="modal-footer">
															<a href="{{ route('admin.decline.sell', $trade->trx) }}"  type="button" class="btn btn-primary">Approve</a>
															<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>
@endsection
