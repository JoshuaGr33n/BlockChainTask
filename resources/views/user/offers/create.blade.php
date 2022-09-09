@extends('include.user')

@section('content')


   <!-- row opened -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="product-details table-responsive border-top text-nowrap">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Icon</th>

														<th >Name</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
												 @foreach($crypto as $data)
													<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{url('/')}}/back/images/crypto-currencies/square-color/{{$data->image}}" alt="img" class="h-6 w-6">
																</div>

															</div>
														</td>

														<td>{{$data->name}} <small> ({{$data->symbol}})</small></td>
														<td>
															<a href="{{route('user.createoffer2',$data->symbol)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Select Cryptocurrency"><i class="fa fa-check-o"></i>Select</a>
														</td>
													</tr>
												 @endforeach

												</tbody>
											</table>
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
