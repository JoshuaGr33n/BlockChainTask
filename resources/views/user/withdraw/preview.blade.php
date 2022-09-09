@extends('include.user')

@section('content')

   <div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header ">
										<div class="card-title">Withdrawal Summery</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">

										<div class="table-responsive">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>Amount</td>
														<td class="text-right">{{formatter_money($withdraw->amount )}}  {{$withdraw->currency}}</td>
													</tr>
													<tr>
														<td><span>Charges</span></td>
														<td class="text-right text-muted"><span>{{ formatter_money($withdraw->charge) }}" {{$withdraw->currency}}</span></td>
													</tr>
													<tr>
														<td><span>Total</span></td>
														<td><h2 class="price text-right mb-0">{{ formatter_money($withdraw->final_amount) }}{{$withdraw->currency}}</h2></td>
													</tr>
												</tbody>
											</table>
										</div>
										<form class="text-center" action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
										 @csrf
										 <div class="form-group">
                                            <label for="a-trans"> {{__($withdraw->method->verify_image)}}</label>
                                            <input type="file" class="form-control" name="verify_image">
                                        </div>

                                    @foreach(json_decode($withdraw->detail) as $k=> $value)
                                        <div class="form-group">
                                            <label> {{str_replace('_',' ',$k)}} </label>
                                            <input type="text" name="{{$k}}" value=""  class="form-control " placeholder="" >
                                        </div>
                                    @endforeach
											<button  style="background-color: {{$general->bclr}}" type="submit" class="btn btn-success mt-2 float-right">Continue</button>
										</form>

									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


        </div>
    </div>
@endsection

