@extends('include.user')

@section('content')

    <!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card bg-dark1">
									<div class="js-conveyor-example">
										<ul class="news-crypto">
										@foreach($assets as $data)
											<li>
												<div>
													<div class="row">
														<div class="d-flex">
															<div class="">
																<img src="{{url('/')}}/back/images/crypto-currencies/regular/{{$data->image}}" class="w-5 h-6 mt-1" alt="icon">
															</div>
															<div class="ml-3">
																<p class="text-white mb-1 fs-12">{{$data->name}}</p>
																<div class="h5 m-0 fs-14 text-warning">$1.00<span class="text-success ml-2"> = {{$general->cur_sym}}{{number_format($data->buy,2)}}</span></div>
															</div>
														</div>
													</div>
												</div>
											</li>
										    @endforeach

										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


						<!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="product-singleinfo">
											<div class="row">
												<div class="col-lg-4 col-xl-3 col-12">
													<div class="product-item text-center">
														<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{'bitcoin:'.$trade->coin_wallet.'?amount='.$trade->coin_amo}}&choe=UTF-8\" style='width:190px;'  />
													</div>
												</div>
												<div class="col-lg-8 col-xl-6 col-12">
													<div class="product-item2-desc">
														<h4 class="font-weight-semibold fs-20"><a href="#">Sell {{$currency->name}}</a></h4>

														<div class="label-rating">
														<div id="countdown"  class="timer">
    <ul>
      <span id="days"></span>
      <span id="hours"></span>
      <span id="minutes"></span>
      <span id="seconds"></span>
      <span id="expire"></span>
    </ul>
  </div>
														</div>

<script>
    (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  let birthday = "{{$trade->timeout}}",
      countDown = new Date(birthday).getTime(),
      x = setInterval(function() {

        let now = new Date().getTime(),
            distance = countDown - now;
        if (distance < 0) {
           //do something later when date is reached

         document.getElementById("expire").innerText = "Transaction Expired",

          clearInterval(x);
        }
        else{
           //document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour))+ "Hrs",
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)) + "Mins",
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second) + "Secs";


        }

      }, 0)
  }());
</script>
														<p class="text-muted">Scan the QR Code or copy the wallet address to send the {{$trade->amount}}USD worth of {{$currency->name}} you want to sell. Please note: do not send below ${{number_format($trade->amount,2)}}. {{$general->sitename}} will not
														be liable to any loss arising from sending lower amount<br><b>Click on the Process button if you have made your payment. Your Fiat Wallet will be credited once payment has been confirmed on the  Blockchain Network</b></p>
														<dl class="product-item2-align">
															<dt>Amount</dt>
															<dd>${{number_format($trade->amount,2)}}</dd>
														</dl>
														<dl class="product-item2-align">
															<dt>Units</dt>
															<dd>{{$trade->coin_amo}}{{$currency->symbol}}</dd>
														</dl>
														<dl class="product-item2-align">
														<dt>Address</dt>
														<div class="input-group">
														<input value="{{$trade->coin_wallet}}" id="wallet"  type="text" class="form-control" placeholder="Search for...">
														<span class="input-group-append">
															<button class="btn btn-primary"  id="copyBoard"
                                                              onclick="myFunction()" type="button">Copy</button>
														</span>
													</div>

														</dl>
													</div>
												</div>
												<div class="col-lg-12 col-xl-3 col-12 border-left">
													<div class="product-ship">
														<div class="product-item-price">
															<span class="newprice text-muted">{{$general->cur_sym}}{{number_format($trade->main_amo)}}</span>
														</div>
														<p><a href="#" class="fs-16 text-muted"> What You Get</a></p><br>
														<p>
														<form role="form" method="POST"   action="{{ route('user.validatesell') }}">
										                {{ csrf_field() }}

										                <input name="trx" hidden value="{{$trade->trx}}">

															<button  class="btn btn-primary"  style="background-color: {{$general->bclr}}" typ="submit"><li class="fa fa-send"></li>&nbsp;&nbsp;Process</button>
														</form>
														</p>
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

@section('script')
    <script>
        function myFunction() {
            var copyText = document.getElementById("wallet");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if(alertStatus == '1'){
                iziToast.success({message:"Copied: "+copyText.value, position: "topRight"});
            }else if(alertStatus == '2'){
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
@endsection
