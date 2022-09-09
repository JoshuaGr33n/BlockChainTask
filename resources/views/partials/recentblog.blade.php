 <div class="col-xl-3 col-lg-3">
                    <div class="blog-sidebar">
    <div class="widget-search">
        <form action="#">
            <input type="text" class="form-control" placeholder="Subscribe Now">
            <span><i class="la la-search"></i></span>
        </form>
    </div>
    <div class="widget-recent-post">
        <h3 class="post-title">Recent Post</h3>
        <ul class="list-unstyled">
        @foreach($recentBlog as $k=> $data)
            <li class="media d-flex-4">
                <img src="{{get_image(config('constants.frontend.blog.post.path').'/thumb_'.$data->value->image)}}" class="me-3" alt="...">
                <div class="media-body ms-1">
                    <h5 class="mt-0 mb-1">{{__(str_limit($data->value->title, 40))}}</h5>
                    <div class="meta-info">
                        <a href="{{route('home.blog.details',[ str_slug($data->value->title), $data->id])}}"><i class="la la-user"></i> Admin</a>
                        <a href="{{route('home.blog.details',[ str_slug($data->value->title), $data->id])}}"><i class="la la-calendar"></i> {{date('d-M-Y', strtotime($data->created_at))}}</a>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    </div>

</div>
