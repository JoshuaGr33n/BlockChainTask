@extends('include.admin')

@section('content')
<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options">
											<a href="{{ route('admin.subscriber.sendEmail') }}" class="btn btn-success btn-sm" ><i class="fa fa-fw fa-paper-plane"></i>Send Email</a>
										</div>
									</div>
           <div class="card-body">
										<div class="table-responsive">
                <table id="example" class="table align-items-center table-light">
                    <thead>
                       <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Joined</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @forelse($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($subscriber->created_at)->diffForHumans() }}</td>
                            <td><button type="button" class="btn btn-danger removeModalBtn" data-id="{{ $subscriber->id }}" data-email="{{ $subscriber->email }}"><i class="fa fa-fw fa-trash"></i>Remove</button></td>
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
                    {{ $subscribers->links() }}
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


{{-- Remove Subscriber MODAL --}}
<div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure want to remove?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.subscriber.remove') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="subscriber">
                    <p><span class="font-weight-bold subscriber-email"></span> will be removed.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-rounded btn-danger">Remove</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('.removeModalBtn').on('click', function() {
        $('#removeModal').find('input[name=subscriber]').val($(this).data('id'));
        $('#removeModal').find('.subscriber-email').text($(this).data('email'));
        $('#removeModal').modal('show');
    });

</script>
@endsection

