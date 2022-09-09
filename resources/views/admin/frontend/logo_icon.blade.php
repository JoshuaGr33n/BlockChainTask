@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Breadcrumb</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ asset('assets/images/frontend/breadcrumb/page-header-01.png') }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="page_header">
                                    <label for="profilePicUpload1" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Breadcrumb Coin</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ asset('assets/images/frontend/breadcrumb/coin.png') }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload2" accept=".png" name="coin">
                                    <label for="profilePicUpload2" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Footer Left Image</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ asset('assets/images/frontend/footer/tree1.png') }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload3" accept=".png" name="tree1">
                                    <label for="profilePicUpload3" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Footer Image Icon</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ asset('assets/images/frontend/footer/coin1.png') }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload4" accept=".png" name="coin_icon">
                                    <label for="profilePicUpload4" class="bg-primary">Select Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Footer Right Image</h4>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-size: 100%;background-image: url({{ asset('assets/images/frontend/footer/tree2.png')  }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" id="profilePicUpload5" accept=".png" name="tree2">
                                    <label for="profilePicUpload5" class="bg-primary">Select Image</label>
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
</div>
@endsection
