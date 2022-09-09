@extends('include.admin')

@section('content')
<!-- row opened -->
						<div class="row chatbox">

							<div class="col-md-12 col-lg-12 col-xl-12 chat">







								<div class="card">
									<!-- Action header opened -->
									<div class="action-header clearfix">
										<div class="float-left hidden-xs d-flex ml-2">
											<div class="img_cont mr-3">
												<span class="avatar cover-image brround avatar-lg img-box-shadow" data-image-src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($trade->buyer)->first()->image ?? '') }}"></span>

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
												<span class="mr-3">Buyer</span>
											</div>
										</div>




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
										@foreach($chat as $data)
										@if($data->type == 2)
										<div class="d-flex justify-content-start">
											<div class="img_cont_msg">
												<img src="{{ get_image(config('constants.user.profile.path') .'/'. App\User::whereId($data->receiver)->first()->image ?? '') }}" class="rounded-circle user_img_msg" alt="img">
											</div>
											<div class="msg_cotainer">
												{{$data->message}}
												<br>
												(Seller)<br>
												<span class="msg_timse"><b>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</b></span>
											</div>
										</div>
										@elseif($data->type == 1)
										<div class="d-flex justify-content-end">
											<div class="msg_cotainer_send">
												{{$data->message}}
												<br>
												(Buyer)<br>
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


								</div>
							</div><!-- col end -->
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content opened -->
			</div>

@endsection
