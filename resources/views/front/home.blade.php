
@extends('include.front')
@section('content')



    <div class="intro2 section-padding bg-darkd"  style="background-color: {{$general->bclr}}" id="intro">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="intro-content">
                    <h1 class="text-white">@php echo  __($homeContent->value->title) @endphp</h1>
                    <p class="text-white">@php echo  __($homeContent->value->details) @endphp</p>
                    <div class="intro-form">
                        <form class="subscribe-form" action="{{route('home.subscribe')}}" method="post">
                    @csrf


                            <input class="form-control"  type="email" name="email" placeholder="@lang('Subscribe For Newsletter')" required value="{{old('email')}}">
                            <button type="submit">
                                <i class="la la-arrow-right first"></i>
                                <i class="la la-arrow-right second"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
             <div class="intro-app-img">
                    <img src="{{asset('assets/images/frontend/'.$homeContent->value->image)}}" class="img-fluid"  alt="...">

                </div>

            </div>
        </div>
    </div>
</div>



    <div class="market section-padding page-section" data-scroll-index="1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>The World's Leading Cryptocurrency Wallet With Peer to Peer Trading</h2>
                    <p>Trade Bitcoin, ETH, and hundreds of other cryptocurrencies in minutes.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="market-table">
                    <div class="table-responsive">
                        <table class="table mb-0 table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Coin</th>
                                    <th>Seller</th>
                                    <th>Country</th>
                                    <th>Rate</th>
                                    <th>Market Cap</th>
                                    <th>Payment Method</th>
                                    <th>Trade</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($offer as $data)
                                <tr>
                                    <td>1</td>
                                    <td class="coin_icon">
                                       <img src="{{url('/')}}/back/images/crypto-currencies/square-color/{{App\Currency::whereId($data->coin_id)->first()->image ?? ''}}" width="20" alt="img" class="h-6 w-6">
                                        <span>&nbsp;{{App\Currency::whereId($data->coin_id)->first()->name ?? ""}}</span>
                                    </td>
                                      <td>

                                        <span>&nbsp;{{App\User::whereId($data->user_id)->first()->username ?? "Unknown User"}}</span>
                                    </td>

                                    <td>
                                        {{$data->country}}<br><small>{{$data->currency}}</small>
                                    </td>
                                    <td>
                                       <small> <span class="text-success">1USD = {{$data->rate}}{{$data->currency}}</span></small>
                                    </td>
                                    <td>
                                      <small>  <span class="text-primary">${{number_format($data->min,2)}} - ${{number_format($data->max,2)}}</span></small>
                                    </td>
                                    <td> {{App\Paymentmethod::whereId($data->payment_method)->first()->name ?? "N/A"}}</td>
                                    <td><a href="{{route('user.viewoffer',$data->code)}}"  style="background-color: {{$general->bclr}}" class="btn btn-success">Buy</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table> {{$offer->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    <div class="info bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-star"></i></span>
                    <h4>Best rates on the market</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-heart"></i></span>
                    <h4>Transparent 0.25% fee</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-clock"></i></span>
                    <h4>5-30 min transactions</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-cash"></i></span>
                    <h4>High exchange limits</h4>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="info-content">
                    <span><i class="bi bi-headset"></i></span>
                    <h4>24/7 live chat support</h4>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="product-feature section-padding">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="section-title">
                            <h2 class="text-start">24-hour statistics</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere odit fuga nesciunt
                                similique rerum nulla asperiores ullam deserunt architecto inventore.</p>
                        </div>
                        <div class="product-feature-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="product-feature-text">
                                        <h4><span><i class="bi bi-person"></i></span> 27 %</h4>
                                        <p>New users</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="product-feature-text">
                                        <h4><span><i class="bi bi-people"></i></span> 73 %</h4>
                                        <p>Regular users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-prismary"  style="background-color: {{$general->bclr}}"><i class="bi bi-cash-stack"></i></span>
                                    <h4>1900</h4>
                                    <p>Transactions made</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-secondasry"  style="background-color: {{$general->bclr}}"><i class="bi bi-trophy"></i></span>
                                    <h4>ETH-BTC</h4>
                                    <p>Today's champion pair</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-successs"  style="background-color: {{$general->bclr}}"><i class="bi bi-people"></i></span>
                                    <h4>27 150</h4>
                                    <p>Visits today</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="product-feature-box">
                                    <span class="bg-infso"  style="background-color: {{$general->bclr}}"><i class="bi bi-clock"></i></span>
                                    <h4>14.0 minutes</h4>
                                    <p>Average processing time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="new-product section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <h2>So, What brings new product today?</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="new-product-content">
                    <img class="img-fluid" src="{{url('/')}}/front/images/svg/api.svg" alt="">
                    <h4>Integrate our API</h4>
                    <p>A white-label solution for your project, whether it is a wallet, a marketplace or a
                        service provider. Set it up to accept any of 140+ cryptocurrencies listed on {{$set->sitename}}
                        and get revenue for each transaction made.</p>
                    <a href="#" class="btn btn-dark px-4">Learn more</a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="new-product-content">
                    <img class="img-fluid" src="{{url('/')}}/front/images/svg/affiliate.svg" alt="">
                    <h4>Join our Affiliate Program</h4>
                    <p>Place an affiliate link or customizable widget on your website, blog or social media
                        profile. Get 50% of our revenue from every transaction made via either of the tools
                        used.
                    </p>
                    <a href="#" class="btn btn-outline-dark px-4">Become an affiliate</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="trust section-padding">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="section-title">
                    <h2>Our Services</h2>
                </div>
            </div>
        </div>
        <div class="row">



            @foreach($services as $data)

            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="trust-content">
                    <span><img src="{{get_image(config('constants.frontend.services.path').'/'.$data->value->image)}}" width="30" alt="{{__($data->value->title)}}"></span>
                    <h4>{{__($data->value->title)}}</h4>
                    <p>{{__($data->value->details)}}
                    </p>
                </div>
            </div>
         @endforeach
        </div>
    </div>
</div>



    <div class="appss section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-5 col-lg-5 col-md-12">
                <div class="appss-img">
                    <img class="img-fluid" src="{{url('/')}}/front/images/block3.png" alt="">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="appss-content">
                    <h3>Mobile app</h3>
                    <p>Get the best mobile app to exchange or buy crypto on the go:</p>
                    <ul>
                        <li><i class="la la-check"></i> Best rates on the market</li>
                        <li><i class="la la-check"></i> High limits</li>
                        <li><i class="la la-check"></i> No verification for exchange transactions</li>
                        <li><i class="la la-check"></i> More than 150 cryptocurrencies</li>
                        <li><i class="la la-check"></i> Buy bitcoin | buy crypto with USD, EUR or GBP</li>
                    </ul>
                    <div class="mt-4">
                        <a href="index2.html#"  style="background-color: {{$general->bclr}}" class="btn btn-success my-1 waves-effect">
                            <img src="{{url('/')}}/front/images/android.svg" alt="">
                        </a>
                        <a href="index2.html#"  style="background-color: {{$general->bclr}}" class="btn btn-success  my-1 waves-effect">
                            <img src="{{url('/')}}/front/images/apple.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="intro1 section-padding">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-6 col-12">
                <div class="intro-content">
                    <h1 class="text-dark">Trade with <strong class="text-primary">{{$set->sitename}}</strong>. <br> Buy and
                        sell
                        cryptocurrency
                    </h1>
                    <p>Fast and secure way to purchase or exchange  style="background-color: {{$general->bclr}}"  cryptocurrencies</p>

                    <div class="intro-btn">
                        <a href="#"  style="background-color: {{$general->bclr}}" class="btn btn-primary btn-sm py-2 px-3 me-3 shadow-sm">Get Started</a>
                        <a href="#" class="btn btn-outline-dark btn-sm py-2 px-3 shadow-sm">Browse Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="intro-form-exchange">
                    <form method="post" name="myform" class="currency_validate trade-form row g-3">
                        <div class="col-12">
                            <label class="form-label">Send</label>
                            <div class="input-group">
                                <select class="form-control" name="method">
                                    <option value="bank">USD</option>
                                    <option value="master">Euro</option>
                                </select>
                                <input type="text" name="currency_amount" class="form-control" placeholder="0.0214 BTC">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Receive</label>
                            <div class="input-group">
                                <select class="form-control" name="method">
                                    <option value="bank">BTC</option>
                                    <option value="master">ETH</option>
                                </select>
                                <input type="text" name="currency_amount" class="form-control" placeholder="0.0214 BTC">
                            </div>
                        </div>

                        <p class="mb-0">1 USD ~ 0.000088 BTC <a href="index.html#">Expected rate <br>No extra
                                fees</a></p>
                        <button type="button"  style="background-color: {{$general->bclr}}" class="btn btn-primary ">
                            Buy Now
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="getstart section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title">
                    <h2>Get started in a few minutes</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-person"></i></span>
                    <h3>Create an account</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.</p>
                    <a href="register#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-pencil-square"></i></span>
                    <h3>Link your bank account</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.</p>
                    <a href="login#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="getstart-content">
                    <span><i class="bi bi-cash"></i></span>
                    <h3>Start buying & selling</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, corporis.</p>
                    <a href="login#">Explore <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="portfolio section-padding">
    <div class="container">
        <div class="row py-lg-5 justify-content-center">
            <div class="col-xl-7">
                <div class="section-title text-center">
                    <h2 class="text-dark">Create your cryptocurrency wallet today</h2>
                    <p>{{$set->sitename}} has a variety of features that make it the best place to start
                        trading and keeping your cryptos</p>
                        <i class="bi-wallet"></i>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_list">
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-person-check"></i></span>
                        <div class="media-body">
                            <h4>Manage your portfolio</h4>
                            <p>Buy and sell popular digital currencies, keep track of them in the one
                                place.
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-bag-check"></i></span>
                        <div class="media-body">
                            <h4>Recurring buys</h4>
                            <p>Invest in cryptocurrency slowly over time by scheduling buys daily,
                                weekly,
                                or monthly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_imsg">
                    <img src="{{url('/')}}/front/images/block2.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="portfolio_list">
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-shield-check"></i></span>
                        <div class="media-body">
                            <h4>Vault protection</h4>
                            <p>For added security, store your funds in a vault with time delayed
                                withdrawals.
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <span class="port-icon"> <i class="bi bi-phone"></i></span>
                        <div class="media-body">
                            <h4>Mobile apps</h4>
                            <p>Stay on top of the markets with the {{$set->sitename}} app for <a href="#">Android</a>
                                or
                                <a href="#">iOS</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
