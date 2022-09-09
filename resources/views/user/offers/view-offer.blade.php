@extends('include.user')

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
													Seller Username: {{App\User::whereId($offer->user_id)->first()->username ?? "Unknown"}}
													<div class="product-gallery-rats">
														<ul class="product-gallery-rating">
															<li>
																<a href="#"><i class="fa fa-star text-warning"></i></a>
																<a href="#"><i class="fa fa-star text-warning"></i></a>
																<a href="#"><i class="fa fa-star text-warning"></i></a>
																<a href="#"><i class="fa fa-star text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
															</li>
														</ul>
														<div class="label-rating">Rating</div>
													</div>
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
														<dt>Payment</dt>
														<dd>{{App\Paymentmethod::whereId($offer->payment_method)->first()->name ?? "N/A"}}</dd>
													</dl>

													<br>

                                                <script>
                                                function convert() {
                                                var usd = $('#usd').val();
                                                 var pay = usd*{{$offer->rate}};
                                                  document.getElementById("pay").innerHTML = "<b>You Pay: "+pay+"{{$offer->currency}}</b>";
                                                  document.getElementById("window").innerHTML = "<br><a class='text-danger'>Be ready to make your payment to the seller within the payment window of <b>{{$offer->expire}} Minutes</a></b>";

                                                };
                                                </script>
                                                    <form  id="form" class="contact-form" action="{{route('user.contactseller',$offer->code)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <small>Enter Amount To Buy (USD)</small><br>
													<div class="input-group">

													<input type="number"  id="usd" onkeyup="convert()" class="form-control" name="amount" placeholder="${{$offer->min}} - ${{$offer->max}}" >
                                					</div>
                                					<a id="pay"></a>
                                					<a id="window"></a>
                                					<br>
                                					<small>Please enter Your {{$coin->name ?? ""}} Wallet to receive your {{$coin->symbol ?? ""}}.<br>
                                					Please note: We will not be liable to any loss arising from you entering a wrong wallet address </small><br>
													<div class="input-group">
													<script>
function myFunction2() {
 var balance = $("#wallet option:selected").attr('data-balance');
 var wallet = $("#wallet option:selected").attr('data-address');
  document.getElementById("balance").innerHTML = "<b>balance: "+balance+"{{$coin->symbol ?? ""}}</b>";
  document.getElementById("address").innerHTML = "<b>Address: "+wallet+"</b>";
 };
</script>

												<!--	<select id="wallet" onchange="myFunction2()"  name="wallet" class="form-control select2-show-search custom-select">
																<option selected readonly>Select Wallet</option>
																 @foreach($wallet as $data)
																<option data-balance="{{$data->balance}}" data-address="{{$data->address}}"value="{{$data->id}}">{{$data->label}}</option>
																@endforeach
													</select> -->
														<input type="text"  class="form-control" name="wallet" placeholder="Enter Your Wallet Address">

                                					</div>
                                					<a id="address"></a>
													<br><a id="balance"></a>
                                					<br>

													<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-primary mt-1"> <i class="fa fa-shopping-cart"></i> Contact Seller </button>
													</form>


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
