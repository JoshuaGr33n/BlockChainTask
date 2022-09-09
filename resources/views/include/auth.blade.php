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

<script src="{{url('/')}}/front/js/countries.js"></script>
    <link rel="stylesheet" href="{{url('/')}}/front/css/style.css"">
</head>

<body class="@@dashboard">

<div id="preloader"><i>.</i><i>.</i><i>.</i></div>



@yield('content')



    <div class="footer"  style="background-color: {{$general->bclr}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="copyright text-white">
                    <p> {{date('Y')}} {{__($general->sitename)}}. @lang('All rights reserved')</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="footer-social">
                    <ul>
                     @foreach($socials as $data)
                        <li><a href="{{$data->value->url}}" target="_blank" class="text-white"
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
<script src="{{url('/')}}/front/js/scripts.js"></script>
@include('partials.notify-js')
@yield('javascript')


 <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <script type="text/javascript">

                            var onloadCallback = function() {
                                grecaptcha.render("recaptcha", {
                                    "sitekey" : "6LfvhYQaAAAAAHq8eHvQ0pAbZVUO1DpViFJN_jAT",
                                    "callback": function(token) {
                                        $("#recaptcha").parents("form:first").submit();
                                    } 
                                });
                            };
                        </script>
                        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>


</body>

</html>
