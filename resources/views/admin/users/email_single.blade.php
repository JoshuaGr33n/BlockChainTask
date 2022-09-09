@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
        <div class="card-header">
										<div class="card-title">Message {{$user->username}}</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
            <form action="{{ route('admin.users.email.single', $user->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email subject" name="subject"  required/>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea name="message" rows="10" class="form-control nicEdit" placeholder="Your message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Send Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div></div>
@endsection

