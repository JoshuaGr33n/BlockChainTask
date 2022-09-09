
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


                       <form action="{{ route('user.password.update') }}" method="POST" class="login-form">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <h2 class="text-center text-white pb-4 text-uppercase"> @lang('Reset Password')</h2>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">@lang('New Password:')</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" placeholder="@lang('New Password')" name="password" required="" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">@lang('Retype New Password:')</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_confirmation" placeholder="@lang('Confirm Password')" name="password_confirmation" required="" value="">
                    </div>
                </div>

                <div class="form-group row pt-5">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-default website-color"  style="background-color: {{$general->bclr}}">@lang('Reset Password')</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 col-12 text-center">
                        <div class="remember mr-5">
                            <label class="form-check-label" for="gridCheck1">

                                <a href="{{ route('user.login') }}" >@lang('Login Here')</a>
                            </label>
                        </div>
                    </div>
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
