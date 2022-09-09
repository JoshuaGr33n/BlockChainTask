@extends('include.admin')

@section('content')
<div class="row">

    @foreach($plugins as $plugin)
        <!-- card start -->
        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
            <div class="card @if($plugin->status == 1) border-success @else border-danger @endif mb-3 withdraw-method-card">

                <div class="card-body">
                    <div class="price-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="{{ get_image(config('constants.plugin.path') .'/'. $plugin->image) }}" alt="{{ $plugin->name }}" style="width: auto; height: 65px;">
                            </div>
                            <div class="col-md-6">
                                <h5>{{ $plugin->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-primary editBtn" data-name="{{ $plugin->name }}" data-shortcode="{{ json_encode($plugin->shortcode) }}" data-action="{{ route('admin.plugin.update', $plugin->id) }}"><i class="fa fa-fw fa-pencil"></i>Edit</button>
                   <!-- <button class="btn btn-dark helpBtn" data-description="{{ $plugin->description }}" data-support="{{ $plugin->support }}">Help<i class="fa fa-fw fa-question"></i></button> -->
                    @if($plugin->status == 0)
                        <button class="btn btn-success activateBtn" data-id="{{ $plugin->id }}" data-name="{{ $plugin->name }}" data-toggle="modal" data-target="#activateModal"><i class="fa fa-fw fa-eye"></i>Enable</button>
                    @else
                        <button class="btn btn-danger deactivateBtn" data-id="{{ $plugin->id }}" data-name="{{ $plugin->name }}" data-toggle="modal" data-target="#deactivateModal"><i class="fa fa-fw fa-eye-slash"></i>Disable</button>
                    @endif
                </div>
            </div>
        </div>
        <!-- card end -->
    @endforeach
</div>

{{-- EDIT METHOD MODAL --}}
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Addon: <span class="plugin-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12 control-label font-weight-bold">Script <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <textarea name="script" class="form-control" rows="8" placeholder="Paste your script with proper key"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editBtn">Update</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div></div>

{{-- ACTIVATE METHOD MODAL --}}
<div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Addon Activation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.plugin.activate') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to activate <span class="font-weight-bold plugin-name"></span> addon?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Activate</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DEACTIVATE METHOD MODAL --}}
<div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Addon Disable Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.plugin.deactivate') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to disable <span class="font-weight-bold plugin-name"></span> addon?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Disable</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- HELP METHOD MODAL --}}
<div id="helpModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Need Help?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

$('.activateBtn').on('click', function() {
    var modal = $('#activateModal');
    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
});

$('.deactivateBtn').on('click', function() {
    var modal = $('#deactivateModal');
    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
});

$('.editBtn').on('click', function() {
    var modal = $('#editModal');
    var shortcode = $(this).data('shortcode');

    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('form').attr('action', $(this).data('action'));

    var html = '';
    $.each(shortcode, function(key, item){
        html += `<div class="form-group">
                        <label class="col-md-12 control-label font-weight-bold">${item.title}<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
    })
    modal.find('.modal-body').html(html);

    modal.modal('show');
});

$('.helpBtn').on('click', function() {
    var modal = $('#helpModal');
    var path = "{{ asset(config('constants.plugin.path')) }}";
    modal.find('.modal-body').html(`<div class="mb-2">${$(this).data('description')}</div>`);
    modal.find('.modal-body').append(`<img src="${path}/${$(this).data('support')}"></img>`);
    modal.modal('show');
});
</script>
@endsection
