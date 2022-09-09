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
            <form action="{{ route('admin.frontend.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="key" value="rules">


                            <div class="form-group">
                                <label>Rules Content</label>
                                <textarea rows="10" class="form-control nicEdit" placeholder="Rules description" name="body">{{old('body')}}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-lg btn-block btn-primary mr-2">Save</button>
                        </div>
                    </div>
                </div>
                    </div>


                </div>

            </form>
        </div>
    </div>
</div></div></div></div>
@endsection
