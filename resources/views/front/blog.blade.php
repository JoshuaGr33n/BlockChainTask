
@extends('include.front')
@section('content')


 <div class="helpdesk-search section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="helpdesk-search-content">
                    <p class="mb-1">Latest News Updates</p>
                    <h2 class="mb-5">{{__($page_title)}}</h2>

                </div>
            </div>
        </div>
    </div>
</div>

 <div class="blog section-padding border-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <div class="row">
                     @foreach($blogs as $k=> $data)
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="blog-grid">
                                <div class="card">
                                    <img class="img-fluid card-img-top" src="{{get_image(config('constants.frontend.blog.post.path').'/'.$data->value->image)}}" alt="{{$data->value->title}}">
                                    <div class="card-body">
                                    <small>{{date('d-M-Y', strtotime($data->created_at))}}</small>
                                        <a href="{{route('home.blog.details',[ str_slug($data->value->title), $data->id])}}">
                                            <h4 class="card-title">{{__(str_limit($data->value->title, 60))}}.....</h4>

                                        </a>

                                        <a href="{{route('home.blog.details',[ str_slug($data->value->title), $data->id])}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                      @endforeach

                    </div>
                </div>
                 {{$blogs->links()}}
@include('partials.recentblog')


                </div>
            </div>
        </div>
    </div>



@endsection
