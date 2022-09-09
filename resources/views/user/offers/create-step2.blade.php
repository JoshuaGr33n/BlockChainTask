@extends('include.user')

@section('content')

<!-- row opened -->     <!-- Banner opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="banner banner-color mt-0">
									<div class="col-xl-2 col-lg-3 col-md-12">
										<img src="{{url('/')}}/back/images/svg/new_message.svg" alt="image" class="image">
									</div>
									<div class="page-content col-xl-7 col-lg-6 col-md-12">
										<h3 class="mb-1">Create {{$crypto->name}} Offer</h3>
										<p class="mb-0 fs-16">Please fill the form below to create you new {{$crypto->name}} offer. {{$general->sitename}} will not
										be liable to ny loss incurred from trading outside {{$general->sitename}} </p>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 text-right d-flex d-block">

										<a href="{{route('user.createoffer')}}" class="btn btn-primary">Cancel Process</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Banner opened -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card accordion-wizard">
									<div class="card-header">
										<h3 class="card-title">{{$page_title}}</h3>
									</div>
									<div class="card-body">
									<form  id="form" class="contact-form" action="{{route('user.postoffer',$crypto->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf

											<div class="list-group">
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Enter Amount Range</h5>
													<div data-acc-content>
														<div class="my-3">
														<div class="row">
															<div class="form-group col-6">
																<label>Minimum: <smaal>USD</small></label>
																<input type="number" name="min" placeholder="0.00"class="form-control" />
															</div>
															<div class="form-group col-6">
																<label>Maximum: <smaal>USD</small></label>
																<input type="number" name="max" placeholder="0.00" class="form-control" />
															</div>
														</div>

														 
														</div>
													</div>
												</div>
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Currency & Rate</h5>
													<div data-acc-content>
														<div class="my-3">
															<div class="form-group">
															<script>
function myFunction() {
 var name = $("#curr option:selected").attr('data-name');
  document.getElementById("curname").innerHTML = "Your Rate 1USD to "+name;
 };
</script>

																<label>Select Currency:</label>
																<select  id="curr" onchange="myFunction()"  name="currency" class="form-control select2-show-search  custom-select">
																 <option>Please Your Trade Currency</option>
																 @foreach($curr as $data)
																<option data-name="{{$data->name}}"value="{{$data->id}}">{{$data->country }} <small>({{$data->currency}})</small></option>
																@endforeach
																</select>

															</div>
															<div class="form-group">
																<label><a id="curname">Enter Rate: </a></label>
																<input type="number" name="rate" placeholder="0.00" class="form-control" />
															</div>
														</div>
													</div>
												</div>
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Payment Method</h5>
													<div data-acc-content>
														<div class="my-3">
														<script>
function myFunction3() {
 var name = $("#pmeth option:selected").attr('data-name');
  document.getElementById("pname").innerHTML = "Enter your "+name+" details";
 };
</script>
															<div class="form-group">
																<label>Preferred Payment Method</label>
																<select name="pmethod" id="pmeth" onchange="myFunction3()"  class="form-control select2-show-search custom-select">
																<option>Please Select Payment Method</option>
																 @foreach($pmethod as $data)
																<option data-name="{{$data->name}}" value="{{$data->id}}">{{$data->name}}</option>
																@endforeach
															</select>
															</div>

															<div class="form-group">
																<label>Payment Window</label><br>
																<small>How many minutes does your buyers have to pay you before trade is closed or expires</small>
																<input name="expire" type="number" class="form-control" placeholder="Enter Minutes">

															</div>

															<div class="form-group">
																<label id="pname">Enter Account Details</label>
																<textarea type="text" name="account" placeholder="How your buyers will pay you" class="form-control"></textarea>
															</div>
															<div class="form-group">
																<label>Enter Note To Buyer</label>
																<textarea type="text" name="note" placeholder="A small note or message to buyers" class="form-control"></textarea>
															</div>


														</div>
													</div>
												</div>
											</div>
										</form>
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
@section('javascript')
<script src="{{url('/')}}/back/plugins/accordion/jquery.accordion-wizard.min.js"></script>
<script src="{{url('/')}}/back/plugins/formwizard/jquery.smartWizard.js"></script>
<script src="{{url('/')}}/back/plugins/formwizard/fromwizard.js"></script>
@endsection

