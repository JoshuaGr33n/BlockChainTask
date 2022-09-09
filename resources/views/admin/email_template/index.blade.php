@extends('include.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
         <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($email_templates as $template)
                            <tr>
                                <td>{{ $template->name }}</td>
                                <td>{{ $template->subj }}</td>
                                <td>
                                    <span class="badge badge-dot">
                                        @if($template->email_status == 1)
                                            <i class="bg-success"></i>
                                            <span class="status">active</span>
                                        @else
                                            <i class="bg-danger"></i>
                                            <span class="status">disabled</span>
                                        @endif
                                    </span>
                                </td>
                                <td><a href="{{ route('admin.email-template.edit', $template->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
                    {{ $email_templates->links() }}
                </nav>
            </div>
        </div>
    </div>
</div></div></div></div></div></div>
@endsection
