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
									<div class="card-body">            <form action="{{ route('admin.frontend.update', $seo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="image-upload">



                                        <div class="form-group"><div class="custom-file"><input type="file" type="file" name="image_input" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Avatar</label></div></div>
                          <label>SEO Image</label><br>
                         <img src="{{ get_image(config('constants.frontend.seo.path') .'/'. $seo->value->image) }}" width="100" alt="image"><br>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <small class="ml-2 mt-2 text-facebook">Separate multiple keywords by <code>,</code>(comma) or <code>enter</code> key</small>

                               <textarea  name="keywords[]" rows="3" class="form-control" placeholder="SEO meta description" required>@foreach($seo->value->keywords as $option) {{ $option }} @endforeach</textarea>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="description" rows="3" class="form-control" placeholder="SEO meta description" required>{{ $seo->value->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Social Title</label>
                                <input type="text" class="form-control" placeholder="Social Share Title" name="social_title" value="{{ $seo->value->social_title }}" required/>
                            </div>



                            <div class="form-group">
                                <label>Social Description</label>
                                <textarea name="social_description" rows="3" class="form-control" placeholder="Social Share  meta description" required>{{ $seo->value->social_description }}</textarea>
                            </div>

                        <button type="submit" class="btn btn-block btn-primary mr-2">Update SEO</button>




                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div></div></div></div>
@endsection
