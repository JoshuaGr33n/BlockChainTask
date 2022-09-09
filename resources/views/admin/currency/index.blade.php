@extends('include.admin')

@section('content')
<!-- App-content opened -->


						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-xl-12">
												<div class="input-group">
													<input type="text" class="form-control br-tl-3  br-bl-3" placeholder="Search">
													<div class="input-group-append ">
														<button type="button" class="btn btn-primary br-tr-3  br-br-3">
															Search
														</button>
													</div>
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
						@foreach($currency as $data)
							<div class="col-xl-4">
								<div class="card">
									<div class="card-body text-center">
										<span class="avatar avatar-xxl brround cover-image default-shadow" data-image-src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$data->image}}" ></span>
										<h4 class="h4 mb-1 mt-3 ">{{$data->name}}</h4>
										<p class="mb-4 mt-1 ">{{$data->symbol}}</p>
										<p class="mb-0 text-warning ">Minimum Trade: ${{$data->min}}</p>
										<p class="mb-0 text-success ">Maximum Trade: ${{$data->max}}</p>
										<p class="mb-0 text-info ">Sell Rate: 1$ = {{$data->sell}} {{$general->cur_text}}</p>
										<p class="mb-0 text-info ">Buy Rate: 1$ = {{$data->buy}} {{$general->cur_text}}</p>
										<p class="mb-0 text-info ">Escrow Charge = {{$data->fee}}%</p>

                                        <div class="row">
										<p class="text-muted text-center mt-1 col-6">
										@if($data->status == 1)
										<a class="badge badge-success text-white">Global Status :Active</a>
										@else
										<a class="badge badge-danger text-white">Global Status: Inactive</a>
										@endif
										</p>

										<p class="text-muted text-center mt-1 col-6">
										@if($data->canbuy == 1)
										<a class="badge badge-success text-white">Buy Feature: Active</a>
										@else
										<a class="badge badge-danger text-white"> Buy Feature: Inactive</a>
										@endif
										</p>

										<p class="text-muted text-center mt-1 col-6">
										@if($data->cansell == 1)
										<a class="badge badge-success text-white">Sell Feature: Active</a>
										@else
										<a class="badge badge-danger text-white">Sell Feature: Inactive</a>
										@endif
										</p>

										<p class="text-muted text-center mt-1 col-6">
										@if($data->canoffer == 1)
										<a class="badge badge-success text-white">Offer Feature: Active</a>
										@else
										<a class="badge badge-danger text-white">Offer Feature: Inactive</a>
										@endif
										</p>

										<p class="text-muted text-center mt-1 col-12">
										@if($data->canwallet == 1)
										<a class="badge badge-success text-white">Wallet Feature: Active</a>
										@else
										<a class="badge badge-danger text-white">Wallet Feature: Inactive</a>
										@endif
										</p>
										</div>
										<div class="justify-content-center text-center mt-3 d-flex">
											<a href="{{ route('admin.currency.edit',$data->id) }}" class="btn btn-primary-light pl-3 pr-3 mr-3"><i class="fa fa-pencil "></i></a>
											@if($data->status == 1)
											<a href="{{ route('admin.currency.deactivate',$data->id) }}" class="btn btn-danger pl-3 pr-3 mr-3"><i class="fa fa-close"></i></a>
											@else
											<a href="{{ route('admin.currency.activate',$data->id) }}" class="btn btn-success pl-3 pr-3 mr-3"><i class="fa fa-check"></i></a>
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@endsection
