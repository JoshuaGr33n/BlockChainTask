
@extends('include.front')
@section('content')
 <div class="about-one section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5">
                <div class="service-content m-t-50">
                    <h2 class="mb-4">We are {{$set->sitename}}, </h2>
                    <p>A multidisciplinary crypto wallet system with peer to peer trading
                    feature</p>
                    <a  style="background-color: {{$general->bclr}}" href="#" class="btn btn-primary my-4">Get in Touch</a>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-img">
                    <img src="{{url('/')}}/front/images/about/1.jpeg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="bg-light py-6 py-lg-8 mt-6 mt-lg-0 section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">

                <h2 class="font-weight-normal mt-4">
                   {{__(@$about->value->title)}}
                </h2>

                <p class="text-muted mt-4">
                    @php echo __($about->value->details) @endphp
                </p>
            </div>

            <div class="col-lg-7 offset-lg-1 mt-4 mt-lg-0">
                <div class="row g-0">
                    <div class="col-6 bg-white text-purple text-center py-5 py-md-7">
                        <h1 class="display-3">
                            30k
                        </h1>
                        <p class="m-0">
                            paying customers
                        </p>
                    </div>

                    <div  style="background-color: {{$general->bclr}}" class="col-6 bg-purplse text-center py-5 py-md-7">
                        <h1 class="display-3 text-white">
                            $100m
                        </h1>
                        <p class="m-0">
                            in funding
                        </p>
                    </div>

                    <div  style="background-color: {{$general->bclr}}" class="col-6 bg-purpsle text-center py-5 py-md-7">
                        <h1 class="display-3 text-white">
                            2012
                        </h1>
                        <p class="m-0">
                            founded
                        </p>
                    </div>

                    <div class="col-6 bg-white text-purple text-center py-5 py-md-7">
                        <h1 class="display-3">
                            99.8%
                        </h1>
                        <p class="m-0">
                            uptime
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="about-two section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="service-content my-5">
                    <h3>Working at {{$set->sitename}}</h3>
                    <p>Digital currencies are changing how we use and think about money. Tendex, the most
                        trusted
                        company in the space, is looking for you to join our rapidly growing team.</p>
                    <a  style="background-color: {{$general->bclr}}" href="about.html#" class="btn btn-primary">Read more</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-img">
                    <img src="{{url('/')}}/front/images/about/1.jpg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
