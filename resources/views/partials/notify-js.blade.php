

@if($general->alert == 1)
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>
    @if(session()->has('notify'))
        @foreach(session('notify') as $msg)
            <script type="text/javascript">  iziToast.{{ $msg[0] }}({message:"{{ $msg[1] }}", position: "topRight"}); </script>
        @endforeach
    @endif
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
            iziToast.error({
                message: '{{ $error }}',
                position: "topRight"
            });
            @endforeach
        </script>
    @endif


    @if (Session::has('invest'))
        <script type="text/javascript">  iziToast.success({message:"{{ __(Session::get('invest')) }}", position: "topRight"}); </script>
    @endif

@endif


    @if($general->alert == 2)

    <!-- Toastr -->
    @section('javascript')
    <script src="{{url('/')}}/back/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="{{url('/')}}/back/js/sweet-alert.js"></script>
    @if(session()->has('notify'))

        @foreach(session('notify') as $msg)
        @if($msg[0] == 'success')
         <script>
	  $( document ).ready(function() {
		swal('Hello!', '{{ $msg[1] }}', 'success');
	});
	</script>
	 @elseif($msg[0] == 'error')
         <script>
	  $( document ).ready(function() {
		swal('Oops', '{{ $msg[1] }}', 'error');
	});
	</script>
	@else
	  <script>
	  $( document ).ready(function() {
		swal('Oops!', '{{ $msg[1] }}', 'warning');
	});
	</script>
	@endif


         <!--   <script type="text/javascript">  toastr.{{ $msg[0] }}("{{ $msg[1] }}"); </script> -->
        @endforeach
    @endif

     @if(session()->has('alert'))
     <script>
	  $( document ).ready(function() {
		swal('Oops!', '{{ $alert }}', 'warning');
	});
	</script>
	 @endif
     @if(session()->has('success'))
     <script>
	  $( document ).ready(function() {
		swal('Oops!', '{{ $success }}', 'success');
	});
	</script>
	 @endif

     @if(session()->has('success'))

     <script>
	  swal('Congratulations!', '{{ $success }}', 'success');
	</script>
	@endif
    @if ($errors->any())
       <!-- <script>

            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
        </script> -->
         <script>
	  $( document ).ready(function() {
		swal('Oops!', '{{ $error }}', 'error');
	});
	</script>

    @endif


    @if (Session::has('invest'))
     <script>
	  $( document ).ready(function() {
		swal('Congratulations!', '{{ __(Session::get('invest')) }}', 'success');
	});
	</script>
       <!-- <script type="text/javascript">  toastr.success("{{ __(Session::get('invest')) }}"); </script> -->
    @endif
    @endsection
    @endif

