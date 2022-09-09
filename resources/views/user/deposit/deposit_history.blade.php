@extends('include.user')

@section('content')
  <!-- row opened -->
  <!-- Banner opened -->
						<div class="">
							<div class="card big-deal onsale">
								<div class="card-body p-4 text-white">
									<div class="row">
										<div class="col-xl-8 col-lg-12 col-md-12">
											<div class="d-sm-flex">
												<img src="{{url('/')}}/back/images/svg/wallet.svg" alt="" class="h-120">
												<div class="ml-4">
													<h3 class="text-uppercase mb-0 mt-1">Total Deposit: {{$general->cur_sym}}{{formatter_money(App\Deposit::where('user_id', Auth::id())->whereStatus(1)->sum('amount'))}}</h3>
													<p class="mt-2 mb-0">You can buy crypto currency with available balance in your fiat wallet. You can also lock your fund for a period of time in our vault</p>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- Banner closed -->


						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													<tr>
														 <th >@lang('Transaction ID')</th>
                                                         <th  >@lang('Gateway')</th>
                                                         <th  >@lang('Amount')</th>
                                                          <th >@lang('Time')</th>
													</tr>
												</thead>
												<tbody>

                                                @foreach($deposits as $k=>$data)
													<tr>
                                        <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                        <td data-label="@lang('Gateway')">{{ $data->gateway->name   }}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{formatter_money($data->amount)}} {{$general->cur_text}}</strong>
                                        </td>
                                        <td data-label="@lang('Time')">
                                            <i class="fa fa-calendar"></i> {{date(' d M, Y ', strtotime($data->created_at))}}
                                            <i class="fa fa-clock-o pl-1"></i> {{date('h:i A', strtotime($data->created_at))}}
                                        </td>
                                    </tr>
												  @endforeach


												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->




@endsection

@section('javascript')
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
