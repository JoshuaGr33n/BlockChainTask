@extends('include.admin')

@section('content')
  <!-- row opened -->

<div class="row">

    <div class="col-lg-12">
    <div class="card">
									<div class="card-header">
										<div class="card-title">Create New Plan</div>
										<div class="card-options ">
											<a class="btn btn-success" href="{{ route('admin.withdraw.method.create') }}" ><i class="fa fa-fw fa-plus"></i>Add New</a>
										</div>
									</div>


          <div class="card-body">
										<div class="table-responsive">

						 @forelse($methods as $method)
							<div class="col-xl-4">
								<div class="card">
									<div class="card-body text-center">
										<span class="avatar avatar-xxl brround cover-image default-shadow" data-image-src="{{ get_image(config('constants.withdraw.method.path') .'/'. $method->image) }}"" ></span>
										<h4 class="h4 mb-1 mt-3 ">{{ $method->name }}</h4>
										 @if($method->status == 1)
                                        <i class="bg-success"></i>
                                        <span class="bg-success ">&nbsp;Active&nbsp;</span>
                                    @else
                                        <i class="bg-danger"></i>
                                        <span class="status bg-danger">&nbsp;Inactive&nbsp;</span>
                                    @endif <br>

                                    <td>Currency: {{ $method->currency }}</td><br>
                            <td class="budget">Minimum: {{ formatter_money($method->fixed_charge, $method->currency) }} + {{ formatter_money($method->percent_charge) }}%</td>
                            <br><td class="budget">Maximum: {{ formatter_money($method->min_limit, $method->currency) }} - {{ formatter_money($method->max_limit, $method->currency) }}</td>
                           <br> <td>Payout: {{ $method->delay }}</td>


										<div class="justify-content-center text-center mt-3 d-flex">
											<a href="{{ route('admin.withdraw.method.update', $method->id) }}"" class="btn btn-primary-light pl-3 pr-3 mr-3"><i class="fa fa-pencil"></i></a>
											 @if($method->status == 0)
											 <a href="#" data-id="{{ $method->id }}" data-name="{{ $method->name }}" data-toggle="modal" data-target="#activateModal" class="btn btn-success-light pl-3 pr-3 activateBtn"><i class="fa fa-check"></i> </a>

                                @else
                                 <a href="#" data-id="{{ $method->id }}" data-name="{{ $method->name }}" data-toggle="modal" data-target="#deactivateModal" class="btn btn-warning-light pl-3 pr-3 deactivateBtn"><i class="fa fa-close"></i> </a>

                                @endif

										</div>
									</div>
								</div>
							</div>
							  @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                    </tr>
                    @endforelse
						</div>
						<!-- row closed -->
					</div>
					 {{ $methods->links() }}
				</div>
				<!-- App-content closed -->
			</div>
			{{-- ACTIVATE METHOD MODAL --}}
<div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdrawal Method Activation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.method.activate') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to activate <span class="font-weight-bold method-name"></span> method?</p>
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
                <h5 class="modal-title">Withdrawal Method Disable Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.method.deactivate') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to disable <span class="font-weight-bold method-name"></span> method?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Disable</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div></div></div></div>
@endsection


@section('javascript')
<script>
$('.activateBtn').on('click', function() {
    var modal = $('#activateModal');
    modal.find('.method-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
    modal.modal('show');
});

$('.deactivateBtn').on('click', function() {
    var modal = $('#deactivateModal');
    modal.find('.method-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'))
    modal.modal('show');
});
</script>
@endsection
