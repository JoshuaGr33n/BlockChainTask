
@extends('include.auth')
@section('content')

<div id="main-wrapper">
    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-4">
                        <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{$page_title}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">

                         @if($errors->any())
                    <ul>
                        @foreach($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                       @endif
                       Enter the verification code sent to {{$email}}


                        <form action="{{ route('user.password.verify-code') }}" method="POST" class="signin_validate row g-3"id="recaptchaForm">
                        @csrf

                                <div class="col-12">
                                    <input type="text" required  name="code" id="pincode-input" class="magic-label form-control">
                                </div>
                                 <input type="hidden" name="email" value="{{ $email }}">


                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}">@lang('Verify Code')</button>
                                </div>
                            </form>
                            <p class="mt-3 mb-0">Didn't get the code? <a class="text-primary" href="{{ route('user.password.request') }}">@lang('Try to send again')</a></p>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
