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
                            <th scope="col">Username</th>
                            <th scope="col">IP</th>
                            <th scope="col">Location</th>
                            <th scope="col">Browser</th>
                            <th scope="col">OS</th>
                        </tr>
												</thead>
												<tbody>

                                               @forelse($login_logs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                            <td><a href="{{ route('admin.users.detail', $log->user->id) }}"> {{ $log->user->username }}</a></td>
                            <td>{{ $log->user_ip }}</td>
                            <td>{{ $log->location }}</td>
                            <td>{{ $log->browser }}</td>
                            <td>{{ $log->os }}</td>
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
									 {{ $login_logs->links() }}
								</div>
							</div>
						</div></div></div></div></div></div></div>
						<!-- row closed -->




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
