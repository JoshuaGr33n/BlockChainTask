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
													<h4 class="text-uppercase mb-0 mt-1">Active Tickets: {{App\SupportTicket::where('user_id', Auth::id())->whereStatus(0)->latest()->count()}}</h4>
													<h4 class="text-uppercase mb-0 mt-1">Closed Ticket:  {{App\SupportTicket::where('user_id', Auth::id())->whereStatus(3)->latest()->count()}}</h4>
													<p class="mt-2 mb-0">To speak with anu of our customers' service representative, please use our list of phone numbers on our contact us page</p>

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
                                                        <th scope="col">@lang('SL')</th>
                                                        <th scope="col">@lang('Date')</th>
                                                        <th scope="col">@lang('Ticket Number')</th>
                                                        <th scope="col">@lang('Subject')</th>
                                                        <th scope="col">@lang('Status')</th>
                                                        <th scope="col">@lang('Action')</th>
                                                    </tr>
												</thead>
												<tbody>
												@foreach($supports as $key => $support)
                                                        <tr>
                                                            <td data-label="@lang('SL')">{{ ++$key }}</td>
                                                            <td data-label="@lang('Date')">{{ $support->created_at->format('d M, Y h:i A') }}</td>
                                                            <td data-label="@lang('Ticket')">#{{ $support->ticket }}</td>
                                                            <td data-label="@lang('Subject')">{{ $support->subject }}</td>
                                                            <td data-label="@lang('Status')">
                                                                @if($support->status == 0)
                                                                    <span class="badge badge-primary">@lang('Open')</span>
                                                                @elseif($support->status == 1)
                                                                    <span class="badge badge-success "> @lang('Answered')</span>
                                                                @elseif($support->status == 2)
                                                                    <span class="badge badge-info"> @lang('Customer Replied')</span>
                                                                @elseif($support->status == 3)
                                                                    <span class="badge badge-danger ">@lang('Closed')</span>
                                                                @endif
                                                            </td>

                                                            <td data-label="@lang('Action')">
                                                                <a href="{{ route('user.message', $support->ticket) }}"  style="background-color: {{$general->bclr}}" class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
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
