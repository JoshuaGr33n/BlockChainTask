@extends('include.user')

@section('content')

    <!-- App-content opened -->


						<!-- row opened -->

							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="wideget-user">
											<div class="row">
												<div class="col-lg-12 col-xl-6 col-md-12">
													<div class="wideget-user-desc d-flex">
														<div class="wideget-user-img">
															<img class="" src="{{ get_image(config('constants.user.profile.path') .'/'. $user->image) }}" width="100"  hieght="100" alt="img">
														</div>
														<div class="user-wrap mt-lg-0">
															<h4>{{$user->firstname}} {{$user->lastname}}</h4>
															<h6 class="text-muted mb-3 font-weight-normal">Member Since: {{date(' d M, Y ', strtotime($user->created_at))}}</h6>
															<a href="{{route('user.my-profile')}}" class="btn btn-primary mt-1 mb-1"  style="background-color: {{$general->bclr}}"><i class="fa fa-pencil"></i>&nbsp; Edit</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="border-top">
										<div class="wideget-user-tab p-4">
											<div class="tab-menu-heading">
												<div class="tabs-menu1">
													<ul class="nav">
														<li class=""><a href="#tab-51" class="active show" data-toggle="tab">Profile</a></li>

														<li><a href="#tab-81" data-toggle="tab" class="">Followers</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="border-0">
											<div class="tab-content">
												<div class="tab-pane active show" id="tab-51">
													<div id="profile-log-switch">
														<div class="table-responsive mb-5">
															<table class="table row table-borderless w-100 m-0 border">
																<tbody class="col-lg-6 p-0">

																	<tr>
																		<td><strong>Country :</strong> {{$user->address->country ?? "Not Set"}}</td>
																	</tr>
																	<tr>
																		<td><strong>State :</strong> {{$user->address->state ?? "Not Set"}}</td>
																	</tr>
																	<tr>
																		<td><strong>City :</strong> {{$user->address->city ?? "Not Set"}}</td>
																	</tr>
																	<tr>
																		<td><strong>Zip :</strong> {{$user->address->zip ?? "Not Set"}}</td>
																	</tr>
																	<tr>
																		<td><strong>Address :</strong> {{$user->address->address ?? "Not Set"}}</td>
																	</tr>
																</tbody>
																<tbody class="col-lg-6 p-0">
																    <tr>
																		<td><strong>Full Name :</strong> {{$user->firstname}} {{$user->lastname}}</td>
																	</tr>
																	<tr>
																		<td><strong>Username :</strong> {{$user->username}}</td>
																	</tr>
																	<tr>
																		<td><strong>Email :</strong> {{$user->email}}</td>
																	</tr>
																	<tr>
																		<td><strong>Phone :</strong> {{$user->mobile}}</td>
																	</tr>
																</tbody>
															</table>
														</div>

													</div>
												</div>

												<div class="tab-pane" id="tab-81">
													<div class="wideget-user-followers row">

														 @if(count($followers) >0)
                                                         @foreach($followers as $data)
														<div class="col-lg-6 col-md-6">
															<div class="mb-5 border">
																<div class="media overflow-visible">
																	<a class="media-left" href="javascript:;"><img alt="" class="avatar avatar-md brround" src="{{ get_image(config('constants.user.profile.path') .'/'. $data->image) }}"></a>
																	<div class="media-body valign-middle">
																		<b class="text-inverse fs-15">{{$data->firstname}} {{$data->lastname}}</b>
																		<p class="text-muted ">{{$data->email}}</p>
																	</div>

																</div>
															</div>
														</div>
														@endforeach
														@else
														You Dont Have Any Follower At The Moment. Please refer people to {{__($general->sitename)}} and earn bonus from them
														@endif

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- col end -->
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>


@endsection
