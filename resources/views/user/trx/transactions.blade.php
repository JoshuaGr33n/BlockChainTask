@extends('include.user')

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
												<img src="{{url('/')}}/back/images/svg/wallet.svg" alt="" class="h-120">
												<div class="ml-4">
													<h4 class="text-uppercase mb-0 mt-1">Total Transaction: {{$general->cur_sym}}{{formatter_money(auth()->user()->transactions()->latest()->sum('amount'))}}</h4>
													<p class="mt-2 mb-0">We care about details, find below an overview of all the transactions carried out on your account. Feel free toexport your account statement</p>

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
								<th scope="col">@lang('Transaction ID')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Remaining Balance')</th>
                                <th scope="col">@lang('Details')</th>
                                <th scope="col">@lang('Date')</th>
													</tr>
												</thead>
												<tbody>
												 @if(count($logs) >0)
                                @foreach($logs as $k=>$data)
                                    <tr>
                                        <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong @if($data->type == '+') class="text-success" @else class="text-danger" @endif> {{($data->type == '+') ? '+':'-'}} {{formatter_money($data->amount)}} {{$general->cur_text}}</strong>
                                        </td>
                                        <td data-label="@lang('Remaining Balance')">
                                            <strong class="text-info">{{formatter_money($data->main_amo)}} {{$general->cur_text}}</strong>
                                        </td>
                                        <td data-label="@lang('Details')">{{$data->title}}</td>
                                        <td data-label="@lang('Date')">{{date('d M, Y', strtotime($data->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"> @lang('No results found')!</td>
                                </tr>
                            @endif

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->




@endsection
