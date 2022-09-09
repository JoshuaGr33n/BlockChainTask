
@extends('include.auth')
@section('content')
 @if(!$user->status)
        <div class="rules-area my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-page main-page--style">
                            <div class="card-body my-3">
                                <p>
                                    {{__($page_title)}}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(!$user->ev)

<div id="main-wrapper">

    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-3">
                         <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{$page_title}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">
                            <p class="text-center mb-3">Enter the verification code sent to your email
                                {{auth()->user()->email}}</p>
                           <form method="POST" action="{{route('user.verify_email')}}" class="mb-4">
                            @csrf



                            <input type="email" name="email" hidden class="form-control" readonly value="{{auth()->user()->email}}">
                                <div class="col-12">
                                    <label class="form-label">Your Code</label>
                                    <div class="input-group">

                                    <input  name="email_verified_code" placeholder="@lang('Code')" class="form-control">
                                    </div>
                                      @if ($errors->has('email_verified_code'))
                                    <small class="text-danger">{{ $errors->first('email_verified_code') }}</small>
                                    @endif

                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-block"  style="background-color: {{$general->bclr}}">Verify Email</button>
                                </div>
                            </form>
                            <div class="new-account mt-3">
                                <p>Don't get code? <a class="text-primary" href="{{route('user.send_verify_code')}}?type=phone">Resend</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
 @elseif(!$user->sv)

<div id="main-wrapper">

    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-3">
                         <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{$page_title}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">
                            <p class="text-center mb-3">Enter the verification code sent to your phone number
                                {{auth()->user()->phone}}</p>
                           <form method="POST" action="{{route('user.verify_sms')}}" class="contact-form mb-4">
                        @csrf



                              <input type="text" name="mobile" hidden class="form-control" readonly value="{{auth()->user()->mobile}}">
                                <div class="col-12">
                                    <label class="form-label">Your Code</label>
                                    <div class="input-group">

                                   <input  name="sms_verified_code" placeholder="@lang('Code')" class="form-control">
                                @if ($errors->has('sms_verified_code'))
                                    <small class="text-danger">{{ $errors->first('sms_verified_code') }}</small>
                                @endif
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-block"  style="background-color: {{$general->bclr}}">Verify Phone</button>
                                </div>
                            </form>
                            <div class="new-account mt-3">
                                <p>Don't get code? <a class="text-primary" href="{{route('user.send_verify_code')}}?type=email">Resend</a></p>
                            </div>
                             @if ($errors->has('resend'))
                                            <br/>
                                            <small class="text-danger">{{ $errors->first('resend') }}</small>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
 @elseif(!$user->tv)

<div id="main-wrapper">

    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-3">
                         <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{$page_title}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">
                            <p class="text-center mb-3">@lang("Google Authenticator Code")</p>
                           <form class="contact-form" method="POST" action="{{route('user.go2fa.verify') }}">
                           @csrf
                              <input type="text" name="mobile" hidden class="form-control" readonly value="{{auth()->user()->mobile}}">
                                <div class="col-12">
                                    <label class="form-label">Enter Google 2FA Code</label>
                                    <div class="input-group">

                                   <input  name="code" placeholder="@lang('Enter Google Authenticator Code')" class="form-control">
                                @if ($errors->has('code'))
                                    <small class="text-danger">{{ $errors->first('code') }}</small>
                                @endif
                                    </div>
                                </div>
                                <div class="alert-text">
                                    <small>Security is critical in {{__($general->sitename)}}, we will require you to enter a security code every time you login to your account. To disable this, please disable Google Authentication from your settings page</small>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-block"  style="background-color: {{$general->bclr}}">Verify Me</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endif

@endsection
