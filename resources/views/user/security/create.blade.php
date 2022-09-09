@extends('include.user')

@section('content')
    <!-- row opened -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="product-singleinfo">
											<div class="row">
												<div class="col-lg-4 col-xl-3 col-12">
													<div class="product-item text-center">
														<img src="{{$qrCodeUrl}}" alt="img">
													</div>
												</div>
												<div class="col-lg-8 col-xl-6 col-12">
													<div class="product-item2-desc">
														<h4 class="font-weight-semibold fs-20"><a href="#">Google 2 Factor Authentication</a></h4>
														<ul class="product-item2-rating">
															<li>
															@if(Auth::user()->ts)
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<a href="#"><i class="fa fa-star text-primary"></i></a>
																<div class="label-rating">Enabled</div>
															@else
															<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<div class="label-rating">Disabled</div>
															@endif
															</li>
														</ul>

														<p class="text-muted">@lang('Use Google Authenticator to Scan the QR code  or use the copy code to Google Authentication App')</p>
														<dl class="product-item2-align">
															<dt>2FA Code</dt>
															<div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="key" value="{{$secret}}"
                                                           class="form-control form-control-lg" id="referralURL"
                                                           readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text copytext" id="copyBoard"
                                                              onclick="myFunction()"> <i class="fa fa-copy text-primary"></i> </span>
                                                    </div>
                                                </div>
                                            </div>
														</dl>

													</div>
												</div>
												<div class="col-lg-12 col-xl-3 col-12 border-left">
													<div class="product-ship"><br>
														<p>
														    @if(Auth::user()->ts)
															<a href="#0"  class="btn btn-danger"  data-toggle="modal" data-target="#disableModal">@lang('Disable Google 2FA')</a>
															@else
															 <a href="#0" class="btn btn-success" data-toggle="modal" data-target="#enableModal">@lang('Enable Google 2FA')</a>
															@endif
														</p>
														<a href="#" class="fs-18"> <i class="fa fa-android text-success mr-1"></i> Download App</a>
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
			
			
			

    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Google OTP')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="{{route('user.go2fa.create')}}" method="POST">
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"  style="background-color: {{$general->bclr}}">@lang('Verify')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Google OTP to Disable')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.disable.2fa')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success "  style="background-color: {{$general->bclr}}">@lang('Verify')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script>
        function myFunction() {
            var copyText = document.getElementById("referralURL");
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
