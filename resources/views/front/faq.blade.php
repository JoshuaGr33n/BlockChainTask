
@extends('include.front')
@section('content')


 <div class="helpdesk-search section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="helpdesk-search-content">
                    <p class="mb-1">Frequently Asked Questions</p>
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

    <div class="terms_condition">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="terms_condition-content">
                     @foreach($faqs as $k=>$data)
                        <div class="terms_condition-text">
                            <h3>{{__($data->value->title)}}</h3>
                            <p>@php echo $data->value->body @endphp
                            </p>
                        </div>
                    @endforeach
                     </div>

                </div>
            </div>
        </div>
    </div>


@endsection
