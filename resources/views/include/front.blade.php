<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename($page_title) }}</title>
    @include('partials.seo')
    <link rel="icon" href="{{get_image(config('constants.logoIcon.path') .'/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" type="image/png" href="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}"/>

    <!-- Custom Stylesheet -->
     @include('partials.notify-css')

    <link rel="stylesheet" href="{{url('/')}}/front/css/style.css?color={{ $general->bclr}}"">
</head>

<body class="@@dashboard">

<div id="preloader"><i>.</i><i>.</i><i>.</i></div>

<div id="main-wrapper">

    <div class="header landing bg-darks light"  style="background-color: {{$general->bclr}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="navigation">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="brand-logo">
                            <a href="{{url('/')}}">
                                <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt="" width="50" class="logo-primary">
                                <img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt=""   width="50"  class="logo-white">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon text-white"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto">

                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('home')}}">Home
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('home.about')}}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('home.rules')}}">Terms</a>
                                </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{route('home.blog')}}">Blog</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Support
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('home.contact')}}">Contact</a>
                                        <a class="dropdown-item" href="{{route('home.faq')}}">FAQ</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Privacy & Policy
                                    </a>
                                    <div class="dropdown-menu">
                                    @foreach($company_policy as $policy)
                                        <a class="dropdown-item" href="{{route('home.policy',[$policy, str_slug($policy->value->title)])}}"> {{__($policy->value->title)}}</a>
                                    @endforeach
                                    </div>
                                </li>

                            </ul>
                        </div>
                         @guest
                        <div class="signin-btn">
                            <a class="btn btn-success" href="{{route('user.login')}}">Sign in</a>
                        </div>
                        &nbsp;
                        <div class="signin-btn">
                            <a class="btn btn-info" href="{{route('user.register')}}">Register</a>
                        </div>
                        @else

                        <div class="signin-btn">
                            <a class="btn btn-success" href="{{route('user.home')}}">Dashboard</a>
                        </div>
                         &nbsp;
                        <div class="signin-btn">
                            <a class="btn btn-danger" href="{{route('user.logout')}}">Logout</a>
                        </div>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


@yield('content')

   <div class="bottom section-padding"  style="background-color: {{$general->bclr}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="bottom-logo">
                    <img class="pb-3" src="{{url('/')}}/assets/images/logoicon/logo.png" alt="" width="50">

                    <p class="text-white">{{__($general->sitename)}}. is a unique and modern way to trade  and store cryprocurrency</p>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Company</h4>
                    <ul>
                        <li><a  class="text-white" href="{{route('home.about')}}">About</a></li>
                        <li><a class="text-white" href="#">Affiliate</a></li>
                        <li><a  class="text-white"href="{{route('home.rules')}}">Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Support</h4>
                    <ul>
                        <li><a class="text-white" href="{{route('home.faq')}}">FAQ</a></li>
                        <li><a class="text-white" href="{{route('home.blog')}}">Blog</a></li>
                        <li><a class="text-white" href="{{route('home.contact')}}">Helpdesk</a></li>
                    </ul>
                </div>
            </div>

             <div class="col-xl-2 col-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">API</h4>
                    <ul>
                        <li><a class="text-white" href="#">Ticket</a></li>
                        <li><a class="text-white" href="{{route('home.faq')}}">Request API</a></li>
                        <li><a class="text-white" href="{{route('home.blog')}}">API Doc.</a></li>
                    </ul>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

    <div class="footer"  style="background-color: {{$general->bclr}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="copyright">
                    <p class="text-white"> {{date('Y')}} {{__($general->sitename)}}. @lang('All rights reserved')</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="footer-social">
                    <ul>
                     @foreach($socials as $data)
                        <li><a href="{{$data->value->url}}" target="_blank"
                               title="{{$data->value->title}}">@php echo $data->value->icon  @endphp</a></li>
                    @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- <div class="cookie_alert">

        <div class="alert alert-light fade show">
            <i class="la la-close" data-dismiss="alert"></i>
            <p>
                We use cookies to enhance your experience. By using Tendex, you agree to our <a href="#">Terms of
                    Use</a> and <a href="#">Privacy
                    Policy</a>
            </p>
            <button class="btn btn-success btn-block">Accept</button>
        </div>
    </div> -->





<script src="{{url('/')}}/front/vendor/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>












<script src="{{url('/')}}/front/vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="{{url('/')}}/front/js/plugins/sparkline-init.js"></script>







<script src="{{url('/')}}/front/js/scripts.js"></script>

@include('partials.notify-js')
@yield('script')
@yield('javascript')
@stack('js')
<script>
    $(document).on("change", ".langSel", function() {
        window.location.href = "{{url('/')}}/change-lang/"+$(this).val() ;

    });
</script>


@php
    if($plugins[1]->status == 1){
        $appKeyCode = $plugins[1]->shortcode->app_key->value;
        $twakTo = str_replace("{{app_key}}",$appKeyCode,$plugins[1]->script);
        echo $twakTo;
    }
@endphp

</body>

</html>
