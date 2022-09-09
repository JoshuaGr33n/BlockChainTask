@extends('include.admin')
@section('content')

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.deposit.gateway.update', $gateway->code) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="alias" value="{{ $gateway->alias }}">
                <input type="hidden" name="description" value="{{ $gateway->description }}">
                <div class="card-body" >
                    <div class="payment-method-item">
                    <div class="content">
                                <div class="d-flex justify-content-between">
                                    <h3 class="title">{{ $gateway->name }}</h3>
                                    <div class="input-group d-flex flex-wrap justify-content-end has_append" style="max-width: 450px">

                                         <div class="input-group">


														<select class="newCurrencyVal  form-control select2 custom-select">
                                            <option value="">Select currency</option>
                                            @forelse($supportedCurrencies as $currency => $symbol)
                                                <option value="{{$currency}}" data-symbol="{{ $symbol }}">{{ $currency }} </option>
                                            @empty
                                                <option value="">No available currency support</option>
                                            @endforelse

                                        </select>
														<span class="input-group-append">
															<button class="btn btn-primary newCurrencyBtn" data-crypto="{{ $gateway->crypto }}" data-name="{{ $gateway->name }}">Add Currency</button>
														</span>
							</div><br>
                                    </div>
                                </div>
                                <p>{{ $gateway->description }}</p>
                            </div>
                        <div class="payment-method-header d-flex flex-wrap">

                            <div class="form-group">
													<div class="form-label">Gateway Image</div>
													<div class="custom-file">
													<input type="file" name="image" class="custom-file-input" id="image" accept=".png, .jpg, .jpeg" />

														<label class="custom-file-label">Choose file</label>
													</div>
												</div>
                                <div class="avatar-preview">
                                    <img scr='{{ get_image(config('constants.deposit.gateway.path') .'/'. $gateway->image) }}'>
                                </div>




                        </div>
                        @if($gateway->code < 1000 && $gateway->extra)
                        <div class="payment-method-body">
                            <h4 class="mb-3">Configurations</h4>
                            <div class="row">
                                @foreach($gateway->extra as $key => $param)
                                    <div class="form-group col-lg-6">
                                        <label>{{ @$param->title }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ route($param->value) }}" readonly/>
                                            <span class=" btn btn-primary Input" data-toggle="tooltip" title="Copy"><i class="fa fa-copy"></i></span>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <br>
                        <div class="payment-method-body">
                            <h4 class="mb-3">Global Settings for {{ $gateway->name }}</h4>
                            <div class="row">
                                @foreach($parameter_list->where('global', true) as $key => $param)
                                    <div class="form-group col-lg-6">
                                        <label>{{ @$param->title }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="global[{{ $key }}]" value="{{ @$param->value }}" required />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- payment-method-item start -->

                    @isset($gateway->currencies)
                        @foreach($gateway->currencies as $gateway_currency)
                            <input type="hidden" name="currency[{{ $currency_idx }}][symbol]" value="{{ $gateway_currency->symbol }}">
                            <div class="payment-method-item child--item">
                                <div class="payment-method-header d-flex flex-wrap">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url('{{ get_image(config('constants.deposit.gateway.path') .'/'. $gateway_currency->image) }}')"></div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" hidden name="currency[{{ $currency_idx }}][image]" id="image{{ $currency_idx }}" class="form-control" accept=".png, .jpg, .jpeg" />

                                        </div>
                                    </div>

                                </div>
                                            <br>
                                             <h4 class="mb-3">{{ $gateway_currency->currencyIdentifier() }}</h4>
                                              <div class="input-group">


														<input type="text" class="form-control" placeholder="Name for User" name="currency[{{ $currency_idx }}][name]" value="{{ $gateway_currency->name }}" required />
														<span class="input-group-append">
															<button class="btn btn-danger deleteBtn" type="button">Remove</button>
														</span>
							</div><br>


                                <div class="payment-method-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card outline-primary">
                                                <h5 class="card-header bg-primary">Range</h5>
                                                <div class="card-body">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100">Minimum Amount <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                                        </div>
                                                        <input type="text" class="form-control" name="currency[{{ $currency_idx }}][min_amount]" value="{{ formatter_money($gateway_currency->min_amount) }}" placeholder="0" required/>
                                                    </div>
                                                    <div class="input-group">
                                                        <label class="w-100">Maximum Amount <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][max_amount]" value="{{ formatter_money($gateway_currency->max_amount) }}" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card outline-primary">
                                                <h5 class="card-header bg-primary">Charge</h5>
                                                <div class="card-body">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100">Fixed Charge <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][fixed_charge]" value="{{ formatter_money($gateway_currency->fixed_charge) }}" required/>
                                                    </div>
                                                    <div class="input-group">
                                                        <label class="w-100">Percent Charge <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][percent_charge]" value="{{ formatter_money($gateway_currency->percent_charge) }}" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card outline-primary">
                                                <h5 class="card-header bg-primary">Currency</h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">Currency</label>
                                                                <input type="text" name="currency[{{ $currency_idx }}][currency]" class="form-control border-radius-5 " value="{{ $gateway_currency->currency }}" readonly />
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">Symbol</label>
                                                                <input type="text" name="currency[{{ $currency_idx }}][symbol]" class="form-control border-radius-5 symbl" value="{{ $gateway_currency->symbol }}" data-crypto="{{ $gateway->crypto }}"  required/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <label class="w-100">Rate <span class="text-danger">*</span></label>
                                                        <div class="input-group-prepend">

                                                            <div class="input-group-text">1 {{ $general->cur_text }} = </div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][rate]" value="{{ formatter_money($gateway_currency->rate, 'crypto') }}"  required/>
                                                        <div class="input-group-prepend">

                                                            <div class="input-group-text"><span class="currency_symbol">{{ $gateway_currency->baseSymbol() }}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        @if($parameter_list->where('global', false)->count()  != 0 )
                                            @php
                                                $parameteres = json_decode($gateway_currency->parameter);
                                            @endphp
                                            <div class="col-lg-12">
                                                <div class="card outline-primary">
                                                    <h5 class="card-header bg-dark">Configuration</h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach($parameter_list->where('global', false) as $key => $param)
                                                                @php

                                                                    //dd($param);
                                                                @endphp
                                                                <div class="col-md-6">
                                                                    <div class="input-group mb-3">
                                                                        <label class="w-100">{{ $param->title }} <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" name="currency[{{ $currency_idx }}][param][{{ $key }}]" value="{{ $parameteres->$key }}" placeholder="---" required/>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @php $currency_idx++ @endphp
                    @endforeach
                @endisset

                <!-- payment-method-item end -->
                    <!-- **new payment-method-item start -->
                    <div class="payment-method-item child--item newMethodCurrency d-none col-12">
                        <input disabled type="hidden" name="currency[{{ $currency_idx }}][symbol]" class="currencySymbol">
                        <div class="payment-method-header d-flex flex-wrap">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview"></div>
                                </div>
                                <div class="avatar-edit">
                                    <input disabled type="file" accept=".png, .jpg, .jpeg" class="form-control" id="image{{ $currency_idx }}" name="currency[{{ $currency_idx }}][image]" />
                                    <label for="image{{ $currency_idx }}" class="bg-primary"></label>
                                </div>
                            </div>
                            <div class="content col-12">
                             <label class="mb-3" id="payment_currency_name">Name</label>
                            <div class="input-group">

														<input disabled type="text" class="form-control" placeholder="Name for User" name="currency[{{ $currency_idx }}][name]" required />
														<span class="input-group-append">
															<button class="btn btn-danger newCurrencyRemove" type="button">Remove</button>
														</span>
							</div><br>

                            </div>
                        </div>
                        <div class="payment-method-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card outline-primary">
                                        <h5 class="card-header bg-primary">Range</h5>
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <label class="w-100">Minimum Amount <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input disabled type="text" class="form-control" name="currency[{{ $currency_idx }}][min_amount]" placeholder="0" required/>
                                            </div>
                                            <div class="input-group">
                                                <label class="w-100">Maximum Amount <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input disabled type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][max_amount]" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card outline-primary">
                                        <h5 class="card-header bg-primary">Charge</h5>
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <label class="w-100">Fixed Charge <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                </div>
                                                <input disabled type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][fixed_charge]" required/>
                                            </div>
                                            <div class="input-group">
                                                <label class="w-100">Percent Charge <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">%</div>
                                                </div>
                                                <input disabled type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][percent_charge]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card outline-primary">
                                        <h5 class="card-header bg-primary">Currency</h5>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100">Currency</label>
                                                        <input disabled type="text" class="form-control currencyText" name="currency[{{ $currency_idx }}][currency]" class="form-control border-radius-5" readonly />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100">Symbol</label>
                                                        <input type="text" name="currency[{{ $currency_idx }}][symbol]" class="form-control border-radius-5 symbl" data-crypto="{{ $gateway->crypto }}" disabled />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <label class="w-100">Rate <span class="text-danger">*</span></label>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><b>1 </b>&nbsp; <span class="currency_symbol"></span> &nbsp; = </div>
                                                </div>
                                                <input disabled type="text" class="form-control" placeholder="0" name="currency[{{ $currency_idx }}][rate]" required/>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">{{ $general->cur_text }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($parameter_list->where('global', false)->count()  != 0 )
                                    <div class="col-lg-12">
                                        <div class="card outline-primary">
                                            <h5 class="card-header bg-dark">Configuration</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($parameter_list->where('global', false) as $key => $param)
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100">{{ $param->title }} <span class="text-danger">*</span></label>
                                                                <input disabled type="text" class="form-control" name="currency[{{ $currency_idx }}][param][{{ $key }}]" placeholder="---" required/>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- **new payment-method-item end -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Setting
                    </button>
                </div>
            </form>
        </div>
    </div>

