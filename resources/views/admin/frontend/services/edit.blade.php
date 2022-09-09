@extends('include.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
         <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
                <form action="{{ route('admin.frontend.update', $testi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="image-upload">


                                        <div class="form-group"><div class="custom-file"><input type="file" type="file" name="image_input" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Avatar</label></div></div>
                          <label>Section Image</label><br>
                         <img src="{{ get_image(config('constants.frontend.services.path') .'/'. $testi->value->image) }}" width="100" alt="image"><br>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Title" value="{{ $testi->value->title }}" name="title" required />
                                </div>
                                <div class="form-group">
                                    <label>Details <span class="text-danger">*</span></label>
                                    <textarea rows="10" class="form-control" placeholder="Details ..."  name="details" required>{{ $testi->value->details }}</textarea>
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
        </div>
    </div>  </div>  </div>  </div>
@endsection
