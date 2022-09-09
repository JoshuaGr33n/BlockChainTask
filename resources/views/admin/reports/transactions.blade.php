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
                <table id="example" class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">TRX</th>
                            <th scope="col">Username</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Total</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr>
                            <td>{{ show_datetime($trx->created_at) }}</td>
                            <td class="font-weight-bold">{{ strtoupper($trx->trx) }}</td>
                            <td><a href="{{ route('admin.users.detail', $trx->user->id) }}">{{ $trx->user->username }}</a></td>
                            <td>
                                @if($trx->type == 'deposit')
                                <span class="badge badge-primary">{{ $trx->type }}</span>
                                @elseif($trx->type == 'withdraw')
                                <span class="badge badge-secondary">{{ $trx->type }}</span>
                                @endif
                            </td>
                            <td class="budget">{{ $general->cur_text }}{{ formatter_money($trx->main_amo) }}</td>
                            <td class="budget text-danger">{{ $general->cur_text }}{{ formatter_money($trx->charge) }}</td>
                            <td class="budget">{{ $general->cur_text }}{{ formatter_money($trx->amount) }}</td>
                            <td>{{ $trx->title }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{ $transactions->links() }}
                </nav>
            </div>
        </div>
    </div>
</div></div></div></div>
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

@endsection

