@extends('include.user')

@section('content')

<!-- App-content opened -->


							<!-- row opened -->
							<div class="row">
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
									<div class="card">
										<div class="card-body">
											<div class="text-center">
												<div class="userprofile">
													@if(Auth::user()->kyc < 1)
													<div class="text-center mb-4">
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-o text-warning"></i></span>
													</div>
													Account Not Verified
													@else
													<div class="text-center mb-4">
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
														<span><i class="fa fa-star text-success"></i></span>
													</div>
													Account Verified
													@endif
												 
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Edit Profile</h3>
										</div>
										<div class="card-body">
											 <form action="{{route('user.kycpost')}}" class="form" id="kt_form"  method="post" enctype="multipart/form-data">
                                                                 @csrf

                    

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
											<div class="custom-file">
												<input type="file" required name="image" accept="image/*" class="custom-file-input" >
												<label class="custom-file-label">Upload ID</label>
											</div>
										</div>
                        </div>
                  

                        <div class="form-group col-sm-6">
                            <label for="lastname" class="col-form-label">@lang('Type Of ID:')</label>
                            <select name="type" class="form-control">
<option>Company ID Card</option>
<option>Drivers' Licence</option>
<option>International Passport</option>
<option>Voters' Card</option>
</select>
                        </div>

                  

                        <div class="form-group col-sm-6">
                            <input type="hidden" id="track" name="country_code">
                            <label for="phone" class="col-form-label">@lang('ID Number')</label>
                           <input type="text" value="{{$kyc->number ?? 'N/A'}}" class="form-control" name="number"  required  placeholder="Enter Number on ID" />
                        </div>
                        
                    </div> 



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="address" class="col-form-label">@lang('Expiry Date:')</label>
                            <input type="date"  value="{{$kyc->expiry ?? 'N/A'}}"  class="form-control"  required name="expiry" value="" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="col-form-label">@lang('Address:')</label>
                            <input type="text" class="form-control" name="address" placeholder="Address Line 1" required  value="{{$kyc->address ?? "Not Set"}}" />
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="zip" class="col-form-label">@lang('Post Code:')</label>
                            <input type="text" class="form-control" name="zip" placeholder="Postcode"  required value="{{$kyc->zip ?? "Not Set"}}" />
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="col-form-label">@lang('City:')</label>
                            <input type="text" class="form-control" name="city" placeholder="City"  required value="{{$kyc->city ?? "Not Set"}}" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="zip" class="col-form-label">@lang('State:')</label>
                            <input type="text" class="form-control " name="state" placeholder="State"  required value="{{$kyc->state ?? "Not Set"}}" />
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="col-form-label">@lang('Country:')</label>
                            <input type="text" class="form-control" name="country" placeholder="Country" required  value="{{$kyc->country ?? "Not Set"}}" />
                        </div>

                    </div>






											<button type="submit"  style="background-color: {{$general->bclr}}"  class="btn btn-success mt-1">Update Profile</abutton

                </form>
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
