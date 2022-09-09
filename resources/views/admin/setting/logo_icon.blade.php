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
    <form action="{{ route('admin.setting.logo-icon') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Logo</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">

                                             <img src="{{ get_image(config('constants.logoIcon.path') .'/logo.png', '?'.time()) }}" width="100" alt="image"><br>


                                </div>
                                <div class="avatar-edit">
                                  <div class="form-group"><div class="custom-file"><input type="file" name="logo" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Logo</label></div></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Favicon</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <img src="{{ get_image(config('constants.logoIcon.path') .'/favicon.png', '?'.time()) }}" width="100" alt="image"><br>


                                </div>
                                <div class="avatar-edit">
                                  <div class="form-group"><div class="custom-file"><input type="file" name="favicon" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Favicon</label></div></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer  bg-white">
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </div>
    </form>
</div></div></div></div></div></div></div>
@endsection
