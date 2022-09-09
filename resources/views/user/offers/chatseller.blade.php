@extends('include.user')

@section('content')
<!-- row opened -->
						<div class="row chatbox">

							<div class="col-md-12 col-lg-12 col-xl-12 chat">


<!--
      @if($trade->user_id == Auth::id())
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
			<span class="alert-inner--text"><strong>Hello Seller!</strong> {{$trade->amount}}USD capped at {{$trade->units}} {{$coin->name}} has been held safely on Escrow pending the time the tranaction will be concluded.Fund will be released to buyer once you approve receipt of his payment. Click on the menu below and click
			on Approve to approve trade or click on the cancel menu to reject trade
			</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		@endif
-->


								<div class="card">
									<!-- Action header opened -->
									<div class="action-header clearfix">
										<div class="float-left hidden-xs d-flex ml-2">
											<div class="img_cont mr-3">
												<span class="avatar cover-image brround avatar-lg img-box-shadow" data-image-src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($trade->buyer)->first()->image ?? '') }}"></span>
												<span class="avatar-status bg-success"></span>
											</div>

<script>
    (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  let birthday = "{{$trade->expire}}",
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
          //document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour))+ "Hrs",
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)) + "Mins",
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second) + "Secs";


        }

      }, 0)
  }());
</script>
											<div class="align-items-center mt-2">
												<h4 class="mb-0 font-weight-semibold">{{App\User::whereId($trade->buyer)->first()->username ?? "Unknown"}}</h4>
												<span class="mr-3">online</span>
											</div>
										</div>


                                        @if($trade->user_id == Auth::id())
                                        	@if($escrow)
										<ul class="ah-actions actions align-items-center">
											<li class="call-icon">
												<a href="{{route('user.tradeapprove',$trade->trx)}}" class="btn badge-success">
													<i class="icon icon-check text-white"></i>&nbsp;Approve Payment
												</a>
											<li class="call-icon">
												<a  href="{{route('user.tradedispute',$trade->trx)}}" class="btn badge-danger"  >
													<i class="icon icon-close text-white"></i>&nbsp;Dispute
												</a>
											</li>
										</ul>
										    @endif
										@endif

									</div>
									<!-- Action header closed -->

									<!-- msg card-body opened -->
									<div class="card-body msg_card_body">
										<div class="chat-box-single-line">
											<abbr class="timestamp">

      <span id="hours"></span>
      <span id="minutes"></span>
      <span id="seconds"></span>
      <span id="expire"></span>
     								</abbr>
										</div>

										@if($escrow)
										@foreach($chat as $data)
										@if($data->type == 2)
										<div class="d-flex justify-content-start">
											<div class="img_cont_msg">
												<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->receiver)->first()->image ?? '') }}" class="rounded-circle user_img_msg" alt="img">
											</div>
											<div class="msg_cotainer">
												@if($data->typ==0)
                                                {{$data->message}}
                                                @else
                                                <img src="{{get_image(config('constants.chat.image.path').'/'.$data->message)}}" alt="can't find image" style="max-width:100px;max-height:100px">
                                                @endif
												<br>
												<span class="msg_timse"><b>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</b></span>
											</div>
										</div>
										@elseif($data->type == 1)
										<div class="d-flex justify-content-end">
											<div class="msg_cotainer_send">
												@if($data->typ==0)
                                                {{$data->message}}
                                                @else
                                                <img src="{{get_image(config('constants.chat.image.path').'/'.$data->message)}}" alt="can't find image" style="max-width:100px;max-height:100px">
                                                @endif
												<br>
												<span class="msg_time_sensd"><b>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</b></span>
											</div>
											<div class="img_cont_msg">
												<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->sender)->first()->image ?? '') }}" class="rounded-circle user_img_msg" alt="img">
											</div>
										</div>
										@endif

										@endforeach

										@else

										<div class="alert alert-danger  alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
			<span class="alert-inner--text"><strong>Hello!</strong>

			You have not placed fund into the escrow wallet yet. Please send exactly {{$trade->amount}}USD capped at {{$trade->units}} {{$coin->name}} to the {{$coin->name}} wallet address below, upon successful payment into escrow wallet, you will be able to proceed with this transaction chat and buyer will be notified on this page once payment has been made.
			</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>



			<!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="product-singleinfo">
											<div class="row">
												<div class="col-lg-4 col-xl-3 col-12">
													<div class="product-item text-center">
														<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{'bitcoin:'.$trade->escrowwallet.'?amount='.$trade->unit}}&choe=UTF-8\" style='width:190px;'  />
													</div>
												</div>
												<div class="col-lg-8 col-xl-6 col-12">
													<div class="product-item2-desc">
														<h4 class="font-weight-semibold fs-20"><a href="#">Send {{$coin->name}} To Escrow Wallet</a></h4>

														<div class="label-rating">

														<p class="text-muted">Scan the QR Code or copy the wallet address to send the ${{number_format($trade->escrowusd,2)}}(USD) worth of {{$coin->name}} to the {{$coin->name}} Escrow Wallet. Please note: do not send below {{$trade->escrowvalue}}{{$coin->symbol}}.  as wehave added {{$coin->fee}}% charge for this transaction. {{$general->sitename}} will not
														be liable to any loss arising from sending lower amount<br><b>Click on the Start Transaction button if you have made your payment. </b></p>
														<dl class="product-item2-align">
															<dt>Amount</dt>
															<dd>${{number_format($trade->escrowusd,2)}}</dd>
														</dl>
														<dl class="product-item2-align">
															<dt>Units</dt>
															<dd>{{$trade->escrowvalue}}{{$coin->symbol}}</dd>
														</dl>
														<dl class="product-item2-align">
														<dt>Address</dt>
														<div class="input-group">
														<input value="{{$trade->escrowwallet}}" readonly id="wallet"  type="text" class="form-control" placeholder="Search for...">
														<span class="input-group-append">
															<button class="btn btn-primary"  id="copyBoard"
                                                              onclick="myFunction()" type="button">Copy</button>
														</span>
													</div>

														</dl>
														<a href="{{route('user.escrowpaid',$trade->trx)}}" class="btn badge-success">
													<i class="icon icon-check text-white"></i>&nbsp;Start Transaction
												</a>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->





										@endif

									</div>
									<!-- msg card-body closed -->

									<!-- card-footer opened -->
									@if($escrow)

                                    <form role="form" method="POST"   action="{{route('user.replychatseller')}}">
									 {{ csrf_field() }}


									<div class="card-footer p-3">
										<div class="msb-rehply d-flex">
											<span class="input-group-text attach_btn"><i class="fa fa-smile-o"></i></span>
											<input hidden name="id" value="{{$trade->id}}">
                                            <input type="hidden" name="typ" value="text">
											<input class="form-control" name="message" placeholder="Enter reply...">
											<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i></button>
										</div>
									</div>
									</form>
                                    <form role="form" method="POST"   action="{{route('user.replychatseller')}}">
									 {{ csrf_field() }}


									<div class="card-footer p-3">
										<div class="msb-rehply d-flex">
											<label for="">Send Image</label>
                                               <input hidden name="id" value="{{$trade->id}}">
                                               <input type="hidden" name="typ" value="image">
                                               <input class="form-control" type="file" name="image">
                                               <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i></button>
										</div>
									</div>
									</form>
									@endif
								</div>
							</div><!-- col end -->
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content opened -->
			</div>

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
@endsection
