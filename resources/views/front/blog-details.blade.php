
@extends('include.front')
@section('content')
  <div class="blog section-padding border-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-single-post single">
    <ul class="post-nfo">
        <li><i class="la la-calendar"></i> {{date('d M Y', strtotime($post->created_at))}}</li>
    </ul>
    <h3>{{__($post->value->title)}} </h3>
    <div class="blog-img">
        <img src="{{get_image(config('constants.frontend.blog.post.path').'/thumb_'.$data['image'])}}" alt="Image" class="img-fluid">
    </div>
    <!--blog-img end-->
    <p>{{__($post->value->body)}} </p>
    <div class="blg-dv">
        <div class="row">

        </div>
    </div>
    <!--blg-dv end-->
    <div class="post-share">
        <ul class="social-links">

            <li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" title=""><i class="fa fa-instagram"></i></a></li>
            <li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>
        </ul>

    </div>
    <!--post-share end-->

</div>
<!--blog-single-post end-->

<!--post-comment-sec end-->
                </div>
               @include('partials.recentblog')

                </div>
            </div>
        </div>
    </div>



@endsection
