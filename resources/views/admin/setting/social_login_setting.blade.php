@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.setting.social-login') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-4 col-sm-6">
                            <p class="text-muted">Social Login</p>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" name="social_login" @if($general_setting->social_login) checked @endif>
                        </div>
                    </div>

                    <div class="form-row" id="socialLoginConfig">
                        {{-- Google Login --}}
                        <div class="col-md-12 my-2"><h5 class="mb-2">Google Login</h5></div>
                        <div class="form-group col-md-6">
                            <label>Client ID</label>
                            <input type="text" class="form-control" placeholder="Google Client ID" name="gid" value="{{ $social_login->where('key', 'gauth')->first()->value->id ?? '' }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Client Secret</label>
                            <input type="text" class="form-control" placeholder="Google Client Secret" name="gsecret" value="{{ $social_login->where('key', 'gauth')->first()->value->secret ?? '' }}" />
                        </div>

                        {{-- Facebook Login --}}
                        <div class="col-md-12 my-2"><h5 class="mb-2">Facebook Login</h5></div>
                        <div class="form-group col-md-6">
                            <label>Client ID</label>
                            <input type="text" class="form-control" placeholder="Facebook Client ID" name="fid" value="{{ $social_login->where('key', 'fauth')->first()->value->id ?? '' }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Client Secret</label>
                            <input type="text" class="form-control" placeholder="Facebook Client Secret" name="fsecret" value="{{ $social_login->where('key', 'fauth')->first()->value->secret ?? '' }}" />
                        </div>
                    </div>                    
                </div>
                <div class="card-footer">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>

    $('input[name=social_login]').on('change', function() {
       if($(this).prop('checked')) {
            $('#socialLoginConfig').show();
       }else{
            $('#socialLoginConfig').hide();
       }
    }).change();
</script>
@endpush