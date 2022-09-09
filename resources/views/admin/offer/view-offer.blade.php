@extends('include.admin')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="single-productslide">
										<div class="row no-gutter">
											<div class="col-lg-5 border-right pr-0">
												<div class="product-gallery p-4">
													<div class="product-item text-center">
														<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($offer->user_id)->first()->image ?? '') }}" alt="img">
													<br>
													<h4>Seller: {{App\User::whereId($offer->user_id)->first()->username ?? "Unknown"}}</h4>
													<h4>Email {{App\User::whereId($offer->user_id)->first()->email ?? "Unknown"}}</h4>

													</div>


												</div>

											</div>
											<div class="col-lg-7">
												<div class="product-gallery-data mb-0">
													<h3 class="mb-3 fs-20 font-weight-semibold">{{$coin->name ?? "N/A"}} </h3>
													<div class="mb-3">
														<span class="font-weight-semibold h3 text-primary">{{$offer->rate}}{{$offer->currency}}</span>
														<spanfaf>/USD</span>
													</div>
													<h6 class="font-weight-semibold">DESCRIPTION</h6>
													<p class="text-muted">{{$offer->note}}</p>
													<dl class="product-gallery-data1">
														<dt>Code</dt>
														<dd>{{$offer->code}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Range</dt>
														<dd>${{$offer->min}} - ${{$offer->max}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Country</dt>
														<dd>{{$offer->country}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Currency</dt>
														<dd>{{$offer->currency}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Payment</dt>
														<dd>{{App\Paymentmethod::whereId($offer->payment_method)->first()->name ?? "N/A"}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>TRX Expiry</dt>
														<dd>{{$offer->expire}} Minutes</dd>
													</dl>
                                                    <dl class="product-gallery-data1">
														<dt>All Trade</dt>
														<dd>{{App\Cryptotrade::where('marketcode', $offer->code)->orderBy('id','desc')->count()}}</dd>
													</dl>
                                                    <dl class="product-gallery-data1">
														<dt>Completed</dt>
														<dd>{{App\Cryptotrade::where('marketcode', $offer->code)->whereStatus(1)->whereDisbursed(1)->wherePaid(1)->whereDispute(0)->orderBy('id','desc')->count()}}</dd>
													</dl>
                                                    <dl class="product-gallery-data1">
														<dt>Unprocessed</dt>
														<dd>{{App\Cryptotrade::where('marketcode', $offer->code)->whereStatus(0)->orderBy('id','desc')->count()}}</dd>
													</dl>
                                                    <dl class="product-gallery-data1">
														<dt>Disputed</dt>
														<dd>{{App\Cryptotrade::where('marketcode', $offer->code)->whereDispute(1)->orderBy('id','desc')->count()}}</dd>
													</dl>
                                                    <dl class="product-gallery-data1">
														<dt>Buyer Paid</dt>
														<dd>{{App\Cryptotrade::where('marketcode', $offer->code)->wherePaid(1)->orderBy('id','desc')->count()}}</dd>
													</dl>

													<br>



													<a href="{{ route('admin.alltrx.offer' , $offer->code) }}" class="btn btn-info mt-1">All </a>
                                                    <a href="{{ route('admin.success.offer' , $offer->code) }}" class="btn btn-success mt-1">Completed </a>
                                                    <a href="{{ route('admin.pending.offer' , $offer->code) }}" class="btn btn-warning mt-1 text-white">Unprocessed </a>
                                                    <a href="{{ route('admin.disputed.offer' , $offer->code) }}" class="btn btn-danger mt-1 text-white">Disputed </a>
                                                    <a href="{{ route('admin.paid.offer' , $offer->code) }}" class="btn btn-primary mt-1 text-white">Buyer Paid </a>
                                                    @if($offer->status == 1)
                                                    <a href="{{ route('admin.deactivate.offer' , $offer->code) }}" class="btn btn-danger mt-1">Deactivate Offer </a>
                                                    @else
                                                    <a href="{{ route('admin.activate.offer' , $offer->code) }}" class="btn btn-success mt-1">Activate  Offer</a>
                                                    @endif



												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>
						<!-- row closed -->

@endsection
