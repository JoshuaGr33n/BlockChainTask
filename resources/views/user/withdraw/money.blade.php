@extends('include.user')

@section('content')
    <!-- row opened -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
									<form action="{{route('user.withdraw.moneyReq')}}" method="post">
                                    @csrf
										<div class="product-details table-responsive border-top text-nowrap">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Method</th>
														<th>Min</th>
														<th >Max</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
												  @foreach($withdrawMethod as $data)
													<tr>
														<td>
															<div class="media">

																<div class="media-body">
																	<div class="card-item-desc mt-0">
																		<dl class="card-item-desc-1">
																		  <dt>{{__($data->name)}} </dt>

																		</dl>
																		<dl class="card-item-desc-1">
																		  <dt>Currency: </dt>
																		  <dd>{{__($data->currency)}}</dd>
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

														<td>{{formatter_money($data->min_limit)}}{{__($data->currency)}}</td>
														<td>{{formatter_money($data->max_limit)}}{{__($data->currency)}}</td>
														<td>
															<div class="custom-controls-stacked">
													<label class="custom-control custom-radio">
														<input type="radio" class="custom-control-input" id="currency{{$data->id}}" data-cur="{{$data->icurrency}}"   data-id="{{$data->id}}"  onclick="myFunction{{$data->id}}()"  name="method_code" value="{{$data->id}}" checke>
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
                        <button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-primary">@lang('Proceed')</button>

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

