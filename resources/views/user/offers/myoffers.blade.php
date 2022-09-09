@extends('include.user')

@section('content')

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
											<table id="exampleu" class="table table-striped table-bordered " >
												<thead>
													<tr>
														<th class="w-15p">Currency</th>
														<th class="wd-15p">Offer Code</th>
														<th class="wd-20p">Rate</th>
														<th class="wd-15p">Status</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
												@foreach($offers as $data)
												@php $pend = App\Cryptotrade::whereMarketcode($data->code)->whereStatus(0)->count(); @endphp
													<tr>
														<td>
														<img src="{{url('/')}}/back/images/crypto-currencies/square-color/{{App\Currency::whereId($data->coin_id)->first()->image}}" alt="img" class="h-6 w-6">
														<p class="d-inline-block align-middle mb-0 ml-1">
															<a href="" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{App\Currency::whereId($data->coin_id)->first()->name}}</a>
															<br>
															<span class="text-muted fs-13">${{number_format($data->min,2)}} - ${{number_format($data->max,2)}}</span>
														</p>
														</td>
														<td>{{$data->code}}
														@if($pend > 0)
														<br>
														<span class="badge badge-primary-light badge-md">{{$pend}} Pending Trade}</span>
														@endif
														</td>
														<td>1USD = {{$data->rate}}{{$data->currency}}</td>
														@if($data->status < 1)
														<td><span class="badge badge-danger-light badge-md">Inactive</span></td>
														@else
														<td><span class="badge badge-success-light badge-md">Active</span></td>
														@endif
														<td>
                                                            @if($data->status > 0)
															<a data-toggle="modal" data-target="#disableoffer{{$data->id}}" class="btn btn-warning btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Disable Offer"><i class="fa fa-close"></i></a>
															@else
															<a data-toggle="modal" data-target="#deleteoffer{{$data->id}}" class="btn btn-danger btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Delete Offer"><i class="fa fa-trash-o"></i></a>
															<a href="{{route('user.activateoffer',$data->code)}}" class="btn btn-success btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Activate Offer"><i class="fa fa-check"></i></a>
															@endif
															<a href="{{route('user.manageoffer',$data->code)}}" class="btn btn-info btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Manage Offert"><i class="fa fa-eye"></i></a>
														</td>
													</tr>

													<div class="modal fade" id="deleteoffer{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
												<div class="modal-dialog " role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Delete Offer</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<p>Are you sure you want to delete this offer</p>

														</div>
														<div class="modal-footer">
															<a href="{{route('user.deleteoffer',$data->code)}}" type="button"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Delete</a>
															<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>


										<div class="modal fade" id="disableoffer{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
												<div class="modal-dialog " role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Disable Offer</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<p>Are you sure you want to disabled this offer</p>

														</div>
														<div class="modal-footer">
															<a href="{{route('user.disableoffer',$data->code)}}"  style="background-color: {{$general->bclr}}" type="button" class="btn btn-primary">Disable</a>
															<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>


												@endforeach
												</tbody>
											</table>
										</div>
										{{$offers->links()}}
										@if(count($offers) < 1)

                                        <div class="alert bg-warning mb-5 py-4" role="alert">
			<div class="d-flex">
				<i class="fe fe-alert-triangle mr-3 fs-30"></i>
				<div class="">
					<h4 class="alert-heading">Hello {{Auth::user()->username}}</h4>
					<p>You currently dont have any coin offer at the moment, please click on the button below to create a new coin offer </p>

					<a href="{{route('user.createoffer')}}" class="btn btn-primary mx-1" href="#">Create Offer </a>
				</div>
			</div>
		</div>

										@endif
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

@endsection
