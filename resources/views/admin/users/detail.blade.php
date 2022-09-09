@extends('include.admin')

@section('content')
<div class="row">
   <div class="col-lg-4">
        <div class="card">

										<div class="card-body">
											<div class="text-center">
												<div class="userprofile">
													<div class="userpic  brround mb-3"> <img src="{{ get_image(config('constants.user.profile.path') .'/'. $user->image) }}" alt="" class="userpicimg brround" width="100"> </div>
													<h3 class="username mb-2">{{ $user->name }}</h3>
													<p class="mb-1 text-muted">{{ $user->username }}, {{ $user->address->country ?? "" }}</p>
													<div class="text-center mb-4">
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star text-warning"></i></span>
														<span><i class="fa fa-star-half-o text-warning"></i></span>
														<span><i class="fa fa-star-o text-warning"></i></span>
													</div>
													<div class="socials text-center mt-3">
														 <a data-toggle="modal" href="#addSubModal" class="btn btn-circle btn-primary ">
														<i class="fa fa-bank"></i></a>
														<a href="{{ route('admin.users.login.history.single', $user->id) }}" class="btn btn-circle btn-info "><i class="fa fa-lock"></i></a>
														<a href="{{ route('admin.users.email.single', $user->id) }}" class="btn btn-circle btn-info "><i class="fa fa-envelope"></i></a>
													</div>

                    <br>
                     @foreach($user->wallets as $wallet)
                    <div class="card outline-danger">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-primary">{{ $general->cur_sym }}{{ formatter_money($wallet->balance) }}</h4>
                                <span class="text-primary">{{str_replace('_',' ',strtoupper($wallet->type))}}</span>
                            </div>
                            <div class="align-self-center icon-lg">
                               <h3> <i class="fa fa-bank text-primary"></i></h3>
                            </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    <div class="card outline-danger">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-danger">{{ $general->cur_text}} {{ formatter_money($withdrawals->total) }}</h4>
                                <span class="text-danger">Total Withdrawal</span>
                            </div>
                            <div class="align-self-center icon-lg">
                             <a href="{{ route('admin.users.withdrawals', $user->id) }}" >
                               <h3> <i class="fa fa-shopping-cart text-danger"></i></h3>
                            </a>
                            </div>
                            </div>
                        </div>

                    </div>

                    <div class="card outline-success">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-success">{{ $general->cur_text}} {{ formatter_money($deposits->total) }}</h4>
                                <span class="text-success">Total Deposit</span>
                            </div>
                            <a href="{{ route('admin.users.deposits', $user->id) }}">
                            <div class="align-self-center icon-lg">
                               <h3> <i class="fa fa-bank text-success"></i></h3>
                            </div>
                            </a>
                            </div>
                        </div>

                    </div>

                    <div class="card outline-success">
                        <div class="card-body">
                            <div class="media align-items-center">
                            <div class="media-body text-left">
                                <h4 class="mb-0 text-success">{{ $transactions }}</h4>
                                <span class="text-success">Total Transaction</span>
                            </div>
                            <div class="align-self-center icon-lg">
                            <a href="{{ route('admin.users.transactions', $user->id) }}">
                               <h3> <i class="fa fa-bank text-success"></i></h3>
                            </a>
                            </div>
                            </div>
                        </div>

                    </div>


												</div>
											</div>
										</div>
									</div></div>
    <div class="col-lg-8">
        <div class="card">
        <div class="card-header">
										<div class="card-title">Update Account</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>

            <div class="row p-4">




            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="firstname" value="{{ $user->firstname }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <label>Address</label>
                        <br>
                        <small>Street</small>
                        <input class="form-control" type="text" value="{{ $user->address->address }}" name="address" placeholder="Street">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <small>City</small>
                            <input class="form-control" type="text" value="{{ $user->address->city }}" name="city" placeholder="City">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>State</small>
                            <input class="form-control" type="text" value="{{ $user->address->state }}" name="state" placeholder="State">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>Zip/Postal</small>
                            <input class="form-control" type="text" value="{{ $user->address->zip }}" name="zip" placeholder="Zip/Postal">
                        </div>
                        <div class="form-group col-lg-3">
                            <small>Country</small>
                            <select name="country" class="form-control"> @include('partials.country') </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <p class="text-muted">Activate Account</p>
                            <label class="custom-switch">
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"  class="custom-switch-input"  data-toggle="toggle" data-onstyle="success"    data-offstyle="danger" data-on="Active" data-off="Banned"  data-width="100%" name="status" @if($user->status) checked @endif>

													<span class="custom-switch-indicator"></span>

												</label>

                        </div>

                        <div class="form-group col-lg-4">
                            <p class="text-muted">Verify Email</p>
                             <label class="custom-switch">
                              <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"  class="custom-switch-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Verified" data-off="Unverified" name="ev" @if($user->ev) checked @endif>

													<span class="custom-switch-indicator"></span>

												</label>

                        </div>

                        <div class="form-group col-lg-4">
                            <p class="text-muted">Verify Phone</p>
                             <label class="custom-switch">
                              <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"  class="custom-switch-input"  data-on="Verified" data-off="Unverified" name="sv" @if($user->sv) checked @endif>

													<span class="custom-switch-indicator"></span>

												</label>

                        </div>

                        <div class="form-group col-lg-6">
                            <p class="text-muted">Google 2FA Status</p>
                             <label class="custom-switch">
                             <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"  class="custom-switch-input" data-on="On" data-off="Off" name="ts" @if($user->ts) checked @endif>

													<span class="custom-switch-indicator"></span>

												</label>


                        </div>

                        <div class="form-group col-lg-6">
                            <p class="text-muted">Google 2FA Verification</p>
                             <label class="custom-switch">
                             <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"  class="custom-switch-input"  data-on="Verified" data-off="Unverified" name="tv" @if($user->tv) checked @endif>

													<span class="custom-switch-indicator"></span>

												</label>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-lg-12 text-left">
                            <input type="submit" class="btn  btn-primary mt-2" value="Save Changes">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Sub Balance MODAL --}}
<div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add / Subtract Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.addSubBalance', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">


                        <div class="form-group col-md-12">
                            <label>Select Wallet<span class="text-danger">*</span></label>
                            <select name="wallet_id" class="form-control" required>
                                @foreach($user->wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{str_replace('_',' ',strtoupper($wallet->type))}}</option>
                                @endforeach
                            </select>


                        </div>
                        <div class="form-group col-md-12">
                            <label>Amount<span class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <input type="text" name="amount" class="form-control" placeholder="Please provide positive amount">
                                <div class="input-group-append"><div class="input-group-text">{{ $general->cur_sym }}</div></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                         <small>Toggle On To Credit Account & Toggle Off to Debit Balance</small><br>
                        <label class="custom-switch">

                         <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" class="custom-switch-input"  data-on="Add Balance" data-off="Subtract Balance" name="act" checked>
                            <span class="custom-switch-indicator"></span>

												</label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Send Email MODAL --}}
<div id="sendEmailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.users.email.single', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Subject<span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control" placeholder="Email Subject">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Message<span class="text-danger">*</span></label>
                            <textarea rows="5" name="message" class="form-control nicEdit" placeholder="Your Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div></div>
@endsection


@section('javascript')
<script>
$("select[name=country]").val("{{ $user->address->country }}");
</script>
@endsection
