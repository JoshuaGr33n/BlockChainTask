@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="key" value="feature">
                    <div class="card-body">
                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Title" value="{{ old('title') }}" name="title" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Details <span class="text-danger">*</span></label>
                                    <textarea name="short_details" class="form-control"  rows="4" required>{{old('short_details')}}</textarea>
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
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.frontend.feature.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
@endpush
