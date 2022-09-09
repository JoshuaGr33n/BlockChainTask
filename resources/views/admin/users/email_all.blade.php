@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <form action="{{ route('admin.users.email.all') }}" method="POST">
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
