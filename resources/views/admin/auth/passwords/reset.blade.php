
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


                      <form action="{{ route('admin.password.change') }}" method="POST" class="login-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="login-inner-block">
                    <div class="frm-grp">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="frm-grp">
                        <label>Retype New Password</label>
                        <input type="password"  class="form-control"  name="password_confirmation" required>
                    </div>
                    </div>
                    <div class="btn-area"><br>
                        <button  style="background-color: {{$general->bclr}}" type="submit" class="btn btn-primary submit-btn">Reset Password</button>
                    </div>
                    <div class="d-flex mt-5 justify-content-center">
                        <a href="{{ route('admin.login') }}" class="forget-pass">Login Here</a>
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
