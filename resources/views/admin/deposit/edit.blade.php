@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.deposit.manual.update', $method->code) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body" >
                    <div class="payment-method-item">
                        <div class="payment-method-header d-flex flex-wrap">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-image: url('{{ get_image(config('constants.deposit.gateway.path') .'/'. $method->image) }}')"></div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" />
                                    <label for="image" class="bg-primary"><i class="fa fa-pencil"></i
                                    ></label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between">
                                    <input type="text" class="form-control" placeholder="Method Name" name="name" value="{{ $method->name }}" />
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <label class="w-100">Currency <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="currency" class="form-control border-radius-5" value="{{ $method->single_currency->currency ?? ''}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <label class="w-100">Currency Symbol<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="symbol" class="form-control border-radius-5" value="{{ $method->single_currency->symbol ?? ''}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="w-100">Rate <span class="text-danger">*</span></label>

                                        <div class="input-group has_append">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">1 {{ $general->cur_text }} =</div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="0" name="rate" value="{{ formatter_money($method->single_currency->rate) ?? ''}}"/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><span class="currency_symbol"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="w-100">Delay <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="delay" class="form-control border-radius-5" value="{{ $method->extra->delay }}" />
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="payment-method-body">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="card outline-primary">
                                        <h5 class="card-header bg-primary">Range</h5>
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <label class="w-100">Minimum Amount <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input type="text" class="form-control" name="min_limit" placeholder="0" value="{{ formatter_money($method->single_currency->min_amount) }}" />
                                            </div>
                                            <div class="input-group">
                                                <label class="w-100">Maximum Amount <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{ formatter_money($method->single_currency->max_amount) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card outline-dark">
                                        <h5 class="card-header bg-primary">Charge</h5>
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <label class="w-100">Fixed Charge <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ formatter_money($method->single_currency->fixed_charge) }}"/>
                                            </div>
                                            <div class="input-group">
                                                <label class="w-100">Percent Charge <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">%</div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ formatter_money($method->single_currency->percent_charge) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card outline-dark">
                                        <div class="card-header bg-dark d-flex justify-content-between">
                                            <h5>Deposit Instruction</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <textarea rows="8" class="form-control border-radius-5 nicEdit" name="instruction">{{ $method->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card outline-dark">
                                        <div class="card-header bg-dark d-flex justify-content-between">
                                            <h5>User data</h5>
                                            <button type="button" class="btn btn-sm btn-outline-light addUserData"><i class="fa fa-fw fa-plus"></i>Add New</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row" id="userData">
                                                @if($method->code >= 1000)
                                                <div class="col-md-4 user-data mt-2">
                                                    <input type="text" class="form-control border-radius-5" name="verify_image" value="{{ $method->extra->verify_image }}">
                                                </div>
                                                @endif
                                                @if($method->single_currency->parameter)
                                                    @foreach(json_decode($method->single_currency->parameter) as $data)

                                                        <div class="col-md-4 user-data mt-2">
                                                            <div class="input-group has_append">
                                                                <input type="text" class="form-control border-radius-5" name="ud[]" value="{{ $data }}" required>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-danger removeBtn"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save Method</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script>
$('input[name=currency]').on('input', function() {
    $('.currency_symbol').text($(this).val());
});
$('.currency_symbol').text($('input[name=currency]').val());
$('.addUserData').on('click', function() {
    var html =  `<div class="col-md-4 user-data mt-2">
                    <div class="input-group has_append">
                        <input class="form-control border-radius-5" name="ud[]" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger removeBtn"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>`;

    $('#userData').append(html);
});

$(document).on('click', '.removeBtn', function() { $(this).parents('.user-data').remove(); });
</script>
@endsection
