@extends('include.user')

@section('content')

<!-- App-content opened -->


							<!-- row opened -->
							<div class="row">
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

									<div class="card">
										<div class="card-header">
											<div class="card-title">Edit Password</div>
										</div>
										<form class="contact-form" action="" method="post" enctype="multipart/form-data">
                                        @csrf
										<div class="card-body">



											<div class="form-group">
												<label class="form-label">Change Password</label>
												 <input type="text" class="col-sm-12 form-control" id="CurrentPassword" name="current_password" placeholder="@lang('Current Password')">
                                            </div>
											<div class="form-group">
												<label class="form-label">New Password</label>
												 <input type="text" class="col-sm-12 form-control" id="password" name="password" placeholder="@lang('New Password')">
											</div>
											<div class="form-group">
												<label class="form-label">Confirm Password</label>
												 <input type="text" class="col-sm-12 form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('Confirm Password')">
											</div>
										</div>
										<div class="card-footer text-right">
											<button type="submit" href="#" class="btn btn-primary "  style="background-color: {{$general->bclr}}">Updated Password</button>
										</div>
										</form>
									</div>
									<div class="card panel-theme">
										<div class="card-header">
											<div class="float-left">
												<h3 class="card-title">Last Updated</h3>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="card-body no-padding">
											<ul class="list-group no-margin">
												<li class="list-group-item"><i class="fa fa-envelope mr-4"></i> {{date(' d M, Y ', strtotime(Auth::user()->passupdate))}} {{date('h:i A', strtotime(Auth::user()->passupdate))}}</li>

											</ul>
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
