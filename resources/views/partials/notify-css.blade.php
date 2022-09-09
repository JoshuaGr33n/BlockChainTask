<link href="{{url('/')}}/back/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
<link href="{{url('/')}}/back/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet"/>
@if($general->alert == 1)
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
@elseif($general->alert == 2)
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
@endif
