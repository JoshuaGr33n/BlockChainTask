@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-lg-12">
    <div class="card">
									<div class="card-header">
										<div class="card-title">Support Ticket</div>
										<div class="card-options ">
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
                            <th scope="col">SL</th>
                            <th scope="col">User</th>
                            <th scope="col">Date</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Desk</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($items as $item)
                        <tr>
                            <td data-label="SL">{{$loop->index+1}}</td>
                            <td data-label="User"><a href="{{ route('admin.users.detail', $item->user_id ?? "")}}"> {{$item->user->firstname ?? "" }} {{$item->user->lastname ?? ""}}</a></td>

                            <td data-label="Date">{{ $item->created_at->format('d F, Y H:i A') }}</td>
                            <td data-label="Subject">{{ $item->subject }} </td>
                            <td data-label="Ticket">{{ $item->ticket }} </td>

                            <td data-label="Department"><strong>{{ $item->department }}</strong> </td>
                            <td data-label="Status">
                                @if($item->status == 0)
                                    <span class="badge badge-primary">Open</span>
                                @elseif($item->status == 1)
                                    <span class="badge badge-success ">Answered</span>
                                @elseif($item->status == 2)
                                    <span class="badge badge-info ">Customer Replied</span>
                                @elseif($item->status == 3)
                                    <span class="badge badge-danger ">Closed</span>
                                @endif
                            </td>
                            <td data-label="Action">
                                <a href="{{ route('admin.ticket.reply', $item->id) }}" class="btn btn-primary btn-sm btn-icon btn-pill"><i
                                        class="fa fa-eye"></i></a>
                            </td>
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
                    {{ $items->appends($_GET)->links() }}
                </nav>
            </div>

        </div>
    </div>
</div></div></div></div></div>
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
