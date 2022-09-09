
@extends('include.auth')
@section('content')


<div id="main-wrapper">
    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-8 col-md-6">
                    <div class="mini-logo text-center my-4">
                        <a href="{{url('/')}}"><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" width="100" alt=""></a>
                        <h4 class="card-title mt-5">{{__($page_title)}}</h4>
                    </div>
                    <div class="auth-form card">
                        <div class="card-body">
                                 <form class="signin_validate row g-3" action="{{ route('user.register') }}" method="post">
                                  @csrf
                                @isset($reference)
                                 <div class="col-12">
                                  <label for="inputEmail3" class="col-sm- col-form-label">@lang('Referred By')</label>
                                    <input type="text" name="referBy"  class="form-control" id="referenceBy" value="{{$reference}}" placeholder="@lang('Reference BY')" readonly/>
                                 </div>
                                @endisset


                                <div class="col-6">

                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter First Name')</label>
                                   <input type="text" class="form-control" id="InputFirstname" name="firstname" placeholder="@lang('First Name')" value="{{old('firstname')}}" required="">
                                </div>
                                <div class="col-6">

                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Last Name')</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="@lang('Last Name')" value="{{old('lastname')}}" required="">
                                </div>

                                <div class="col-6">

                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Username')</label>
                                  <input type="text" class="form-control" id="username" name="username" placeholder="@lang('Username')"  value="{{old('username')}}" required="">
                                </div>
                                <div class="col-6">

                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Email')</label>
                                     <input type="email" class="form-control" id="email" name="email" placeholder="@lang('E-mail Address')"  value="{{old('email')}}" required="">
                                </div>

                                <div class="col-6">
                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Country')</label>
                                   <select onchange="print_state('state', this.selectedIndex);" id="country"    name="country"  class="form-control form-control-lg"/></select>
                                            <script language="javascript">print_country("country");</script>
                                </div>
                                <div class="col-6">
                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Phone')</label>
                                     <input type="tel"  class="form-control pranto-control" id="phone"  name="mobile"  value="{{old('mobile')}}" placeholder="@lang('Your Contact Number')" required>
                                </div>

                                <div class="col-6">
                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Enter Password:')</label>
                                   <input type="password" class="form-control" id="inputEmail3" name="password" placeholder="Password" required="">
                                </div>
                                <div class="col-6">
                                 <label for="inputEmail3" class="col-sm- col-form-label">@lang('Retype Password:')</label>
                                     <input type="password" class="form-control" id="inputEmail3" name="password_confirmation" placeholder="Retype Password" required="">
                                </div>


                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" required  type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            I certify that i agree to the <a href="{{route('home.rules')}}"
                                                class="text-primary">User Agreement</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}">Create account</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="mt-3 mb-0"> <a class="text-primary" href="{{ route('user.login') }}">Sign in</a> to your
                                    account</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

<script src="{{url('/')}}/front/js/countries.js"></script>


@endsection
