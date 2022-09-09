@extends('include.admin')

@section('content')

<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<h6 class="mb-3">{{$page_title}}</h6>
										<h3 class="mb-1 font-weight-semibold">${{number_format($usd,2)}}<span class="text-success fs-13 ml-2">(USD)</span></h3>
										<p class="mb-2 mt-3 text-muted">Trade Overview</p>
										<div class="progress h-1 mb-2">
											<div class="progress-bar bg-primary w-{{$count/$get * 100}}" role="progressbar"></div>
										</div>

										<small class="mb-0"><b>Offer Code</b><span class="float-right text-muted"><b>{{$offer->code}}</b></span></small><br>
										<small class="mb-0"><b>Offer Country</b><span class="float-right text-muted"><b>{{$offer->country}}</b></span></small><br>
										<small class="mb-0"><b>{{$page_title}}</b><span class="float-right text-muted"><b>{{$count}} Trade(s)</b></span></small><br>
                                        <small class="mb-0"><b>{{$page_title}} Quota</b><span class="float-right text-muted"><b>{{number_format($count/$get * 100,2)}} % of All Trade</b></span></small>

									</div>
								</div>
							</div>

						</div>
						<!-- row closed -->



						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card mb-0">
									<div class="card-header">
										<h3 class="card-title">{{$page_title}}</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="">
											<div class="table-responsive">
												<table class="table card-table table-striped text-nowrap table-bordered">
													<thead class="border-top">
														<tr>
														<th>Buyer</th>
														<th class="w-150">Name</th>
														<th class="w-150">Escrow Details</th>
														<th >Amount To Credit Buyer</th>
														<th >Buyer's Wallet Address</th>
														<th >Trade Details</th>
														<th >Action</th>
													     </tr>
													</thead>
													<tbody>
													 @foreach($trx as $data)
														<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->buyer)->first()->image ?? '') }}" alt="img" class="h-8 w-8"><br>
																</div>

															</div>
														</td>
														<td>
																		  <dt>{{App\User::whereId($data->buyer)->first()->username ?? ''}}:</dt>

																		  <dd>{{App\User::whereId($data->buyer)->first()->address->country ?? ''}}</dd>

														</td>
														<td>
																		  <dt>Amount USD: {{$data->escrowusd}}:</dt>
																		  <dt>Amount {{App\Currency::whereId($data->coin)->first()->name ?? ''}}: {{$data->escrowvalue}}{{App\Currency::whereId($data->coin)->first()->symbol ?? ''}}</dt>
																		  <dt>Escrow Invoice ID: {{$data->escrowid}}:</dt>
																		  <dt>Escrow Wallet: {{$data->escrowwallet}}:</dt>
																		  <dd><a href="{{route('admin.escrowcheck',$data->escrowid)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Check Escrow"><i class="fa fa-lock"></i> &nbsp; Verify Escrow Wallet</a></dd>

														</td>
													
														<td>{{$data->amount}}USD worth of {{App\Currency::whereId($data->coin)->first()->name ?? ''}}<br>
														<td>{{App\Cryptowallet::whereId($data->wallet)->first()->address ?? $data->wallet}}<br>
														<small>({{App\Currency::whereId($data->coin)->first()->name ?? ''}} Walet)</small></td>
														<td>
														@if($data->dispute == 0)
														@if($data->status == 0)
														<span class="badge badge-warning-light badge-md">Pending Approval</span>
														@elseif($data->status == 1)
														<span class="badge badge-success-light badge-md">Approved</span>
														@endif

														@if($data->paid == 0)
														<span class="badge badge-warning-light badge-md">Buyer Not Paid</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Buyer Paid</span>

														@endif
														@if($data->disbursed == 0)
														<span class="badge badge-warning-light badge-md">Coin Not Disbursed</span>
														@elseif($data->paid == 1)
														<span class="badge badge-success-light badge-md">Coin Disbursed</span>

														@endif
														@elseif($data->dispute == 1)
														<span class="badge badge-danger-light badge-md">Trade Disputed</span>
														@endif</tc>
														<td>
														    @if($data->dispute == 1)
														    <a  data-toggle="modal" data-target="#modal-dispute{{$data->trx}}" class="btn btn-primary btn-sm text-white" data-toggle="tooltip" data-original-title="Cancel Dispute"><i class="fa fa-key"></i></a>
															@endif
															@if($data->disbursed == 0)
															<a  data-toggle="modal" data-target="#modal-approve{{$data->trx}}" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-original-title="Approve Trade"><i class="fa fa-check"></i></a>
															@endif
															<a  data-toggle="modal" data-target="#modal-delete{{$data->trx}}" class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="Approve Trade"><i class="fa fa-trash"></i></a>
															<a href="{{route('admin.tradechat',$data->trx)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="View Chat"><i class="fa fa-envelope"></i></a>
															<a href="{{ route('admin.view.offer' , $data->marketcode) }}"  class="btn btn-primary btn-sm text-white" target="_blank" data-toggle="tooltip" data-original-title="View Offer"><i class="fa fa-eye"></i></a>

														</td>
													</tr>

											<div class="modal fade" id="modal-approve{{$data->trx}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																					<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
																				</div>
															<div class="py-3 text-center">
																<h3>Approve Trade</h3>
																<p>Are you sure you want to approve this trade?<br> Please ensure you have verified this Escrow transaction be double sure by checking the invoice using the escrow ID as the invoice number on your account with coinremitter.com<br>
																<!--This cannot be undone!! --></p>
																<a href="{{route('admin.tradeapprove',$data->trx)}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Approve Trade</a>
															</div>
														</div>

													</div>
												</div>
											</div>

											


											
											<div class="modal fade" id="modal-delete{{$data->trx}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
															</div>
															<div class="py-3 text-center">
																<h3>Delete Trade</h3>
																<p>Are you sure you want to delete this trade?<br>This will delete the trade and any chat log attached to it!!!<br>
																This cannot be undone!!</p>
																<a href="{{route('admin.tradedelete',$data->trx)}}" "{{url('/')}}/admin/trade-deleted/{{$data->trx}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Delete Trade</a>
															</div>
														</div>

													</div>
												</div>
											</div>


											<div class="modal fade" id="modal-dispute{{$data->trx}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																					<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
																				</div>
															<div class="py-3 text-center">
																<h3>Cancel Dispute</h3>
																<p>Are you sure you want to cancel dispute on this trade?<br>
																This cannot be undone!!</p>
																<a href="{{route('admin.canceldispute',$data->trx)}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Approve Trade</a>
															</div>
														</div>

													</div>
												</div>
											</div>
													@endforeach
													</tbody>
												</table>
											</div><br>
										@if(count($trx) < 1)

                                        <div class="alert bg-warning mb-5 py-4" role="alert">
			<div class="d-flex">
				<i class="fe fe-alert-triangle mr-3 fs-30"></i>
				<div class="">
					<h4 class="alert-heading">Hello Admin</h4>
					<p>You currently dont have any {{$page_title}} at the moment, Please check back later </p>


				</div>
			</div>
		</div>

										@endif
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
