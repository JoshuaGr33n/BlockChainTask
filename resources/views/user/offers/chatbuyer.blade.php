@extends('include.user')

@section('content')
<!-- row opened -->
						<div class="row chatbox">

							<div class="col-md-12 col-lg-12 col-xl-12 chat">

		@if($trade->buyer == Auth::id())
		<div class="alert alert alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
			<span class="alert-inner--text text-info"><strong>Hello!</strong> Trade safely on {{$general->sitename}} and ensure you dont send money to seller for trade other than the one created on {{$general->sitename}}. We will not be liable to any loss
			incurred from trading with a user outside {{$general->sitename}}<br>

		   </span>
		</div>
		@endif





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

         document.getElementById("expire").innerText = "<a class='text-danger'> Transaction Expired</a>",

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
										@if(isset($escrow) && $escrow)
										@if($trade->buyer == Auth::id())
										<ul class="ah-actions actions align-items-center">
											<li class="call-icon">
												<a data-toggle="modal" data-target="#modal-approve" href="#" class="btn badge-success"  >
													<i class="icon icon-check text-white"></i>&nbsp;Paid
												</a>
											</li>
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

     @if($trade->expire < $now)
    <a class='text-danger'> Transaction Expired</a>
     @else
      <span id="hours"></span>
      <span id="minutes"></span>
      <span id="seconds"></span>

    @endif
     								</abbr>
										</div>

		@if(isset($escrow) && $escrow)
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
			<span class="alert-inner--text"><strong>Hello Buyer!</strong>

			{{$trade->amount}}USD capped at {{$trade->units}} {{$coin->name}} has been held safely on Escrow for you. You can now proceed with this trade. Click on the paid button once you have made payment to seller
			</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		@else

		<div class="alert alert-danger  alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
			<span class="alert-inner--text"><strong>Hello!</strong>

			The seller has not placed fund into the escrow wallet yet. Please wait while the seller deposits your requested {{$coin->name}} into the escrow wallet, and then you can proceed with chat this transaction. You will be notified on this page once payment has been made.
			</span>
			<button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		@endif

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

									</div>
									<!-- msg card-body closed -->

									<!-- card-footer opened -->
									<!--@if(isset($escrow)) -->

                                    <form role="form" method="POST"  enctype="multipart/form-data" action="{{route('user.replychatbuyer')}}">
									 {{ csrf_field() }}


									<div class="card-footer p-3">
										<div class="msb-rehply d-flex">
											<span class="input-group-text attach_btn"><i class="fa fa-smile-o"></i></span>
											<input hidden name="id" value="{{$trade->id}}">
                                            <input type="hidden" name="typ" value="text">
											<input class="form-control" name="message" placeholder="Enter reply...">
											<button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}"><i class="fa fa-paper-plane-o"></i></button>
										</div>
									</div><!-- card-footer closed  -->
									</form>
                                    <form role="form" method="POST"   enctype="multipart/form-data"  action="{{route('user.replychatbuyer')}}">
                                        {{ csrf_field() }}


                                       <div class="card-footer p-3">
                                           <div class="msb-rehply d-flex">
                                               <label for="">Send Image</label>
                                               <input hidden name="id" value="{{$trade->id}}">
                                               <input type="hidden" name="typ" value="image">
                                               <input class="form-control" type="file" name="image">
                                               <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}"><i class="fa fa-paper-plane-o"></i></button>
                                           </div>
                                       </div><!-- card-footer closed  -->
                                       </form>
								<!--	@endif -->
								</div>
							</div><!-- col end -->
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content opened -->
			</div>



<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<div class="input-group-prepend">
																					<span class="input-group-text p-0 w-7"><i class="fa fa-envelope-o mx-auto text-muted fs-18"></i></span>
																				</div>
															<div class="py-3 text-center">
																<h3>I Paid!!</h3>
																<p>Are you sure you want you have paid?<br>
																This action cannot be undone!!</p>
																<a href="{{route('user.tradepaid',$trade->trx)}}"  style="background-color: {{$general->bclr}}" class="btn btn-primary">Yes I Paid</a>
															</div>
														</div>

													</div>
												</div>
											</div>
@endsection
