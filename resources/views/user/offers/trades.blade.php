@extends('include.user')

@section('content')

<!-- row opened -->
						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Successful Trade</h6>
										<h3 class="mb-1 font-weight-semibold">${{number_format($successful,2)}}<span class="text-success fs-13 ml-2">(USD)</span></h3>
										<p class="mb-2 mt-3 text-muted">Trade Overview</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-primary w-{{$suc*$count/100}} " role="progressbar"></div>
										</div>
										<small class="mb-0">Total Trades<span class="float-right text-muted">{{$suc}}</span></small>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Pending Trade</h6>
										<h3 class="mb-1 font-weight-semibold">${{number_format($pending,2)}}<span class="text-warning fs-13 ml-2">(USD)</span></h3>
										<p class="mb-2 mt-3 text-muted">Trade Overview</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-secondary w-{{$pend*$count/100}}" role="progressbar"></div>
										</div>
										<small class="mb-0">Total Trades<span class="float-right text-muted">{{$pend}}</span></small>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">Disputed Trade</h6>
										<h3 class="mb-1 font-weight-semibold">${{number_format($declined,2)}}<span class="text-danger fs-13 ml-2">(USD)</span></h3>
										<p class="mb-2  mt-3 text-muted">Trade Overview</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-info w-{{$dec*$count/100}} " role="progressbar"></div>
										</div>
										<small class="mb-0">Total Trades<span class="float-right text-muted">{{$dec}}</span></small>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->



						<!-- row opened -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
								<b>Pending Trades</b>
										<div class="product-details table-responsive border-top text-nowrap">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Buyer</th>
														<th class="w-150">Name</th>
														<th >Amount</th>
														<th >Status</th>
														<th>Expiry</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
											 @foreach($ptrade as $data)
													<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}" alt="img" class="h-8 w-8">
																</div>

															</div>
														</td>
														<td>
																		  <dt>{{App\User::whereId($data->buyer)->first()->username ?? ''}}:</dt>

																		  <dd>{{App\User::whereId($data->buyer)->first()->address->country ?? ''}}</dd>

														</td>
														<td>
														@if($data->dispute == 0)
														@if($data->status == 0)
														<span class="badge badge-warning-light badge-md">Pending Approva<l/span>
														@elseif($data->status == 1)
														<span class="badge badge-success-light badge-md">You Approved</span>
														@endif

														@if($data->paid == 0)
														<span class="badge badge-warning-light badge-md">Buyer Not Paid</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Buyer Paid</span>

														@endif
														@if($data->disbursed == 0)
														<span class="badge badge-warning-light badge-md">Coin Not Disbursed</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Coin Disbursed</span>

														@endif
														@elseif($data->dispute == 1)
														<span class="badge badge-danger-light badge-md">Trade Dispute</span>
														@endif
														</td>
														<td>{{$data->amount}}USD<br>
														{{App\Currency::whereId($data->coin)->first()->name ?? ''}}</td>
														<td>{{ Carbon\Carbon::parse($data->expire)->diffForHumans() }}</tc>
														<td>
															<a  data-toggle="modal" data-target="#modal-approve" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-original-title="Approve Trade"><i class="fa fa-check"></i></a>
															<a href="{{route('user.contactbuyer',$data->trx)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Chat With Buyer"><i class="fa fa-envelope"></i></a>
														</td>
													</tr>

											<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																					<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
																				</div>
															<div class="py-3 text-center">
																<h3>Approve Trade</h3>
																<p>Are you sure you want to approve this trade?<br>
																This cannot be undone!!</p>
																<a href="{{route('user.tradeapprove',$data->trx)}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Approve Trade</a>
															</div>
														</div>

													</div>
												</div>
											</div>
													@endforeach
												</tbody>
											</table>
										</div><br>
										@if(count($ptrade) < 1)

                                        <div class="alert bg-warning mb-5 py-4" role="alert">
			<div class="d-flex">
				<i class="fe fe-alert-triangle mr-3 fs-30"></i>
				<div class="">
					<h4 class="alert-heading">Hello {{Auth::user()->username}}</h4>
					<p>You currently dont have any pending trade at the moment </p>


				</div>
			</div>
		</div>

										@endif

									</div>
								</div>
							</div></div>
							
								<!-- row opened -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
								<b>Disputed Trades</b>
										<div class="product-details table-responsive border-top text-nowrap">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Buyer</th>
														<th class="w-150">Name</th>
														<th >Amount</th>
														<th >Status</th>
														<th>Expiry</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
											 @foreach($dtrade as $data)
													<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}" alt="img" class="h-8 w-8">
																</div>

															</div>
														</td>
														<td>
																		  <dt>{{App\User::whereId($data->buyer)->first()->username ?? ''}}:</dt>

																		  <dd>{{App\User::whereId($data->buyer)->first()->address->country ?? ''}}</dd>

														</td>
														<td>
														@if($data->dispute == 0)
														@if($data->status == 0)
														<span class="badge badge-warning-light badge-md">Pending Approva<l/span>
														@elseif($data->status == 1)
														<span class="badge badge-success-light badge-md">You Approved</span>
														@endif

														@if($data->paid == 0)
														<span class="badge badge-warning-light badge-md">Buyer Not Paid</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Buyer Paid</span>

														@endif
														@if($data->disbursed == 0)
														<span class="badge badge-warning-light badge-md">Coin Not Disbursed</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Coin Disbursed</span>

														@endif
														@elseif($data->dispute == 1)
														<span class="badge badge-danger-light badge-md">Trade Dispute</span>
														@endif
														</td>
														<td>{{$data->amount}}USD<br>
														{{App\Currency::whereId($data->coin)->first()->name ?? ''}}</td>
														<td>{{ Carbon\Carbon::parse($data->expire)->diffForHumans() }}</tc>
														<td>
															<a  data-toggle="modal" data-target="#modal-approve" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-original-title="Approve Trade"><i class="fa fa-check"></i></a>
															<a href="{{route('user.contactbuyer',$data->trx)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Chat With Buyer"><i class="fa fa-envelope"></i></a>
														</td>
													</tr>

											<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																					<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
																				</div>
															<div class="py-3 text-center">
																<h3>Approve Trade</h3>
																<p>Are you sure you want to approve this trade?<br>
																This cannot be undone!!</p>
																<a href="{{route('user.tradeapprove',$data->trx)}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Approve Trade</a>
															</div>
														</div>

													</div>
												</div>
											</div>
													@endforeach
												</tbody>
											</table>
										</div><br>
										@if(count($dtrade) < 1)

                                        <div class="alert bg-warning mb-5 py-4" role="alert">
			<div class="d-flex">
				<i class="fe fe-alert-triangle mr-3 fs-30"></i>
				<div class="">
					<h4 class="alert-heading">Hello {{Auth::user()->username}}</h4>
					<p>You currently dont have any disputed trade at the moment </p>


				</div>
			</div>
		</div>

										@endif

									</div>
								</div>
							</div></div>


						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h3 class="card-title">Successful Trades</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="">
											<div class="table-responsive">
												<table class="table card-table table-striped text-nowrap table-bordered">
													<thead class="border-top">
														<tr>
														<th>Buyer</th>
														<th class="w-150">Name</th>
														<th >Amount</th>
														<th >Status</th>
														<th >Chat History</th>
													     </tr>
													</thead>
													<tbody>
													 @foreach($strade as $data)
														<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}" alt="img" class="h-8 w-8">
																</div>

															</div>
														</td>
														<td>
																		  <dt>{{App\User::whereId($data->buyer)->first()->username ?? ''}}:</dt>

																		  <dd>{{App\User::whereId($data->buyer)->first()->address->country ?? ''}}</dd>

														</td>
														<td>{{$data->amount}}USD<br>
														{{App\Currency::whereId($data->coin)->first()->name ?? ''}}</td>
														<td>
														@if($data->dispute == 0)
														@if($data->status == 0)
														<span class="badge badge-warning-light badge-md">Pending< Approval</span>
														@elseif($data->status == 1)
														<span class="badge badge-success-light badge-md">You Approved</span>
														@endif

														@if($data->paid == 0)
														<span class="badge badge-warning-light badge-md">Buyer Not Paid</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Buyer Paid</span>

														@endif
														@if($data->disbursed == 0)
														<span class="badge badge-warning-light badge-md">Coin Not Disbursed</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Coin Disbursed</span>

														@endif
														@elseif($data->dispute == 1)
														<span class="badge badge-danger-light badge-md">Trade Dispute</span>
														@endif</tc>
														<td>
															<a href="{{route('user.contactbuyer',$data->trx)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Chat With Buyer"><i class="fa fa-envelope"></i></a>
														</td>
													</tr>
													@endforeach
													</tbody>
												</table>
											</div><br>
										@if(count($strade) < 1)

                                        <div class="alert bg-warning mb-5 py-4" role="alert">
			<div class="d-flex">
				<i class="fe fe-alert-triangle mr-3 fs-30"></i>
				<div class="">
					<h4 class="alert-heading">Hello {{Auth::user()->username}}</h4>
					<p>You currently dont have any successful trade at the moment, Please check back latter or try finishing all pending trades </p>


				</div>
			</div>
		</div>

										@endif
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