{{-- DELETE GATEWAY MODAL --}}
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gateway Currency Remove Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.deposit.gateway.remove', $gateway->code) }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to delete <span class="font-weight-bold name"></span> gateway currency?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div></div></div>


@endsection

@section('javascript')
<script>
$('.newCurrencyBtn').on('click', function() {
    var form = $('.newMethodCurrency');

    var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
    var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;

    if(!getCurrencySelected) return;
    form.find('input').removeAttr('disabled');
    var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
    // form.find('.currency_symbol').text(currency);
    // form.find('.currencyText').val($(this).val());
    // form.find('.currency_symbol').text(symbol);
    // form.find('.currencySymbol').val(symbol);
    form.find('.currencyText').val(getCurrencySelected);
    form.find('.currency_symbol').text(currency);
    $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
    form.removeClass('d-none');
    $('html, body').animate({scrollTop:$('html, body').height()}, 'slow');

    $('.newCurrencyRemove').on('click', function() {
        form.find('input').val('');
        // form.addClass('d-none');
        form.remove();
    });

});

$('.deleteBtn').on('click', function() {
    var modal = $('#deleteModal');
    modal.find('input[name=id]').val($(this).data('id'));
    modal.find('.name').text($(this).data('name'));
    modal.modal('show');
});

$('.symbl').on('input', function() {
    var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
   $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
});

$('.copyInput').on('click', function(e) {
    var copybtn = $(this);
    var input = copybtn.siblings('input');
    if(input && input.select) {
        input.select();
        try{
            document.execCommand('SelectAll')
            document.execCommand('Copy', false, null);
            input.blur();
            copybtn.addClass('copied');
            setTimeout(function() { copybtn.removeClass('copied'); }, 1000);
        }catch(err) {
            alert('Please press Ctrl/Cmd + C to copy');
        }
    }
});

</script>
@endsection
