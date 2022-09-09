@extends('include.admin')

@section('content')
<div class="row">

    <div class="col-lg-12">
    <div class="card">
									<div class="card-header">
										<div class="card-title">Pending Support Ticket</div>
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
                            <th>SL</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Ticket</th>
                            <th>Department</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                       @forelse($items as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><a href="{{ route('admin.users.detail', $item->user_id)}}"> {{$item->user->firstname}} {{$item->user->lastname}}</a></td>

                            <td>{{ $item->created_at->format('d F, Y H:i A') }}</td>
                            <td>{{ $item->subject }} </td>
                            <td>{{ $item->ticket }} </td>

                            <td><strong>{{ $item->department }}</strong> </td>
                            <td>
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
                            <td>
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
