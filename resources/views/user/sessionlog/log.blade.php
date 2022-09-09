@extends('include.user')

@section('content')

  <!-- row opened -->



						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="{{route('user.clearsession')}}"  style="background-color: {{$general->bclr}}" class="btn btn-danger btn-sm" data-toggle="card-collapse"><i class="fe fe-trash text-white"></i>Clear Log</a>

										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													<tr>
								<th scope="col">@lang('IP Address')</th>
                                <th scope="col">@lang('Browser')</th>
                                <th scope="col">@lang('OS')</th>
                                <th scope="col">@lang('Location')</th>
                                <th scope="col">@lang('Date')</th>
													</tr>
												</thead>
												<tbody>
                                @foreach($log as $k=>$data)
                                    <tr>
                                        <td data-label="#@lang('Trx')">{{$data->user_ip}}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{$data->browser}}</strong>
                                        </td>
                                        <td data-label="@lang('Remaining Balance')">
                                            <strong class="text-info">{{$data->os}}</strong>
                                        </td>
                                        <td data-label="@lang('Details')">{{$data->location}}, {{$data->country}}</td>
                                        <td data-label="@lang('Date')">{{date('d M, Y', strtotime($data->created_at))}}</td>
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
