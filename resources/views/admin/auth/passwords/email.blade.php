
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


                        <form action="{{ route('admin.password.reset') }}" method="POST" class="login-form">
                        @csrf

                                <label>Enter Your Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
                        <br>
                        <div class="btn-area text-center">
                            <button type="submit" class="btn btn-primary submit-btn"  style="background-color: {{$general->bclr}}">Send Reset Code</button>
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
