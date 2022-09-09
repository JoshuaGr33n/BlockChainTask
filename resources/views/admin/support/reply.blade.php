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
												<span class="avatar cover-image brround avatar-lg img-box-shadow" data-image-src="{{ get_image(config('constants.user.profile.path') .'/'. $ticket->user->image) }}"></span>
												<span class="avatar-status bg-success"></span>
											</div>
											<div class="align-items-center mt-2">
												<h4 class="mb-0 font-weight-semibold">{{$ticket->ticket}}</h4>
												<span class="mr-3">{{ $ticket->subject }}</span>
											</div>
										</div>
										<ul class="ah-actions actions align-items-center">
											 @if($ticket->status != 4)
											<li class="call-icon">
												<a href="#"  data-toggle="modal" data-target="#DelModal" class="d-done d-md-flex">
													<i class="text-danger icon icon-close"></i>
												</a>
											</li>
											 @else
											<li class="video-icon">
												<a href="" class="d-done d-md-flex">
													<i class="icon icon-close"></i>
												</a>
											</li>
											@endif

										</ul>
									</div>
									<!-- Action header closed -->

									<!-- msg card-body opened -->
									<div class="card-body msg_card_body">
										<div class="chat-box-single-line">
											 @if($ticket->status == 0)
                        <span class="badge badge-primary">Open</span>
                @elseif($ticket->status == 1)
                        <span class="badge badge-success">Answered</span>
                @elseif($ticket->status == 2)
                        <span class="badge badge-info">Customer Replied</span>
                @elseif($ticket->status == 3)
                        <span class="badge badge-danger">Closed</span>
                @endif
										</div>
										@foreach($messages as $message)
                                        @if($message->type == 1)
										<div class="d-flex justify-content-start">
											<div class="img_cont_msg">
												<img src="{{ get_image(config('constants.user.profile.path') .'/'. $ticket->user->image ?? '') }}" class="rounded-circle user_img_msg" alt="img">
											</div>
											<div class="msg_cotainer">
												{{ $message->message }}
												<span class="msg_time">{{ $message->created_at->format('d F, Y - h:i A') }}</span>
												 @if($message->attachments()->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach($message->attachments as $k=>$image)
                                                                    <a href="{{route('admin.ticket.download',encrypt($image->id))}}" class="ml-4"><i class="fa fa-file"></i> {{++$k}} @lang('File Download')</a>
                                                                @endforeach
                                                            </div>
                                                  @endif
											</div>
										</div>
										 @elseif($message->type == 2)
										<div class="d-flex justify-content-end">
											<div class="msg_cotainer_send">
												{{ $message->message }}
												<span class="msg_time_send">{{ $message->created_at->format('d F, Y - h:i A') }}</span>
												@if($message->attachments()->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach($message->attachments as $k=>$image)
                                                                    <a href="{{route('admin.ticket.download',encrypt($image->id))}}" class="ml-4"><i class="fa fa-file"></i> {{++$k}} @lang('File Download')</a>
                                                                @endforeach
                                                            </div>
                                                        @endif<br>
                                                        <a data-id="{{$message->id}}"
                                                                data-toggle="modal" data-target="#DelMessage" class=" delete-message text-danger"><i class="text-danger fa fa-trash"></i> Delete</a>
											</div>
											<div class="img_cont_msg">
												<img src="{{ asset('assets/images/logoIcon/logo.png') }}" class="rounded-circle user_img_msg" alt="img">

											</div>


										</div>
										 @endif
                                         @endforeach


									</div>
									<!-- msg card-body closed -->
                                    @if($ticket->status != 4)

									<!-- card-footer opened -->
									<form method="post" action="{{ route('admin.ticket.send', $ticket->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
									<div class="card-footer p-3">
										<div class="msb-reply d-flex">
											<span class="input-group-text attach_btn"><i class="fa fa-smile-o"></i></span>
											<input name="message" disabled class="form-control input-md" placeholder="Click To Upload File"></input>
											<button type="button" onclick="extraTicketAttachment()"><i class="fa fa-plus"></i></button>
										</div>
									</div>
                                    <div class="card-footer p-3">
										<div class="msb-reply d-flex">
									 <div id="fileUploadsContainer"></div>
                                    </div></div>

									<div class="card-footer p-3">
										<div class="msb-reply d-flex">
											<span class="input-group-text attach_btn"><i class="fa fa-envelope-o"></i></span>
											<textarea name="message"  placeholder="What's on your mind..."></textarea>
											<button type="submit"  name="replayTicket" value="1"><i class="fa fa-paper-plane-o"></i></button>
										</div>
									</div>
									</form>
									<!-- card-footer closed  -->


									</form> @endif
								</div>
							</div><!-- col end -->
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content opened -->
			</div>


			 <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i><strong>Confirmation!</strong>
                        </h4>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you  want to Close This Support Ticket?</strong>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route('admin.ticket.send', $ticket->id) }}">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-primary custom-btn-background" name="replayTicket"
                                    value="2"><i class="fa fa-check"></i> Yes I'm Sure.
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                                Close
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <div class="modal fade" id="DelMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i><strong>Confirmation!</strong>
                        </h4>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you sure to delete this?</strong>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route('admin.ticket.delete')}}">
                            @csrf
                            <input type="hidden" name="message_id" class="message_id">
                            <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Yes I'm Sure.
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                                Close
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <link rel="stylesheet" href="{{asset('assets/admin/css/simplemde.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/ticket.css')}}">

    <script src="{{asset('assets/admin/js/simplemde.min.js')}}"></script>

    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("inputMessage") });

        $(document).ready(function () {
            $('.card-body').scrollTop($('.card-body')[0].scrollHeight);


            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            })

        });

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<div class="form-group"><div class="custom-file"><input type="file" type="file" name="attachments[]" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Avatar</label></div></div>')
        }


    </script>
@endsection
