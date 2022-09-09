@extends('include.admin')

@section('content')
<div class="row">
     <div class="col-lg-12">
    <div class="card">
									<div class="card-header">
										<div class="card-title">Create Blog</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>

            <form action="{{ route('admin.frontend.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="key" value="blog.post">
                <input type="hidden" name="has_image" value="1">
                <div class="card-body">

                    <div class="form-row">


                        <div class="col-md-12">
                        <div class="form-group"><div class="custom-file"><input type="file" type="file" name="image_input" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Avatar</label></div></div>
                          <label>Post Image</label><br>

                                <div class="form-group">
                                    <label>Post Title</label>
                                    <input type="text" class="form-control" placeholder="Your Post Title" name="title"  required/>
                                </div>
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <textarea rows="10" class="form-control nicEdit" placeholder="Post description" name="body" required></textarea>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div>
@endsection

