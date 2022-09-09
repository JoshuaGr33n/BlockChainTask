@extends('include.admin')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{$currency->name}}  Currency Manager</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
												<div class="card  box-shadow-0">
													<div class="card-header">
														<h4 class="card-title">{{$currency->name}} API Credentials</h4>
														<br>
													</div>
													<div class="card-body">
														<form action="{{route('admin.updatecurrencyapi',$currency->id)}}" class="form-horizontal" method="POST">
                                                        {{csrf_field()}}
															<div class="form-group">
															<small>{{$currency->name}} Wallet API Key</small>
																<input type="text" class="form-control" value="{{$currency->apikey}}" name="apikey" placeholder="API Wallet Key">
															</div>
															<div class="form-group">
															<small>{{$currency->name}} Wallet Password</small>
																<input type="text" class="form-control" value="{{$currency->apipass}}" name="apipass" placeholder="API Wallet Password">
															</div>

															<div class="form-group mb-0 mt-3 justify-content-end">
																<div>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>

											<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
												<div class="card  box-shadow-0 mb-0">
													<div class="card-header">
														<h4 class="card-title">{{$currency->name}} Currency Settings</h4>
													</div>
													<div class="card-body">
														<form action="{{route('admin.updatecurrency',$currency->id)}}" class="form-horizontal" method="POST">
                                                        {{csrf_field()}}
															<div class="form-group row">
																<label for="inputName1" class="col-md-3 col-form-label">Currency Name</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="name" value="{{$currency->name}}" readonly placeholder="Name">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Currency Symbol</label>
																<div class="col-md-9">
																	<input type="text" class="form-control" name="symbol" value="{{$currency->symbol}}" readonly placeholder="Symbol">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Sell Rate 1$/{{$general->cur_text}}</label>
																<div class="col-md-9">
																	<input type="number" class="form-control"  name="sell" value="{{$currency->sell}}" placeholder="Sell Rate">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Buy Rate 1$/{{$general->cur_text}}</label>
																<div class="col-md-9">
																	<input type="number" class="form-control"  name="buy"  value="{{$currency->buy}}" placeholder="BUy Rate">
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Minimum Trade ($)</label>
																<div class="col-md-9">
																	<input type="number" class="form-control"  name="min"  value="{{$currency->min}}" placeholder="Minimum Trade">
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Maximum Trade ($)</label>
																<div class="col-md-9">
																	<input type="number" class="form-control"  name="max"  value="{{$currency->max}}" placeholder="Maximum Trade">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Escrow Charge (%)</label>
																<div class="col-md-9">
																	<input type="number" class="form-control"  name="escrow"  value="{{$currency->fee}}" placeholder="Maximum Trade">
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Currency Purchase Feature</label>
																<div class="col-md-9">
																    <label class="custom-switch">
																	 <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="canbuy" @if($currency->canbuy) checked @endif>
                            		                                <span class="custom-switch-indicator"></span>
                            		                                 </label>
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Currency Sell Feature</label>
																<div class="col-md-9">
																	<label class="custom-switch">
																	 <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="cansell" @if($currency->cansell) checked @endif>
                            		                                <span class="custom-switch-indicator"></span>
                            		                                 </label>
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Currency Offer Feature</label>
																<div class="col-md-9">
																	<label class="custom-switch">
																	 <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="canoffer" @if($currency->canoffer) checked @endif>
                            		                                <span class="custom-switch-indicator"></span>
                            		                                 </label>
																</div>
															</div>

															<div class="form-group row">
																<label for="inputEmai2" class="col-md-3 col-form-label">Currency Wallet Feature</label>
																<div class="col-md-9">
																	<label class="custom-switch">
																	 <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" class="custom-switch-input"  data-off="Disabled" name="canwallet" @if($currency->canwallet) checked @endif>
                            		                                <span class="custom-switch-indicator"></span>
                            		                                 </label>
																</div>
															</div>
															<div class="form-group mb-0 mt-3 row justify-content-end">
																<div class="col-md-9">
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
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
