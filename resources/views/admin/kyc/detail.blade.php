@extends('include.admin')

@section('content')

						<!-- row opened -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="single-productslide">
										<div class="row no-gutter">
											<div class="col-lg-12 col-xl-5 col-md-12 border-right pr-0">
												<div class="product-gallery pt-5 pl-5 pr-5 pb-0">
													<div class="product-slider">

														<div class="clearfix">
															<div id="thumbcarousel1" class="carousel slide mt-5 thumbcarousel" data-interval="false">
																<div class="carousel-inner">
																	<div class="carousel-item active">
																		<div data-target="#carousel2" data-slide-to="0" class="carousel-item active""><img src="{{url('/')}}/assets/images/kyc/{{$kyc->front ?? ''}}" alt="img"></div>
																	</div>

																</div>

															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-xl-7 col-md-12">
												<div class="product-gallery-data mb-0">
													<h4 class="mb-3 font-weight-semibold">Merchant: {{ App\User::whereId($kyc->user_id)->first()->username ?? "N/A" }}</h4>

													<h6 class="font-weight-semibold">KYC Address</h6>
													<p class="text-muted">{{$kyc->address}}, {{$kyc->city}}, {{$kyc->state}}, {{$kyc->country}}. ({{$kyc->zip}})</p>
													<dl class="product-gallery-data1">
														<dt>ID Type</dt>
														<dd>{{$kyc->type}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>ID Expiry Date</dt>
														<dd>{{$kyc->expiry}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>ID Number</dt>
														<dd>{{$kyc->number ?? ''}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Uploaded</dt>
														<dd>{{date(' d M, Y ', strtotime($kyc->created_at))}} {{date('h:i A', strtotime($kyc->created_at))}}</dd>
													</dl>
													<div class="product-gallery-rats">
														<ul class="product-gallery-rating">
															<li>
															 @if($kyc->status == 1)
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																@else
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																@endif
															</li>
														</ul>

													</div>

													 @if($kyc->status == 0)
													        <a href="{{route('admin.verifykyc',$kyc->id)}}" class="btn btn-success btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Verify"><i class="fa fa-check"></i> Approve</a>

															<a href="{{route('admin.declinekyc',$kyc->id)}}" class="btn btn-danger btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Decline"><i class="fa fa-trash-o"></i>Decline</a>
															 @elseif($kyc->status == 2 || $kyc->status == 0)
															<a href="{{route('admin.verifykyc',$kyc->id)}}" class="btn btn-success btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Verify"><i class="fa fa-check"></i> Approve</a>
															 @endif


												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->

						</div></div></div>

@endsection
