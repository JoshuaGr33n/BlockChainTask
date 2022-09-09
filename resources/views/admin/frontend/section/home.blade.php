@extends('include.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>

									</div>
									<div class="card-body">
                <form action="{{ route('admin.frontend.homeContent.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input type="text" class="form-control " placeholder="Write Title" name="title" value="{{@$post->value->title }}" />
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Details </label>
                                    <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="10">{{ @$post->value->details }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Header Image </label><br>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{asset('assets/images/frontend/'.@$post->value->image)}}" alt="...">

                                    </div>
                                    <br><br>
                                   <div class="form-group"><div class="custom-file"><input type="file" type="file" name="image" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Image</label></div></div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

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
    </div></div></div></div>
@endsection
