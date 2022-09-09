@extends('include.admin')

@section('content')
<!-- App-content opened -->



						<!-- row opened -->
						<div class="row">
						@foreach($currency as $data)
							<div class="col-xl-4">
								<div class="card">
									<div class="card-body text-center">
										<span class="avatar avatar-xxl brround cover-image default-shadow" data-image-src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$data->image}}" ></span>
										<h4 class="h4 mb-1 mt-3 ">{{$data->name}}</h4>
										<p class="mb-4 mt-1 ">{{$data->symbol}}</p>

										<div class="justify-content-center text-center mt-3 d-flex">
											<a href="{{ route('admin.wallet.receiveview',$data->id) }}" class="btn btn-primary-light pl-3 pr-3 mr-3"> View Received TRX</a>

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
