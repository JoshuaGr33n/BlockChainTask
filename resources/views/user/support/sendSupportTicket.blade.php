@extends('include.user')

@section('content')
   <div class="">
							<div class="card big-deal onsale">
								<div class="card-body p-4 text-white">
									<div class="row">
										<div class="col-xl-8 col-lg-12 col-md-12">
											<div class="d-sm-flex">
												<img src="{{url('/')}}/back/images/svg/wallet.svg" alt="" class="h-120">
												<div class="ml-4">
													<h4 class="text-uppercase mb-0 mt-1">Active Tickets: {{App\SupportTicket::where('user_id', Auth::id())->whereStatus(0)->latest()->count()}}</h4>
													<h4 class="text-uppercase mb-0 mt-1">Closed Ticket:  {{App\SupportTicket::where('user_id', Auth::id())->whereStatus(3)->latest()->count()}}</h4>
													<p class="mt-2 mb-0">To speak with anu of our customers' service representative, please use our list of phone numbers on our contact us page</p>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- Banner closed -->


                <div class="col-xl-12 card col-lg-12 col-md-12 col-sm-12">
                                    <br>
               							<div class="card-title">{{__($page_title)}}</div>
               						<br>

                    <div class="dashboard-content">

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="dashboard-inner-content">


                                            <form  action="{{route('user.ticket.store')}}" role="form" method="post" enctype="multipart/form-data" id="recaptchaForm">
                                                {{csrf_field()}}
                                                        <input type="text"  hidden name="name" value="{{$user->firstname . ' '.$user->lastname}}" class="form-control" placeholder="@lang('Enter Name')" required readonly>
                                                        <input type="email"  hidden name="email" value="{{$user->email}}" class="form-control " placeholder="@lang('Enter your Email')" required readonly>

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="website">@lang('Subject')</label>
                                                        <input type="text" name="subject" value="{{old('subject')}}" class="form-control " placeholder="@lang('Subject')" >
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="hep">@lang('Department')</label>
                                                        <select class="form-control required" name="department" required>
                                                            @foreach($topics as $topic)
                                                                <option value="{{$topic->id}}">{{$topic->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="hep">@lang('Priority')</label>
                                                        <select class="form-control required" name="priority" required>
                                                            <option value="medium">@lang('Medium')</option>
                                                            <option value="high">@lang('High')</option>
                                                            <option value="low">@lang('Low')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <label for="inputMessage">@lang('Message')</label>
                                                        <textarea name="message" id="inputMessage" rows="12" class="form-control">{{old('message')}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-sm-12">
                                                        <label for="inputAttachments">@lang('Attachments')</label>
                                                    </div>
                                                    <div class="col-sm-9 file-upload">
                                                        <input type="file" name="attachments[]" id="inputAttachments" class="form-control" />
                                                        <div id="fileUploadsContainer"></div>
                                                    </div>



                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-primary" onclick="extraTicketAttachment()">
                                                            <i class="fa fa-plus"></i> @lang('Add More')
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-12 ticket-attachments-message text-danger">
                                                        @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx")
                                                    </div>
                                                </div>


                                                    <div class="col-md-8">
                                                        <button class="btn btn-primary" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Create Ticket')</button>


                                                    </div>
                                                    <br>

                                            </form>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>




    <div class="sec-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec"></div>
                </div>
            </div>
        </div>
    </div>


    @if($plugins[2]->status == 1)
        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
        @php echo recaptcha() @endphp
    @endif
@endsection


@section('script')
    <script>
        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control mt-1" required />')
        }
        function formReset() {
            window.location.href = "{{url()->current()}}"
        }
    </script>
@endsection
