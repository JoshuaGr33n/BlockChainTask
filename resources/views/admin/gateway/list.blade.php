@extends('include.admin')

@section('content')
  <!-- row opened -->
						<div class="row">
						 @forelse($gateways as $gateway)
							<div class="col-xl-4">
								<div class="card">
									<div class="card-body text-center">
										<span class="avatar avatar-xxl brround cover-image default-shadow" data-image-src="{{url('/')}}/assets/images/gateway/{{$gateway->image}}" ></span>
										<h4 class="h4 mb-1 mt-3 ">{{ $gateway->name }}</h4>
										 @if($gateway->status == 1)
                                        <i class="bg-success"></i>
                                        <span class="bg-success ">&nbsp;Active&nbsp;</span>
                                    @else
                                        <i class="bg-danger"></i>
                                        <span class="status bg-danger">&nbsp;Inactive&nbsp;</span>
                                    @endif


										<div class="justify-content-center text-center mt-3 d-flex">
											<a href="{{ route('admin.deposit.gateway.edit', $gateway->code) }}"" class="btn btn-primary-light pl-3 pr-3 mr-3"><i class="fa fa-pencil"></i></a>
											 @if($gateway->status == 0)
											 <a href="#" data-code="{{ $gateway->code }}" data-name="{{ $gateway->name }}" data-toggle="modal" data-target="#activateModal" class="btn btn-success-light pl-3 pr-3 activateBtn"><i class="fa fa-check"></i> </a>

                                @else
                                 <a href="#" data-code="{{ $gateway->code }}" data-name="{{ $gateway->name }}" data-toggle="modal" data-target="#deactivateModal" class="btn btn-warning-light pl-3 pr-3 deactivateBtn"><i class="fa fa-close"></i> </a>

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
					 {{ $gateways->links() }}
				</div>
				<!-- App-content closed -->
			</div>
			 {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Method Activation Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.gateway.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
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
                    <h5 class="modal-title">Payment Method Disable Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.gateway.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
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
    </div>
@endsection


@section('javascript')
<script>
    $('.activateBtn').on('click', function() {
        var modal = $('#activateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });

    $('.deactivateBtn').on('click', function() {
        var modal = $('#deactivateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });
</script>
@endsection
