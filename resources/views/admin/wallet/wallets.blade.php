@extends('include.admin')

@section('content')
<!-- row opened -->

					<!--row opened -->
						<div class="row">
							<div class="col-sm-6 col-md-12 col-lg-4 col-xl-4 col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Balance USD</h6>
												<h3 class="m-0">${{number_format($usd,2)}}</h3>
											</div>
											<div class="ml-auto">
												<img class="w-7 h-7" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="image">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-12 col-lg-4 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Balance {{$currency->symbol}}</h6>
												<h3 class="m-0">{{$unit}}{{$currency->symbol}}</h3>
											</div>
											<div class="ml-auto">
												<img class="w-7 h-7" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="image">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-12 col-lg-4 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">{{$currency->symbol}} Rate</h6>
												<h4 class="m-0">1{{$currency->symbol}} = ${{number_format( $rate)}}</h4>
											</div>
											<div class="ml-auto">
												<img class="w-7 h-7" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="image">
											</div>
										</div>
									</div>
								</div>


							</div>

						</div>
						<!-- row closed -->
                        <button data-toggle="modal"  style="background-color: {{$general->bclr}}" data-target="#modal-createwallet" class="btn btn-sm btn-primary">Create Wallet</button><br><br>
						<!-- row opened -->
						<div class="row">

						@foreach($wallets as $data)
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card wallet">
									<div class="card-body">
										<h4 class="card-title">{{$currency->name}} Wallet</h4>

										<label>Wallet Address</label>@if($data->status == 0)
											<a class="badge badge-danger text-white">Inactive</a>
											@else
											<a class="badge badge-success text-white">Active</a>
											@endif
										<div class="input-group mb-3">
											<span class="input-group-addon bg-light"><i class="ti ti-wallet fs-21"></i></span>
											<input type="text" class="form-control pt-5 pb-5" readonly id="{{$data->label}}" value="{{$data->address}}">
											<span class="input-group-addon-right bg-light" id="copyBoard" onclick="{{$data->label}}()">
											<i class="fa fa-clipboard fs-21"></i></span>
										</div>

										<div class="row">
											<div class="col-xl-8 col-md-8 col-lg-8 col-sm-12 mt-2">
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-user text-muted mr-2 mt-1 fs-16"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Owner </span> : <span class="ml-auto h5 text-primary">{{App\User::whereId($data->user_id)->first()->username ?? "Unknown"}}</span>
												</p>
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-receipt text-muted mr-2 mt-1 fs-16"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Label </span> : <span class="ml-auto h5 text-primary">{{$data->label}}</span>
												</p>
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-wallet mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Balance </span> : <span class="ml-auto h5 text-primary">{{number_format($data->usd/ $rate,8)}}{{$currency->symbol}}</span>
												</p>
												<p class="mb-0 d-flex">
													<span class=""><i class="fa fa-usd mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Total Balance </span> : <span class="ml-auto font-weight-bold text-primary">{{number_format($data->usd,2)}}USD</span>
												</p>

											</div>
											<div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">

												<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$currency->name.':'.$data->address}}&choe=UTF-8\" style='width:190px;'  />
											</div>
										</div>
										<div class="flex mt-4">

											<a href="{{ route('admin.users.detail', $data->user_id) }}" class="btn btn-info">View Owner</a>
											@if($data->status == 1)
											<a href="{{route('admin.deactivatewallet',$data->address)}}" class="btn btn-danger">Deactivate</a>
											@else
											<a href="{{route('admin.activatewallet',$data->address)}}" class="btn btn-success">Activate</a>
											@endif
											<a href="{{route('admin.viewwallet',$data->address)}}" class="btn btn-info">View TRX</a>
											<button data-toggle="modal"   data-target="#modal-debit{{$data->id}}"  class="btn btn-warning mr-2 text-white">Debit {{$currency->symbol}}</button>
											<button data-toggle="modal"  data-target="#modal-credit{{$data->id}}"  class="btn btn-primary mr-2">Credit {{$currency->symbol}}</button>
										</div>
									</div>
								</div>
							</div>


