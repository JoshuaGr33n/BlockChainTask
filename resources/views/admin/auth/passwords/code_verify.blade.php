
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
                       Enter the verification code sent to your email


                         <form action="{{ route('admin.password.verify-code') }}" method="POST" class="login-form">
                    @csrf
                    <div class="login-inner-block">

                    <div class="frm-grp">
                        <h5 class="col-md-12 mb-3 text-center">Verification Code</h5>
                        <input type="text" class="form-control" id="pincode-input" name="code">
                    </div>

                    <div class="btn-area text-center"><br>
                        <button  style="background-color: {{$general->bclr}}" type="submit" class="btn btn-primary submit-btn">Verify Code</button><br>
                    </div>
                    <div class="d-flex mt-5 justify-content-center">
                            <a href="{{ route('admin.password.reset') }}" class="forget-pass">Try to send code again</a>
                        </div>
                </form>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
