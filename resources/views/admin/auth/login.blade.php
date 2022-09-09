
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


                         <form action="{{ route('admin.login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="login-inner-block">
                        <div class="frm-grp">
                            <label>Username</label>
                            <input type="text" name="username"  class="form-control"  value="{{ old('username') }}" placeholder="Enter your username">
                        </div>
                        <div class="frm-grp">
                            <label>Password</label>
                            <input type="password" name="password"  class="form-control"  placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="d-flex mt-3 justify-content-between">
                        <div class="frm-group">
                            <input type="checkbox" name="remember" id="checkbox">
                            <label for="checkbox">Remember Me</label>
                        </div>
                        <a href="{{ route('admin.password.reset') }}" class="forget-pass">Forgot password?</a>
                    </div>
                    <div class="btn-area text-center">
                    <button type="submit" class="btn btn-primary submit-btn"  style="background-color: {{$general->bclr}}">Login now</button>
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
