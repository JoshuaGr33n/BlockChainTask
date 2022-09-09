@extends('include.admin')

@section('content')
<div class="row">
     <div class="col-lg-12">
    <div class="card">
									<div class="card-header">
										<div class="card-title">Edit About Page</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
                <form action="{{ route('admin.frontend.about.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input type="text" class="form-control" placeholder="Write Title" name="title" value="{{@$post->value->title }}" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Details </label>
                                    <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="10">{!! @$post->value->details !!}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div></div></div></div>
    </div>
@endsection
