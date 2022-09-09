@extends('include.user')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Trade History</div>
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
														<th class="w-15p">Seller name</th>
														<th class="wd-15p">Coin</th>
														<th class="wd-20p">Amount</th>
														<th class="wd-20p">Date</th>
														<th class="wd-15p">Status</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
												@foreach($trade as $data)
													<tr>
														<td>
														<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->user_id)->first()->image ?? '') }}" alt="img" class="h-7 w-7">
														<p class="d-inline-block align-middle mb-0 ml-1">
															<a href="" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{App\User::whereId($data->user_id)->first()->username ?? "Unknown"}}</a>
															<br>

														</p>
														</td>
														<td>{{App\Currency::whereId($data->coin)->first()->name ?? "Unknown"}}</td>
														<td>${{$data->amount}}</td>
														<td>{{$data->created_at}}</td>
														<td>
														@if($data->dispute == 0)
														@if($data->status == 0)
														<span class="badge badge-warning-light badge-md">Seller Hasn't Approved</span>
														@elseif($data->status == 1)
														<span class="badge badge-success-light badge-md">Seller Approved</span>
														@endif

														@if($data->paid == 0)
														<span class="badge badge-warning-light badge-md">I've Not Paid</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Ive Paid</span>

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
														<td>
														    @if($data->paid == 1)
														    @if($data->dispute == 0)
															<a href="{{route('user.tradedispute',$data->trx)}}"class="btn btn-danger btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Dispute"><i class="fa fa-close"></i></a>
															@else
															<a href="{{route('user.closedispute',$data->trx)}}"class="btn btn-success btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Close Dispute"><i class="fa fa-check"></i></a>
															@endif
															@endif
															<a href="{{route('user.chathistory',$data->trx)}}" class="btn btn-info btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="View Chat"><i class="fa fa-envelope"></i></a>
														</td>
													</tr>

													@endforeach
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
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@stop

@section('javascript')

@endsection
