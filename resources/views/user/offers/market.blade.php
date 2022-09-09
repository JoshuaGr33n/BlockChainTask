@extends('include.user')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h3 class="card-title">{{$coin->name}} Market Offers</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="">
											<div class="table-responsive">
												<table id="example" class="table card-table table-striped text-nowrap table-bordered">
													<thead class="border-top">
														<tr>
															<th>No</th>
															<th>Seller</th>
															<th>Last Seen</th>
															<th>Country</th>
															<th>Market Cap</th>
															<th>Rate</th>
															<th>Payment</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													@php $number = 1; @endphp
													@foreach($offer as $data)
														<tr>
															<td>{{$number++}}</td>
															<td><center><img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->user_id)->first()->image ?? '') }}" class="w-5 h-5" alt=""><br>
															{{App\User::whereId($data->user_id)->first()->username ?? "Unknown User"}}</center></td>
															<td><span class="badge badge-success">{{ Carbon\Carbon::parse(App\User::whereId($data->user_id)->first()->created_at ?? $data->created_at)->diffForHumans() }}</span></td>
															<td>{{$data->country}}</td>
															<td>${{number_format($data->min,2)}} - ${{number_format($data->max,2)}}</td>
															<td>1USD = {{$data->rate}}{{$data->currency}}</td>
															<td>{{App\Paymentmethod::whereId($data->payment_method)->first()->name ?? "N/A"}}</td>
															<td><a href="{{route('user.viewoffer',$data->code)}}"><span class="badge badge-primary"  style="background-color: {{$general->bclr}}"> View Seller</span></a></td>

														</tr>
													@endforeach
													</tbody>
												</table>
											</div>
											{{$offer->links()}}
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

@section('javascript')

@endsection
