@extends('include.admin')

@section('content')
<!-- row opened -->
							<div class="row">
								<div class="col-lg-5 col-xl-4 col-md-12 col-sm-12">
									<div class="card">
										<div class="card-body">
											<div class="text-center">
												<div class="userprofile">
													<div class="userpic  brround mb-3"> <img  width="80" src="{{ get_image(config('constants.admin.profile.path').'/'. auth()->guard('admin')->user()->image) }}" alt="" class="userpicimg brround"> </div>
													<h3 class="username mb-2">{{ auth()->guard('admin')->user()->name }}</h3>
													<p class="mb-1 text-muted">{{ auth()->guard('admin')->user()->email }}</p>
													<div class="text-center mb-4">
														<span><i class="fa fa-star text-primary"></i></span>
														<span><i class="fa fa-star text-primary"></i></span>
														<span><i class="fa fa-star text-primary"></i></span>
														<span><i class="fa fa-star text-primary"></i></span>
														<span><i class="fa fa-star text-primary"></i></span>
													</div>

												</div>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header">
											<div class="card-title">Edit Password</div>
										</div>
										<div class="card-body">

											<form action="{{ route('admin.password.update') }}" method="POST">
                                            @csrf
											<div class="form-group">
												<label class="form-label">Current Password</label>
												 <input class="form-control" type="password" name="old_password">
											</div>
											<div class="form-group">
												<label class="form-label">New Password</label>
												 <input class="form-control" type="password" name="password">
											</div>
											<div class="form-group">
												<label class="form-label">Confirm Password</label>
												<input class="form-control" type="password" name="password_confirmation">
											</div>
											<div class="card-footer text-right">
											 <input type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-primary mt-2" value="Change Password">
										    </form>
										</div>
										</div>

									</div>

								</div>
								<div class="col-lg-7 col-xl-8 col-md-12 col-sm-12">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Edit Profile</h3>
										</div>
										<div class="card-body">
										<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                             @csrf
											<div class="row">

												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="exampleInputname">Email</label>
														 <input class="form-control" type="email" readonly name="email" value="{{ auth()->guard('admin')->user()->email }}" required>

													</div>
												</div>
												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="exampleInputname1">Username</label>
														 <input class="form-control" type="email" readonly value="{{ auth()->guard('admin')->user()->username }}" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Full Name</label>
												 <input class="form-control" type="text" name="name" value="{{ auth()->guard('admin')->user()->name }}" required>
											</div>

											  <div class="form-group">
											  <label for="exampleInputEmail1">Profile Image</label>
											  <div class="custom-file"><input type="file" name="image" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Avatar</label></div></div>

										<div class="card-footer">
											<input type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-block btn-primary mt-2" value="Save Changes">
										</div>

									</div>
									</form>

								</div>
							</div>
							<!-- row closed -->


						</div>
					</div>
					<!-- App-content closed -->
			</div>
@endsection
