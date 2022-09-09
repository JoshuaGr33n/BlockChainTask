
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


                        <form action="{{ route('user.login') }}" method="POST" class="signin_validate row g-3"id="recaptchaForm">
                        @csrf

                                <div class="col-12">
                                    <input type="text" id="exampleInputUsername"  name="username" value="{{old('username')}}" class="form-control" placeholder="@lang('Enter Username')" >
                                </div>
                                <div class="col-12">
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="@lang('Enter Password')">
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="remember"  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                            me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{route('user.password.request')}}">Forgot Password?</a>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}">Sign in</button>
                                </div>
                                
                                 <input class="form-check-input" name="g-recaptcha-response" value="true"  hidden >
                                
                                <div class="g-recaptcha" data-sitekey="6Ldpn6YeAAAAAB8VPeDV9OxJuMq6t_q2hXccJ_YQ" ></div>
                            </form>
                            <p class="mt-3 mb-0">Don't have an account? <a class="text-primary" href="{{ route('user.register') }}">Sign
                                    up</a></p>
                        </div>
                        @section('javascript')
                        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        @php echo recaptcha() @endphp
                        
                        
    
                        @endsection

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
