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
													<div class="userpic  brround mb-3"> <img src="{{ get_image(config('constants.user.profile.path') .'/'. $user->image) }}" width="90" alt="" class="userpicimg brround"> </div>
													<h3 class="username mb-2">{{$user->firstname}} {{$user->lastname}}</h3>
													<p class="mb-1 text-muted">{{$user->username}}, {{$user->address->country}}</p>
													<div class="text-center mb-4">
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-o text-warning"></i></span>
													</div>
													<div class="socials text-center mt-3">
														<a href="" class="btn btn-circle btn-primary ">
														<i class="fa fa-facebook"></i></a> <a href="" class="btn btn-circle btn-danger ">
														<i class="fa fa-google-plus"></i></a> <a href="" class="btn btn-circle btn-info ">
														<i class="fa fa-twitter"></i></a> <a href="" class="btn btn-circle btn-warning "><i class="fa fa-envelope"></i></a>
													</div>
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
											   <form class="contact-form" action="" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="InputFirstname" class="col-form-label">@lang('First Name:')</label>
                            <input type="text" class="form-control" id="InputFirstname" name="firstname"
                                       placeholder="@lang('First Name')" value="{{$user->firstname}}" >
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="lastname" class="col-form-label">@lang('Last Name:')</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                       placeholder="@lang('Last Name')" value="{{$user->lastname}}">
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email" class="col-form-label">@lang('E-mail Address:')</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="@lang('E-mail Address')" value="{{$user->email}}" required="">
                        </div>

                        <div class="form-group col-sm-6">
                            <input type="hidden" id="track" name="country_code">
                            <label for="phone" class="col-form-label">@lang('Mobile Number')</label>
                            <input type="tel" class="form-control pranto-control" id="phone" name="mobile" value="{{$user->mobile}}" placeholder="@lang('Your Contact Number')" required>
                        </div>
                        <input type="hidden" name="country" id="country" class="form-control d-none" value="{{$user->address->country}}">
                    </div>



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="address" class="col-form-label">@lang('Address:')</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="@lang('Address')" value="{{$user->address->address}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="col-form-label">@lang('State:')</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="@lang('state')" value="{{$user->address->state}}" required="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="zip" class="col-form-label">@lang('Zip Code:')</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{$user->address->zip}}" required="">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="city" class="col-form-label">@lang('City:')</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   placeholder="@lang('City')" value="{{$user->address->city}}" required="">
                        </div>

                    </div>




                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
											<div class="custom-file">
												<input type="file" name="image" accept="image/*" class="custom-file-input" >
												<label class="custom-file-label">Upload Avatar</label>
											</div>
										</div>
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
