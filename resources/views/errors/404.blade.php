
<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta http-equiv="x-ua-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Favicon-->
		<link rel="icon" href="{{get_image(config('constants.logoIcon.path') .'/favicon.png')}}" type="image/x-icon"/>

		<!-- Title -->
		<title>{{$general->sitename}}|404</title>

		<!-- Bootstrap css -->
		<link href="{{url('/')}}/back/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{url('/')}}/back/css/style.css" rel="stylesheet" />

		<!-- Default css -->
		<link href="{{url('/')}}/back/css/default.css" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/sidemenu/sidemenu.css">

		<!-- owl-carousel css-->
		<link href="{{url('/')}}/back/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

		<!--Bootstrap-daterangepicker css-->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/bootstrap-daterangepicker/daterangepicker.css">

		<!--Bootstrap-datepicker css-->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

		<!-- Sidemenu-responsive  css -->
		<link href="{{url('/')}}/back/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css" rel="stylesheet">

		<!-- P-scroll css -->
		<link href="{{url('/')}}/back/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

		<!--Font icons css-->
		<link  href="{{url('/')}}/back/css/icons.css" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link href="{{url('/')}}/back/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!--Color-palette css-->
		<link rel="stylesheet" href="{{url('/')}}/back/css/skins.css"/>

	</head>

	<body class="h-100vh  ddark-mode">

		<!--Loader-->
		<div id="loading">
			<img src="{{url('/')}}/back/images/other/loader-dark.svg" class="loader-img" alt="Loader">
		</div>

		<div class="page">
		   <!-- PAGE-CONTENT OPEN -->
			<div class="page-content error-page">
				<div class="container text-center">
					<img src="{{url('/')}}/back/images/svg/error.svg" alt="error" class="w-50 floating">
					<h1 class="h2 mt-4 mb-5">Oops! Page Not Found</h1>
					<a class="btn btn-outline-primary" href="{{url('/')}}">
						Back To Home
					</a>
				</div>
			</div>
			<!-- PAGE-CONTENT OPEN CLOSED -->
		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

		<!-- Dashboard js -->
		<script src="{{url('/')}}/back/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="{{url('/')}}/back/plugins/bootstrap-4.1.3/popper.min.js"></script>
		<script src="{{url('/')}}/back/plugins/bootstrap-4.1.3/js/bootstrap.min.js"></script>
		<script src="{{url('/')}}/back/js/vendors/jquery.sparkline.min.js"></script>
		<script src="{{url('/')}}/back/js/vendors/circle-progress.min.js"></script>
		<script src="{{url('/')}}/back/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="{{url('/')}}/back/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!--Moment js-->
        <script src="{{url('/')}}/back/plugins/moment/moment.min.js"></script>

		<!--Bootstrap-daterangepicker js-->
		<script src="{{url('/')}}/back/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!--Bootstrap-datepicker js-->
		<script src="{{url('/')}}/back/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

		<!--Counters -->
		<script src="{{url('/')}}/back/plugins/counters/counterup.min.js"></script>
		<script src="{{url('/')}}/back/plugins/counters/waypoints.min.js"></script>

		<!--owl-carousel-->
		<script src="{{url('/')}}/back/plugins/owl-carousel/owl.carousel.js"></script>
		<script src="{{url('/')}}/back/js/carousel.js"></script>

		<!-- Custom Js-->
		<script src="{{url('/')}}/back/js/custom-dark.js"></script>

	</body>
</html>
