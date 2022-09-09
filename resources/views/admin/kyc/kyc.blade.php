@extends('include.admin')

@section('content')

<!-- App-content opened -->



					<!-- row opened -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{$page_title}}</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive product-datatable">
											<table id="example" class="table table-striped table-bordered " >
												<thead>
													<tr>
														<th class="w-15p">Document</th>
														<th class="wd-15p">User</th>
														<th class="wd-20p">Number</th>
														<th class="wd-15p">Status</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
												@forelse($kyc as $user)
													<tr>
														<td>
														<img src="{{url('/')}}/assets/images/kyc/{{$user->front ?? ''}}" alt="img" class="h-7 w-7">
														<p class="d-inline-block align-middle mb-0 ml-1">
															<a href="" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{$user->type}}</a>
															<br>
															<span class="text-muted fs-13">{{date(' d M, Y ', strtotime($user->created_at))}} {{date('h:i A', strtotime($user->created_at))}}</span>
														</p>
														</td>
														<td>{{ App\User::whereId($user->user_id)->first()->username ?? "N/A" }}<br>
															<span class="text-muted fs-13">{{ App\User::whereId($user->user_id)->first()->business_name ?? "N/A" }}</span></td>
														<td>{{ $user->number }}</td>
														<td>
														@if($user->status == 0)
														<span class="badge badge-warning-light badge-md">Pending</span>
														@elseif($user->status == 1)
                                                        <span class="badge badge-success-light badge-md">Verified</span>
                                                        @elseif($user->status == 2)
                                                        <span class="badge badge-danger-light badge-md">Declined</span>
														@endif
														</td>
														<td>

															<a href="{{route('admin.viewkyc',$user->id)}}" class="btn btn-info btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="View Document"><i class="fa fa-eye"></i></a>
														</td>
													</tr>
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

												</tbody>
											</table>
										</div>
									</div>
									<!-- table-wrapper -->
								</div>
								<!-- section-wrapper -->
							</div>
						</div>
						<!-- row closed -->

						</div></div>


@endsection
