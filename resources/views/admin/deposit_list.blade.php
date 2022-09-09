@extends('include.admin')

@section('content')
<div class="row">
							<div class="col-md-12 col-lg-12">
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
										<div class="table-responsive">
											<table id="example" class="table table-bordered key-buttons text-nowrap">
												<thead>
													 <tr>
                                <th scope="col">Date</th>
                                <th scope="col">TRX ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Deposit Method</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Charge</th>
                                <th scope="col">Amount Gotten</th>
                                <th scope="col">In {{ $general->cur_text }}</th>
                                @if(request()->routeIs('admin.deposit.pending') )
                                <th scope="col">Action</th>
                                @elseif(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.search'))
                                <th scope="col">Status</th>
                                @endif
                            </tr>
												</thead>
												<tbody>

                                              @forelse( $deposits as $deposit )
                            @if(!$deposit->gateway) @endif
                                <tr>
                                    <td>{{ show_datetime($deposit->created_at) }}</td>
                                    <td class="font-weight-bold text-uppercase">{{ $deposit->trx }}</td>
                                    <td><a href="{{ route('admin.users.detail', $deposit->user->id) }}">{{ $deposit->user->username }}</a></td>
                                    <td>{{ $deposit->gateway->name }}</td>
                                    <td class="text-primary">{{ $deposit->method_currency }}{{ formatter_money($deposit->amount) }}</td>
                                    <td class="text-danger">{{ $deposit->method_currency }}{{ formatter_money($deposit->charge) }}</td>
                                    <td class="text-success">{{ $deposit->method_currency }}{{ formatter_money(bcsub($deposit->amount,$deposit->charge)) }}</td>
                                    <td>{{ $general->cur_sym}}{{ formatter_money(bcmul($deposit->amount, $deposit->rate)) }}</td>
                                    @if(request()->routeIs('admin.deposit.pending'))

                                        @php
                                            $details = ($deposit->detail != null) ? $deposit->detail : '';
                                            $proveImg = "<img src='".get_image(config('constants.deposit.verify.path').'/'.$deposit->verify_image)."' alt=''>";
                                        @endphp

                                        <td>

                                            <button class="btn btn-success approveBtn"  data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}" data-id="{{ $deposit->id }}" data-amount="{{ formatter_money($deposit->amount)}} {{ $deposit->method_currency }}" data-username="{{ $deposit->user->username }}"><i class="fa fa-fw fa-check"></i></button>
                                            <button class="btn btn-danger rejectBtn" data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}" data-id="{{ $deposit->id }}" data-amount="{{ formatter_money($deposit->amount)}} {{ $deposit->method_currency }}" data-username="{{ $deposit->user->username }}"><i class="fa fa-fw fa-ban"></i></button>
                                        </td>
                                    @elseif(request()->routeIs('admin.deposit.list')  || request()->routeIs('admin.deposit.search'))
                                        <td>
                                            @if($deposit->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($deposit->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                            @elseif($deposit->status == 2)
                                            <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                            </tr>
                            @endforelse

												</tbody>
											</table>
										</div>
									</div>

                        {{ $deposits->links() }}
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->



{{-- APPROVE MODAL --}}
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Deposit Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.deposit.approve') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">approve</span> <span class="font-weight-bold withdraw-amount text-success"></span> deposit of <span class="font-weight-bold withdraw-user"></span>?</p>
                    <p class="withdraw-detail"></p>

                    <span class="withdraw-proveImg"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Approve</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Deposit Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.deposit.reject') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">reject</span> <span class="font-weight-bold withdraw-amount text-success"></span> deposit of <span class="font-weight-bold withdraw-user"></span>?</p>

                    <p class="withdraw-detail"></p>
                    <span class="withdraw-proveImg"></span>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reject</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{url('/')}}/back/plugins/datatable/js/dataTables.buttons.min.js"/>
<script src="{{url('/')}}/back/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/jszip.min.js"></script>
<script src=".{{url('/')}}/back/plugins/datatable/js/pdfmake.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/vfs_fonts.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/back/plugins/datatable/js/buttons.colVis.min.js"></script>


<script>
    $('.approveBtn').on('click', function() {
        var modal = $('#approveModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('.withdraw-amount').text($(this).data('amount'));
        modal.find('.withdraw-user').text($(this).data('username'));

        modal.find('.withdraw-proveImg').html($(this).data('prove_img'));

        var details =  Object.entries($(this).data('detail'));
        var list = [];
        details.map( function(item,i) {
            list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
        });
        modal.find('.withdraw-detail').html(list);

        modal.modal('show');
    });

    $('.rejectBtn').on('click', function() {
        var modal = $('#rejectModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('.withdraw-amount').text($(this).data('amount'));
        modal.find('.withdraw-user').text($(this).data('username'));
        modal.find('.withdraw-proveImg').html($(this).data('prove_img'));

        var details =  Object.entries($(this).data('detail'));
        var list = [];
        details.map( function(item,i) {
            list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
        });
        modal.find('.withdraw-detail').html(list);


        modal.modal('show');
    });
</script>

@endsection
