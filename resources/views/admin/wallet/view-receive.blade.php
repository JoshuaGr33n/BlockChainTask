@extends('include.admin')

@section('content')


					<!--row opened -->
						<div class="row">

							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Received USD</h6>
												<h3 class="m-0">{{number_format($trecusd,2)}}USD</h3>
											</div>
											<div class="ml-auto">
												<img class="w-7 h-7" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="image">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Received {{$currency->symbol}}</h6>
												<h3 class="m-0">{{number_format($trecunit,8)}}{{$currency->symbol}}</h3>
											</div>
											<div class="ml-auto">
												<img class="w-7 h-7" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="image">
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>



								<div class="card">
									<div class="card-header">
										<div class="card-title">Received {{$currency->name}} History</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table border table-bordered mb-0 text-nowrap">
												<thead>
													<tr>
														<th>TRX HASH</th>
														<th>Date</th>
														<th>Receiver Address</th>
														<th>Amount</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody class="">
												@foreach($received as $data)
													<tr>
														<td>{{__(str_limit($data->hash, 10))}}.....<br>
														<a  target="_blank"  href="{{$data->explorer_url}}"  style="background-color: {{$general->bclr}}" class="badge badge-primary">View More</a></td>
														<td>{{date(' d M, Y ', strtotime($data->created_at))}}<br>
														<small>{{date('h:i A', strtotime($data->created_at))}}</small></td>
														<td>{{$data->address}}</td>
														<td class="text-success">{{$data->amount}} {{$currency->symbol}}<br>
														<small>{{number_format($data->usd,2)}} USD</small></td>
														<td><span class="badge badge-success-light fs-12">Coompleted</span></td>
													</tr>
												@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>	</div>	</div>	</div>





@endsection

@section('javascript')

		<script src="{{url('/')}}/back/plugins/owl-carousel/owl.carousel.js"></script>
		<script src="{{url('/')}}/back/plugins/owl-carousel/owl-main.js"></script>

<script src="{{url('/')}}/back/plugins/datatable/js/dataTables.buttons.min.js"/>
<script src="{{url('/')}}/back/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/jszip.min.js"></script>
<script src=".{{url('/')}}/back/plugins/datatable/js/pdfmake.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/vfs_fonts.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.colVis.min.js"></script>

@endsection
