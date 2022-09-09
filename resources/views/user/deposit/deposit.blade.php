@extends('include.user')

@section('content')
    <!-- row opened -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
									<form action="{{route('user.deposit.insert')}}" method="post">
                                    @csrf
										<div class="product-details table-responsive border-top text-nowrap">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Gateway</th>
														<th>Min</th>
														<th >Max</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
												  @foreach($gatewayCurrency as $data)
													<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{$data->methodImage()}}" alt="img" class="h-8 w-8">
																</div>
																<div class="media-body">
																	<div class="card-item-desc mt-0">
																		<dl class="card-item-desc-1">
																		  <dt>{{__($data->name)}} </dt>

																		</dl>
																		<dl class="card-item-desc-1">
																		  <dt>Currency: </dt>
																		  <dd>{{$data->baseCurrency()}}</dd>
																		</dl>

																	</div>
																</div>
															</div>
														</td>
														<script>
														function myFunction{{$data->id}}(){
														var id = $("#currency{{$data->id}}").attr('data-id');
														var cur = $("#currency{{$data->id}}").attr('data-cur');
														document.getElementById("currency").value = cur;
														document.getElementById("gateway").value = id;
														}
														</script>

														<td>{{$general->cur_sym}}{{formatter_money($data->min_amount, $data->method->crypto())}}</td>
														<td>{{$general->cur_sym}}{{formatter_money($data->max_amount, $data->method->crypto())}}</td>
														<td>
															<div class="custom-controls-stacked">
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="currency{{$data->id}}" data-cur="{{$data->baseCurrency()}}" data-id="{{$data->method_code}}"  onclick="myFunction{{$data->id}}()"  name="method_code" value="{{$data->id}}" checke>
														<span class="custom-control-label">Select</span>
													</label>


												</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											 <br>
											 <div class="form-group">
                                          <label>@lang('Enter Amount'):</label>
                                      <div class="input-group">
                                <input id="amount" type="text" class="form-control form-control-lg" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="{{old('amount')}}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text currency-addon addon-bg">{{$general->cur_text}}</span>
                                </div>
                                <input type="hidden" name="currency" id="currency" value="">
                                 <input type="hidden" name="method_code" id="gateway"  value="">

                                     </div>
                                     <br>
                        <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}">@lang('Proceed')</button>

                                     </form>
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


@stop

