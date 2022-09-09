
@extends('include.front')
@section('content')


 <div class="helpdesk-search section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="helpdesk-search-content">
                    <p class="mb-1">Privacy</p>
                    <h2 class="mb-5">{{__($page_title)}}</h2>

                </div>
            </div>
        </div>
    </div>
</div>
    <div class="privacy-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-page main-page--style">
                        <div class="card-body my-3">
                            <p>@php echo $menu->value->body @endphp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
