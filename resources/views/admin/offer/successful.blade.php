@extends('include.admin')

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
											<table id="example" class="table table-striped table-bordered " >
												<thead>
													<tr>
														<th class="w-15p">Currency</th>

														<th class="wd-15p">Status</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
												@foreach($coin as $data)
													<tr>
														<td>
														<img src="{{url('/')}}/back/images/crypto-currencies/square-color/{{$data->image}}" alt="img" class="h-7 w-7">
														<p class="d-inline-block align-middle mb-0 ml-1">
															<a href="" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{$data->name}}</a>
															<br>
															<span class="text-muted fs-13">{{$data->symbol}}</span>
														</p>

														@if($data->status == 0)
														<td><span class="badge badge-warning-light badge-pill">Inactive</span></td>
														@elseif($data->status == 1)
														<td><span class="badge badge-success-light badge-pill">Active</span></td>
														@else
														<td><span class="badge badge-danger-light badge-pill">Unknown</span></td>
														@endif
														<td>
															<a href="{{ route('admin.view.successful.offer' , $data->id) }}"  class="btn btn-info btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i> &nbsp; View Successful Trade</a>
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
@endsection
