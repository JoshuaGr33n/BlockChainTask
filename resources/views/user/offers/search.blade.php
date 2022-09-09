@extends('include.user')

@section('content')

<!-- Row-->
  <form  action="{{route('user.searchp2p')}}" method="post" enctype="multipart/form-data">
                                       @csrf

						<div class="row">
							<div class="col-md-12">
								<div class=" pt-0  cover-image pt-7 bg-background2 card pb-7 bg-primary border-0" data-image-src="../assets/images/banners/banner5.jpg">
									<div class="header-text mb-0">
										<div class="container">
											<div class="text-center text-white background-text">
												<h2 class="mb-2 display6">P2P Market Offers</h2>
												<p>Please elect the cryptocurrency you wish to buy and your country.
												We will filter your search with the best result of cryptocurrency offers<br>
												<b>Please note, we will not be liable to any loss incurred from trading outside {{$general->sitename}}</p>
											</div>
											<div class="row">

												<div class="col-xl-11 col-lg-12 col-md-12 d-block mx-auto">
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex">
																<div class="form-group col-xl-4 col-lg-4  col-md-12 mb-0">
																	<select name="currency" class="form-control select2-show-search  custom-select">
																		<option disabled selected  >Select Cryptocurrency</option>
																		@foreach($crypto as $data)
																        <option value="{{$data->id}}">{{$data->name}}</option>
																        @endforeach
																	</select>
																</div>
																<div class="col-xl-2 col-lg-2 col-md-12 text-center">
																	<i class="fa fa-map fs-20 inline-block mt-0 mt-lg-3 mb-md-2 mt-md-1"></i>
																</div>
																 <div class="form-group col-xl-4 col-lg-4 col-md-12 mb-0">
																	<select name="country"  class="form-control select2-show-search  custom-select">
																		<option disabled selected>Select Country</option>
                                                                        <option value="allcount">All Countries</option>

																		@foreach($country as $data)
																        <option value="{{$data->country}}">{{$data->country }}</option>
																        @endforeach
																	</select>
																</div>
																
																 <div class="form-group col-xl-4 col-lg-4 col-md-12 mb-0">
																	<select name="paymentMethod"  class="form-control select2-show-search  custom-select">
																		<option disabled selected>Select Payment Type</option>
                                                                        <option value="allcount">All Payments</option>

																		@foreach($payment_methods as $method)
																        <option value="{{$method->id}}">{{$method->name }}</option>
																        @endforeach
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-pink btn-lg pl-6 pr-6 pt-2 pb-2 mx-auto"> <li class="fa fa-search"></li> &nbsp;FIND OFFER</button>
													</div>
												</div>

											</div>
										</div>
									</div><!-- /header-text -->
								</div>
							</div>
						</div>
						<!-- Row End -->
</div></div></div></form>

@endsection
