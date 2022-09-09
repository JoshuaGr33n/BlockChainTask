
@extends('include.front')
@section('content')
  <div class="helpdesk-search section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="helpdesk-search-content">
                    <p class="mb-1">How can we help you today?</p>
                    <h2 class="mb-5">{{__($page_title)}}</h2>
                    <div class="helpdesk-form">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Search here">
                            <button type="submit" class="btn btn-primary"  style="background-color: {{$general->bclr}}">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="help-category section-padding">
    <div class="container">


         <div class="rules-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-page main-page--style">

                        @foreach($rules as $k=>$data)
                        <div class="card-body my-3">
                            <p>
                                <span class="rulse-number">{{++$k}}</span>
                                @php echo $data->value->body @endphp
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>



     <div class="ticket-box section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="ticket-box-content">
                        <h3>Can't find what you're looking for?</h3>
                        <p>Let us help you!</p>
                        <a href="{{route('home.contact')}}" class="btn btn-dark"  style="background-color: {{$general->bclr}}">Submit Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