@section('script')
    <script>
        function {{$data->label}}() {
            var copyText = document.getElementById("{{$data->label}}");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if (alertStatus == '1') {
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
            } else if (alertStatus == '2') {
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
@endsection


<script>
function credit() {
 var usd = $('#usd').val();
 var unit = usd/{{$rate}};
  document.getElementById("unit").innerHTML = "<b class='text-white'>Units: "+unit+"{{$currency->symbol}}</b>";
  document.getElementById("cunit").value = unit;



 };
</script>
<script>
function debit() {
 var usd = $('#usd2').val();
 var unit = usd/{{$rate}};
  document.getElementById("unit2").innerHTML = "<b class='text-white'>Units: "+unit+"{{$currency->symbol}}</b>";
  document.getElementById("dunit").value = unit;
 };
</script>

<!-- Send Coin Modal -->

<div class="modal fade" id="modal-credit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">

												<div class="modal-dialog "  role="document">
												<form action="{{route('admin.creditwallet',$data->address)}}" method="POST">
                                                                 {{csrf_field()}}
													<div class="modal-content"  style="background-color: {{$general->bclr}}">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default"  style="background-color: {{$general->bclr}}">Send {{$currency->name}}</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
														<center>
														<img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="img" class="w-20 text-center mx-auto">
														</center>

															<div class="py-3 text-center">
																<p class="text-white">Balance: {{number_format($data->usd,2)}} USD</p>
															</div>

                            <label class="text-white">Enter Amount To Credit (USD)</label>
                            <input type="number"  id="usd" onkeyup="credit()" class="form-control" name="amount" placeholder="$0.00">

                             <div class="" id="unit"></div>
                             <input id="cunit" hidden name="unit" >

                            <input type="number" class="form-control" hidden name="currency" value="{{$currency->id}}">
                            <br>





															</div>
															<div class="modal-footer">
															<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-success">Credit {{$currency->symbol}}</button>
															<button type="button" class="btn btn-warning  ml-auto" data-dismiss="modal">Cancel</button>
														</div>
														</div>

														 </form>
													</div>
												 </div>


				<!-- Send Coin Modal End -->



<!-- Debit Coin Modal -->

<div class="modal fade" id="modal-debit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">

												<div class="modal-dialog "  role="document">
												<form action="{{route('admin.debitwallet',$data->address)}}" method="POST">
                                                                 {{csrf_field()}}
													<div class="modal-content"  style="background-color: {{$general->bclr}}">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default"  style="background-color: {{$general->bclr}}">Send {{$currency->name}}</h2>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
														<center>
														<img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="img" class="w-20 text-center mx-auto">
														</center>

															<div class="py-3 text-center">
																<p class="text-white">Balance: {{number_format($data->usd,2)}}USD</p>
															</div>

                            <label class="text-white">Enter Amount To Debit (USD)</label>
                            <input type="number"  id="usd2" onkeyup="debit()" class="form-control" name="amount" placeholder="$0.00">

                             <div class="" id="unit2"></div>
                             <input id="dunit" hidden name="unit" >

                            <input type="number" class="form-control" hidden name="currency" value="{{$currency->id}}">
                            <br>





															</div>
															<div class="modal-footer">
															<button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-success">Debit {{$currency->symbol}}</button>
															<button type="button" class="btn btn-warning  ml-auto" data-dismiss="modal">Cancel</button>
														</div>
														</div>

														 </form>
													</div>
												 </div>


				<!-- Debit Coin Modal End -->


							@endforeach


						</div>
							@if(count($wallets) < 1)
                            <div class="alert alert-warning mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Opps!</strong> Dear {{Auth::user()->username}}, you currently dont have any wallet address at the moment. Please Click on the create wallet button above to create a new {{$currency->name}} wallet address</span>
		                    </div>
							@endif

						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>

			<!-- Create Wallet Modal -->
			<div class="modal fade" id="modal-createwallet" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}" alt="img" class="w-20 text-center mx-auto">
															<div class="py-3 text-center">
																<h5>Create New {{$currency->name}} Wallet</h5>
																<p>Enter a wallet address label and select a customer to create a new {{$currency->name}} wallet address for him or her</p>
                                                                <form action="{{route('admin.createwallet',$currency->symbol)}}" method="POST">
                                                                 {{csrf_field()}}
                            <label>Enter Wallet Label</label>
                            <input type="text" class="form-control" name="label" placeholder="Wallet Label">

                            <div class="form-group">
                            <label>Select Customer:</label>
							<select name="user" class="form-control">
							<option>Please Select</option>
							@foreach($user as $data)
							<option value="{{$data->id}}">{{$data->username}}</option>
							@endforeach
							</select>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success "  style="background-color: {{$general->bclr}}">@lang('Create Wallet')</button>

                    </div>


                                                                 </form>

															</div>
														</div>

													</div>
												</div>
											</div>
				<!-- Create Wallet Modal End -->
@endsection
