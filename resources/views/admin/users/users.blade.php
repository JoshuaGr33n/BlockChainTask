@extends('include.admin')

@section('content')

						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row">

											<div class="col-xl-10">
											<form action="{{ route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName())) }}" method="GET" >
												<div class="input-group">

													<input type="text" name="search" class="form-control br-tl-3  br-bl-3" placeholder="Username or email" value="{{ $search ?? '' }}">
													<div class="input-group-append ">
														<button type="submit" class="btn btn-primary br-tr-3  br-br-3">
															Search
														</button>
													</div>
												</div>
												</form>
											</div>
											<div class="col-xl-2">
												<div class="mt-4 mt-xl-0">
													<button type="button" class="btn btn-success btn-block pt-2 pb-2" data-toggle="modal" data-target="#exampleModal3">ADD<i class="fa fa-plus ml-2"></i></button>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->

						<!-- row opened -->
						<div class="row">
						  @forelse($users as $user)
							<div class="col-xl-4">
								<div class="card">
									<div class="card-body text-center">
										<span class="avatar avatar-xxl brround cover-image default-shadow" data-image-src="{{ get_image(config('constants.user.profile.path') .'/'. $user->image) }}" ></span>
										<h4 class="h4 mb-1 mt-3 ">{{ $user->fullname }}</h4>
										<p class="mb-4 mt-1 ">{{ $user->username }}</p>
										<p class="mb-0 text-info ">{{ $user->email }}</p>
										<div class="d-flex mx-auto align-items-center justify-content-center text-center">
											<h6 class="text-muted d-flex mb-0 fw-400 mr-3"><i class="fa fa-map-marker mr-2"></i>{{ $user->address->country ?? "No Country" }}</h6>
											<h6 class="text-muted fw-400 mt-2"><i class="fa fa-phone mr-2"></i>{{ $user->mobile }}</h6>
										</div>
										<p class="text-muted text-center mt-1">Date Joined: {{date(' d M, Y ', strtotime($user->created_at))}} {{date('h:i A', strtotime($user->created_at))}}</p>
										<div class="justify-content-center text-center mt-3 d-flex">
											<a href="{{ route('admin.users.email.single', $user->id) }}" class="btn btn-primary-light pl-3 pr-3 mr-3"><i class="fa fa-comments"></i></a>
											<a href="{{ route('admin.users.detail', $user->id) }}" class="btn btn-info-light pl-3 pr-3 mr-3"><i class="fa fa-eye"></i></a>
											<a href="{{ route('admin.users.login.history.single', $user->id) }}" class="btn btn-success-light pl-3 pr-3"><i class="fa fa-key"></i> </a>
										</div>
									</div>
								</div>
							</div>
							  @empty
							  <div class="col-sm-12 col-md-12">
				<div class="alert alert-info">
					<button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>Oops</strong>
					<hr class="message-inner-separator">
					<p>{{ $empty_message }}.</p>
				</div>
			</div>

                        @endforelse



						</div>
						<!-- row closed -->
						{{$users->links()}}
					</div>
				</div>
				<!-- App-content closed -->
			</div>

@endsection
