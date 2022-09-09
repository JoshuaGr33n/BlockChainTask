@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-xl-12">
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
            <form action="{{ route('admin.subscriber.sendEmail') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" placeholder="Email subject" name="subject" value="{{ old('subject') }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email Body</label>
                            <textarea name="body" rows="10" class="form-control nicEdit" placeholder="Your email template">{{ old('body') }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button  style="background-color: {{$general->bclr}}" type="submit" class="btn btn-block btn-primary mr-2"><i class="fa fa-fw fa-paper-plane"></i>Send Mail</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div>
@endsection

