@extends('include.admin')

@section('content')
<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
                <form action="{{ route('admin.frontend.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact Title </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="title" value="{{@$post->value->title }}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Details </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="short_details" value="{{@$post->value->short_details }}" />
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email Address </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="email_address" value="{{@$post->value->email_address }}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact Address </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="contact_details" value="{{@$post->value->contact_details }}" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact Number </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="contact_number" value="{{@$post->value->contact_number }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location Latitude</label>
                                    <input type="text" class="form-control" placeholder="Location Latitude" name="latitude" value="{{@$post->value->latitude }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location Longitude</label>
                                    <input type="text" class="form-control" placeholder="Location Longitude" name="longitude" value="{{@$post->value->longitude }}" />
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Website Footer </label>
                                    <textarea name="website_footer" class="form-control nicEdit" placeholder="Write content" rows="8" >{{@$post->value->website_footer }}</textarea>
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
    </div> </div> </div> </div> </div>
@endsection
