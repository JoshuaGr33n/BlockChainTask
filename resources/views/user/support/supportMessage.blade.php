@extends('include.user')

@section('content')

  <!-- App-content opened -->


						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

								<div class="card">
									<div class="card-header border-bottom-0 online-status d-flex justify-content-between align-items-center">
										<p class="card-title">Chats</p>


										@if($my_ticket->status == 0)
                                               <div class="status offline "> <h6 class="online text-right">Open</h6>
                                            @elseif($my_ticket->status == 1)
                                               <div class="status offline online"> <h6 class="online text-right">Answered</h6>
                                            @elseif($my_ticket->status == 2)
                                               <div class="status offline online"> <h6 class="online text-right">Replied</h6>
                                            @elseif($my_ticket->status == 3)
                                                <div class="status offline "> <h6 class="online text-right">Closed</h6>
                                            @endif


										</div>
									</div>
                                    <ul class="mail-chats m-0">
                                     @foreach($messages as $message)
                                     @if($message->type == 1)
                                        <li class="chat-persons">
                                            <a href="#">
                                                <span class="pro-pic"><img src="{{get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}" alt=""></span>
                                                <div class="user">
                                                    <p class="u-name">{{Auth::user()->username}}</p>
                                                    <p class="u-name">{{ date('d F, Y - h:i A', strtotime($message->created_at)) }}</p>
                                                    <p class="u-designation">{{ $message->message }}</p>


                                                </div>
                                            </a>
                                            @if($message->attachments()->count() > 0)

                                                                                        @foreach($message->attachments as $k=>$image)
                                                                                            <a href="{{route('user.ticket.download',Crypt::encrypt($image->id))}}"
                                                                                               class="ml-4"><i
                                                                                                    class="fa fa-file-text-o"></i> {{++$k}} @lang('File Download')
                                                                                            </a>
                                                                                        @endforeach

                                                                                @endif
                                        </li>
                                    @elseif($message->type == 2)
                                        <!-- list person -->
                                        <li class="chat-persons">
                                            <a href="#">
                                                <span class="pro-pic"><img src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt=""></span>
                                                <div class="user">
                                                    <p class="u-name"> @lang('Admin')</p>
                                                    <p class="u-name">{{ date('d F, Y - h:i A', strtotime($message->created_at)) }}</p>
                                                    <p class="u-designation">{{ $message->message }}</p>
                                                </div>
                                            </a>
                                            @if($message->attachments()->count() > 0)
                                                                                    <div class="mt-2">
                                                                                        @foreach($message->attachments as $image)
                                                                                            <a href="{{route('user.ticket.download',encrypt($image->id))}}"
                                                                                               class="ml-4 btn btn-sm btn-success">
                                                                                                <i class="fa fa-download"></i></a>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endif
                                        </li>
                                    @endif
                                    @endforeach

                                    </ul>
                                    <!-- CHAT -->
								</div>
							</div>
							@if($my_ticket->status != 4)
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">@lang('Reply Ticket')</h3>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">

                                        <form method="post" action="{{ route('user.message.store', $my_ticket->id) }}"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

											<div class="form-group">


													<div class="col-sm-12">
													<label class="col-sm-12">Message</label>
														 <textarea name="message" required
                                                                                      class="form-control form-control-lg"

                                                                                      placeholder="@lang('Your Reply') ..."
                                                                                      rows="4" cols="10"></textarea>
													</div>

											</div>

											 <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <input type="file"
                                                                                           name="attachments[]"
                                                                                           id="inputAttachments"
                                                                                           class="form-control"/>
                                                                                    <div
                                                                                        id="fileUploadsContainer"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="btn btn-success btn-round"
                                                                                       onclick="extraTicketAttachment()">
                                                                                        <i class="fa fa-plus"></i> @lang('Add More')
                                                                                    </a>
                                                                                </div>
                                                                            </div>


									</div>
									<div class="card-footer d-sm-flex">

										<div class="btn-list ml-auto">
											<button type="button" data-toggle="modal"  style="background-color: {{$general->bclr}}" data-target="#DelModal" class="btn btn-danger btn-space "> <i class="fe fe-trash-2 text-white"></i> &nbsp;Close</button>
											<button type="submit" value="1" name="replayTicket" class="btn btn-primary btn-space"><i class="fe fe-send text-white "></i> &nbsp;Reply</button>
										</div>
									</div>
									</form>
									@endif
								</div>
							</div>
						</div>
						<!-- row closed -->
					</div>
				</div>
			</div>
			<!-- App-content closed -->


@endsection


@section('script')

    <script src="{{asset('assets/admin/js/simplemde.min.js')}}"></script>
    <script>
        var simplemde = new SimpleMDE({element: document.getElementById("inputMessage")});

        $(document).ready(function () {
            $('.card-body').scrollTop($('.card-body')[0].scrollHeight);
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            })

        });

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control mt-1" required />')
        }
    </script>

     <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" action="{{ route('user.message.store', $my_ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h4 class="modal-title"><i class='fa fa-exclamation-triangle'></i>
                            <strong> @lang('Confirmation')!</strong></h4>

                        <button type="button" class="close btn btn-sm" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong>@lang('Are you sure you want to Close This Support Ticket')?</strong>
                    </div>
                    <div class="modal-footer">

                        <button type="submit"  style="background-color: {{$general->bclr}}" class="btn btn-success btn-sm" name="replayTicket"
                                value="2"><i class="fa fa-check"></i> @lang("Confirm")
                        </button>
                        <button type="button"  style="background-color: {{$general->bclr}}"class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>
                            @lang('Close')
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>




@stop

