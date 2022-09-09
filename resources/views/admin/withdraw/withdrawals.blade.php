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
                            <th scope="col">Withdrawal Code</th>
                            <th scope="col">Username</th>
                            <th scope="col">Withdrawal Method</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Payable Amount</th>
                            <th scope="col">User Will Get</th>
                            @if(request()->routeIs('admin.withdraw.pending'))
                            <th scope="col">Action</th>
                            @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search'))
                            <th scope="col">Status</th>
                            @endif
                        </tr>
												</thead>
												<tbody>

                                               @php $now = \Carbon\Carbon::now(); @endphp
                        @forelse($withdrawals as $withdraw)
                        <tr>
                            <td>{{ show_datetime($withdraw->created_at) }}</td>

                            <td class="font-weight-bold">{{ strtoupper($withdraw->trx) }}</td>

                            <td><a href="{{ route('admin.users.detail', $withdraw->user->id) }}">{{ $withdraw->user->username }}</a></td>

                            <td>{{ $withdraw->method->name }}</td>

                            <td class="budget">{{ $general->cur_sym}} {{ formatter_money($withdraw->amount) }} </td>

                            <td class="budget text-danger">{{ $general->cur_sym}} {{ formatter_money($withdraw->charge) }} </td>

                            @php $payable = $withdraw->amount + $withdraw->charge; @endphp
                            <td class="budget">{{ $general->cur_sym}} {{ formatter_money($payable) }} </td>

                            <td class="budget">{{ formatter_money($withdraw->rate * $withdraw->amount) }} {{ $withdraw->currency }} </td>
                            @if(request()->routeIs('admin.withdraw.pending'))
                            <td>

                                @php
                                    $details = ($withdraw->detail != null) ? $withdraw->detail : '';
                                    $proveImg = "<img src='".get_image(config('constants.deposit.verify.path').'/'.$withdraw->verify_image)."' alt=''>";
                                @endphp

                                <button class="btn btn-success approveBtn" data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}"  data-id="{{ $withdraw->id }}" data-amount="{{ formatter_money($withdraw->amount) }} {{ $withdraw->currency }}" data-username="{{ $withdraw->user->username }}"><i class="fa fa-fw fa-check"></i></button>
                                <button class="btn btn-danger rejectBtn" data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}"  data-id="{{ $withdraw->id }}" data-amount="{{ formatter_money($withdraw->amount)}} {{ $withdraw->currency }}" data-username="{{ $withdraw->user->username }}"><i class="fa fa-fw fa-ban"></i></button>

                            </td>
                            @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search'))
                            <td>
                                @if($withdraw->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @elseif($withdraw->status == 1)
                                <span class="badge badge-success">Approved</span>
                                @elseif($withdraw->status == 2)
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

                        {{ $withdrawals->links() }}
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->





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
            list[i] = ` <li class="list-group-item">${item[0].replace('_'," ")} : ${item[1]}</li>`
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
            list[i] = ` <li class="list-group-item">${item[0].replace('_'," ")} : ${item[1]}</li>`
        });
        modal.find('.withdraw-detail').html(list);

        modal.modal('show');
    });

    $('.viewBtn').on('click', function() {
        var modal = $('#viewModal');
        var data = $(this).data('ud');
        var html = `<ul>`;
        $.each(data, function(idx, val) {
            html += `<li>${idx} - ${val}</li>`;
        });
        html += `</ul>`;
        modal.find('.modal-body').html(html);
        modal.modal('show');
    });
</script>
@endsection

{{-- View MODAL --}}
<div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View User Information</h5>
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
{{-- APPROVE MODAL --}}
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.approve') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">approve</span> <span class="font-weight-bold withdraw-amount text-success"></span> withdrawal of <span class="font-weight-bold withdraw-user"></span>?</p>
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
                <h5 class="modal-title">Reject Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.reject') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">reject</span> <span class="font-weight-bold withdraw-amount text-success"></span> withdrawal of <span class="font-weight-bold withdraw-user"></span>?</p>
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


