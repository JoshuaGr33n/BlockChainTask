@extends('include.admin')

@section('content')

    </script>
  <!-- row opened -->
  <!-- Banner opened -->
						<div class="">
							<div class="card big-deal onsale">
								<div class="card-body p-4 text-white">
									<div class="row">
										<div class="col-xl-8 col-lg-12 col-md-12">
											<div class="d-sm-flex">
												 <div class="ml-4">
													<h4 class="text-uppercase mb-0 mt-1">Active Vault: {{$general->cur_sym}}{{formatter_money(App\Invest::whereStatus(1)->sum('amount'))}}</h4>
													<h4 class="text-uppercase mb-0 mt-1">Closed Vault: {{$general->cur_sym}}{{formatter_money(App\Invest::whereStatus(0)->sum('amount'))}}</h4>

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
														 <th scope="col">@lang('Customer Name')</th>
														 <th scope="col">@lang('Plan Name')</th>
                                <th scope="col">@lang('Payable Interest')</th>
                                <th scope="col">@lang('Duration')</th>
                                <th scope="col">@lang('Expected Payment')</th>
                                <th scope="col">@lang('Total Payments')</th>
                                <th scope="col">@lang('Received')</th>
                                <th scope="col">@lang('Capital Back')</th>
                                <th scope="col">@lang('Amount Vault')</th>
                                <th scope="col">@lang('Status')</th>
													</tr>
												</thead>
												<tbody>
                                               @foreach($trans as $data)
													<tr>
													 @php
                        $time_name = \App\TimeSetting::where('name', $data->time_name)->first();
                    @endphp

                                    <td data-label="@lang('Plan Name')">{{__($data->user->username ?? "N/A")}}</td>
                                    <td data-label="@lang('Plan Name')">{{__($data->plan->name ?? "")}}</td>
                                    <td data-label="@lang('Payable Interest')"> {{__($data->interest)}} {{__($general->cur_text)}}/ {{__($data->time_name)}} </td>
                                    <td data-label="@lang('Period')">@if($data->period == '-1') <span class="badge badge-success">@lang('Life-time')</span>  @else {{__($data->period)}} {{$time_name->slug ?? ""}} @endif</td>

                                   <td data-label="@lang('Expected Return')"> @if($data->period == '-1') <span class="badge badge-success">@lang('Life-time')</span>  @else {{__($data->period)}} @lang('Times') @endif </td>
                                   <td data-label="@lang('Paid')">{{__($data->return_rec_time)}} @if($data->return_rec_time > 1) @lang('Times') @else  @lang('Time') @endif</td>
                                    <td data-label="@lang('Received')">  {{__($data->return_rec_time * $data->interest)}} {{__($general->cur_text)}} </td>
                                    <td data-label="@lang('Capital Back')">@if($data->capital_status == '1') <span class="badge badge-success">@lang('Yes')</span>  @else <span class="badge badge-warning">@lang('No')</span> @endif</td>
                                    <td data-label="@lang('Invest Amount')">   {{__($data->amount)}} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Status')" style="padding-top:20px">  @if($data->status == '1')  <span class="badge badge-warning"><i class="fas fa-spinner fa-spin"></i> @lang('Running')</span>  @else <span class="badge badge-primary">@lang('Complete')</span> @endif </td>
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
