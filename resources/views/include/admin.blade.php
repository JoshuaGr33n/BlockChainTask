<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta http-equiv="x-ua-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<!-- Title -->

		 <title>{{ $general->sitename($page_title) }}</title>
       @include('partials.seo')
       <link rel="icon" href="{{get_image(config('constants.logoIcon.path') .'/favicon.png')}}" type="image/x-icon">
       <link rel="shortcut icon" type="image/png" href="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}"/>

       <!-- Custom Stylesheet -->
       @include('partials.notify-css')
        <!-- Data table css -->
		<link href="{{url('/')}}/back/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{url('/')}}/back/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/datatable/css/buttons.bootstrap4.min.css">
		<link href="{{url('/')}}/back/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<link href="{{url('/')}}/back/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />
		<link href="{{url('/')}}/back/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- Style css -->
		<link  href="{{url('/')}}/back/css/style.css" rel="stylesheet" />

		<!-- Default css -->
		<link href="{{url('/')}}/back/css/default.css" rel="stylesheet">

		<!-- Sidemenu css-->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/sidemenu/icon-sidemenu.css">

		<!-- Owl-carousel css-->
		<link href="{{url('/')}}/back/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

		<!-- Bootstrap-daterangepicker css -->
		<link rel="stylesheet" href=".{{url('/')}}/back/plugins/bootstrap-daterangepicker/daterangepicker.css">

		<!-- Bootstrap-datepicker css -->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

		<!-- Custom scroll bar css -->
		<link href="{{url('/')}}/back/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

		<!-- P-scroll css -->
		<link href="{{url('/')}}/back/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

		<!-- Font-icons css -->
		<link  href="{{url('/')}}/back/css/icons.css" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link href="{{url('/')}}/back/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- Nice-select css  -->
		<link href="{{url('/')}}/back/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet"/>

		<link href="{{url('/')}}/back/plugins/select2/select2.min.css" rel="stylesheet" />
		<!-- Color-palette css-->
		<link rel="stylesheet" href="{{url('/')}}/back/css/skins.css"/>

	</head>
	<body class="app sidebar-mini">

		<!-- Loader -->
		<div id="loading">
			<img src="{{url('/')}}/back/images/other/loader.svg" class="loader-img" alt="Loader">
		</div>

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!-- Top-header opened -->
				<div class="header-main header sticky" >
					<div class="app-header header top-header navbar-collapse " style="background-color: {{$general->bclr}}">
						<div class="container-fluid">
							<div class="d-flex">
								<a class="header-brand" href="{{ route('admin.dashboard') }}">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" class="header-brand-img desktop-logo " alt="= logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" class="header-brand-img desktop-logo-1 " alt=" logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" class="mobile-logo" width="50" alt=" logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" class="mobile-logo-1" width="50"  alt=" logo">
								</a>
								<a href="#" data-toggle="sidebar" class="nav-link icon toggle"><i class="fe fe-align-justify fs-20 text-white"></i></a>

								<div class="d-flex header-right ml-auto">
									<div class="dropdown header-fullscreen">
										<a class="nav-link icon full-screen-link" id="fullscreen-button">
											<i class="mdi mdi-arrow-collapse fs-20 text-white"></i>
										</a>
									</div><!-- Fullscreen -->
									<div class="" id="bs-example-navbar-collapse-1">
										<form class="navbar-form" role="search" onsubmit="return false;">
											<div class="input-group ">
												<input type="text" class="form-control" placeholder="Search...">
												<span class="input-group-btn">
													<button type="reset" class="btn btn-default">
														<i class="fa fa-times"></i>
													</button>
													<button type="submit" class="btn btn-default">
														<i class="fa fa-search text-white"></i>
													</button>
												</span>
											</div>
											 <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
										</form>
									</div><!-- Search -->



									<div class="dropdown drop-profile">
										<a class="nav-link pr-0 leading-none" href="#" data-toggle="dropdown" aria-expanded="false">
											<div class="profile-details mt-1">
												<span class="mr-3 mb-0  fs-15 font-weight-semibold text-white">{{auth()->guard('admin')->user()->username}}</span>
												<small class="text-muted mr-3 text-white">Admin</small>
											</div>
											<img class="avatar avatar-md brround" src="{{ get_image(config('constants.admin.profile.path') .'/'. auth()->guard('admin')->user()->image) }}" width="50" alt="image">
										 </a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated bounceInDown w-250">
											<div class="user-profile bg-header-image border-bottom p-3">
												<div class="user-image text-center">
													<img class="user-images" src="{{ get_image(config('constants.admin.profile.path') .'/'. auth()->guard('admin')->user()->image) }}" alt="image">
												</div>
												<div class="user-details text-center">
													<h4 class="mb-0">{{auth()->guard('admin')->user()->username}}</h4>
													<p class="mb-1 fs-13 text-white-50">{{auth()->guard('admin')->user()->email}}</p>
												</div>
											</div>
											<a class="dropdown-item" href="{{ route('admin.profile') }}">
												<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
											</a>

											<a class="dropdown-item mb-1" href="{{ route('admin.logout') }}">
												<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
											</a>
										</div>
									</div><!-- Profile -->

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Top-header closed -->

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"  ></div>
				<aside class="app-sidebar toggle-sidebar" style="background-color: {{$general->bclr}}">
					<div class="app-sidebar__user">
						<div class="user-body">
							<img src="{{ get_image(config('constants.admin.profile.path') .'/'. auth()->guard('admin')->user()->image) }}" alt="profile-img" class="rounded-circle w-25">
						</div>
						<div class="user-info">
							<a href="#" class=""><span class="app-sidebar__user-name font-weight-semibold"> {{auth()->guard('admin')->user()->name}}</span><br>
								<span class="text-muted app-sidebar__user-designation text-white">Admin</span>
							</a>
						</div>
					</div>
					<ul class="side-menu toggle-menu">
						<li class="slide">
							<a href="{{ route('admin.dashboard') }}" class="side-menu__item"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/homepage.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Dashboard</span></a>

						</li>
						<li class="slide">
							<a href="{{ route('admin.referral.index') }}" class="side-menu__item" ><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/homepage.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Referral System</span></a>

						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/bitcoin-logo.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Blockchain Wallets</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.wallet.index') }}" class="slide-item">Manage Crypto Wallets</a></li>
								<li><a href="{{ route('admin.wallet.sent') }}" class="slide-item">Sent Transactions</a></li>
								<li><a href="{{ route('admin.wallet.receive') }}" class="slide-item">Received Transactions</a></li>
								<li><a href="{{ route('admin.wallet.all') }}" class="slide-item">All Transactions</a></li>

							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/shopping-cart.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Crypto Trade</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.successful.sell') }}" class="slide-item">Successful Sales</a></li>
								<li><a href="{{ route('admin.pending.sell') }}" class="slide-item">Pending Sales</a></li>
								<li><a href="{{ route('admin.declined.sell') }}" class="slide-item">Declined Sales</a></li>
								<li><a href="{{ route('admin.successful.buy') }}" class="slide-item">Successful Purchase</a></li>
								<li><a href="{{ route('admin.pending.buy') }}" class="slide-item">Pending Purchase</a></li>
								<li><a href="{{ route('admin.declined.buy') }}" class="slide-item">Declined Purchase</a></li>
								</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/app.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Crypto Offer</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.all.offer') }}" class="slide-item">All Offers</a></li>
								<li><a href="{{ route('admin.successful.offer') }}" class="slide-item">Completed Trade</a></li>
								<li><a href="{{ route('admin.awaiting.offer') }}" class="slide-item">Trades Awaiting Admin Approval</a></li>
								<li><a href="{{ route('admin.pending.offer') }}" class="slide-item">Pending Trade</a></li>
								<li><a href="{{ route('admin.declined.offer') }}" class="slide-item">Disputed Trades</a></li>
								</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/bars-graphic.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Vault Manager</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.time-setting') }}" class="slide-item">Vault Cycle</a></li>
								<li><a href="{{ route('admin.plan-setting') }}" class="slide-item">Vault Plans</a></li>
								<li><a href="{{ route('admin.plan-running') }}" class="slide-item">Running Plans</a></li>
								<li><a href="{{ route('admin.plan-closed') }}" class="slide-item">Closed Plans</a></li>

							</ul>
						</li>
							<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/happy.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Users Manager</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.users.all') }}" class="slide-item">All Users</a></li>
								<li><a href="{{ route('admin.users.active') }}" class="slide-item">Active Users</a></li>
								<li><a href="{{ route('admin.users.emailUnverified') }}" class="slide-item">Email Unverified Users</a></li>
								<li><a href="{{ route('admin.users.smsUnverified') }}" class="slide-item">SMS Unverified Users</a></li>
								<li><a href="{{ route('admin.users.login.history') }}" class="slide-item">Login Session</a></li>
								<li><a href="{{ route('admin.users.email.all') }}" class="slide-item">Message Broadcast</a></li>
								<li><a href="{{ route('admin.users.banned') }}" class="slide-item">Blocked Users</a></li>

							</ul>
						</li>
						 <li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/calendar.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Verifications</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.pkyc') }}" class="slide-item">Pending KYC</a></li>
								<li><a href="{{ route('admin.vkyc') }}" class="slide-item">Verified</a></li>
								<li><a href="{{ route('admin.dkyc') }}" class="slide-item">Declined</a></li>
							</ul>
						</li>


						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/testing.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Deposit System</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.deposit.gateway.index') }}" class="slide-item">Automatic Gateway</a></li>
								<li><a href="{{ route('admin.deposit.manual.index') }}" class="slide-item">Manual Method</a></li>
								<li><a href="{{ route('admin.deposit.pending') }}" class="slide-item">Pending Deposit</a></li>
								<li><a href="{{ route('admin.deposit.approved') }}" class="slide-item">Approved Deposit</a></li>
								<li><a href="{{ route('admin.deposit.rejected') }}" class="slide-item">Declined Deposit</a></li>
								<li><a href="{{ route('admin.deposit.list') }}" class="slide-item">All Deposit</a></li>
                            </ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/testing.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Withdrawal System</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.withdraw.method.methods') }}" class="slide-item">Withdrawal Methods</a></li>
								<li><a href="{{ route('admin.withdraw.pending') }}" class="slide-item">Pending Withdrawals</a></li>
								<li><a href="{{ route('admin.withdraw.approved') }}" class="slide-item">Approved Withdrawal</a></li>
								<li><a href="{{ route('admin.withdraw.rejected') }}" class="slide-item">Declined Withdrawal</a></li>
								<li><a href="{{ route('admin.withdraw.log') }}" class="slide-item">All Withdrawal</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/calendar.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Support Tickets</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.ticket') }}" class="slide-item">All Tickets</a></li>
								<li><a href="{{ route('admin.open.ticket') }}" class="slide-item">Open Tickets</a></li>
								<li><a href="{{ route('admin.pending.ticket') }}" class="slide-item">Pending Tickets</a></li>
								<li><a href="{{ route('admin.closed.ticket') }}" class="slide-item">Closed Tickets</a></li>
								<li><a href="{{ route('admin.contact-topic') }}" class="slide-item">Support Types</a></li>
							</ul>
						</li>

                        <li class="slide">
							<a class="side-menu__item" href="{{ route('admin.report.transaction') }}"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/search.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Transaction Report</span></a>

						</li>

                        <li class="slide">
							<a class="side-menu__item" href="{{ route('admin.subscriber.index') }}"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/email.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Subscriptions</span></a>

						</li>
						<li class="slide">
							<a class="side-menu__item"  href="{{ route('admin.currency.index') }}"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/bitcoin-logo.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Crypto Settings</span></a>

						</li>

						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/layers.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">App Settings</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">

								<li><a href="{{ route('admin.plugin.index') }}" class="slide-item"> Add-ons Manager</a></li>
								<li><a href="{{ route('admin.frontend.homeContent.edit') }}" class="slide-item">Homepage</a></li>
								<li><a href="{{ route('admin.frontend.companyPolicy.index') }}" class="slide-item">Privacy & Policy</a></li>
								<li><a href="{{ route('admin.frontend.about.edit') }}" class="slide-item">About Page</a></li>
								<li><a href="{{ route('admin.frontend.social.index') }}" class="slide-item">Social Media</a></li>
								<li><a href="{{ route('admin.frontend.services.index') }}" class="slide-item">Our Services</a></li>
								<li><a href="{{ route('admin.frontend.seo.edit') }}" class="slide-item">SEO Manager</a></li>
								<li><a href="{{ route('admin.frontend.faq.index') }}" class="slide-item">FAQs</a></li>
								<li><a href="{{ route('admin.frontend.rules.index') }}" class="slide-item">Terms</a></li>
								<li><a href="{{ route('admin.frontend.blog.index') }}" class="slide-item">News & Blog</a></li>
								<li><a href="{{ route('admin.frontend.testimonial.index') }}" class="slide-item">Testimonial</a></li>
								<li><a href="{{ route('admin.frontend.section.contact.edit') }}" class="slide-item">Contact </a></li>

							</ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/testing.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">System Settings</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.setting.index') }}" class="slide-item">Basic Settings</a></li>
								<li><a href="{{ route('admin.setting.logo-icon') }}" class="slide-item">Logo & Favicon</a></li>

							</ul>
						</li>


						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><span class="icon-menu-img"><img src="{{url('/')}}/back/images/svgs/email.svg" class="side_menu_img svg-1" alt="image"></span><span class="side-menu__label">Email & SMS Settings</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.email-template.global') }}" class="slide-item">Email Template</a></li>
								<li><a href="{{ route('admin.email-template.index') }}" class="slide-item">Email Body</a></li>
								<li><a href="{{ route('admin.email-template.setting') }}" class="slide-item">Email Configuration</a></li>
								<li><a href="{{ route('admin.sms-template.global') }}" class="slide-item">SMS Content</a></li>
								<li><a href="{{ route('admin.sms-template.index') }}" class="slide-item">SMS Template</a></li>
							</ul>
						</li>


					</ul>
				</aside>
				<!-- Sidemenu closed -->
				<!-- App-content opened -->
				<div class="app-content icon-content">
					<div class="section">

						<!-- Page-header opened -->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">{{ $page_title }}</h4>
								<small class="text-muted mt-0 fs-14">Date:  {{date(' d M, Y ', strtotime(\Carbon\Carbon::now()))}}  {{date('h:i A',  strtotime(\Carbon\Carbon::now()))}} </small>
							</div>
							<div class="page-rightheader">
								<div class="ml-3 ml-auto d-flex">
									<div class="mt-3 mt-md-0">
										<div class="border-right pr-4 mt-1 d-xl-block">
											<p class="text-muted mb-2">IP Address</p>
											@php
											if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                          $ip = $_SERVER['HTTP_CLIENT_IP'];
                                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                          } else {
                                          $ip = $_SERVER['REMOTE_ADDR'];
                                          }

                                            @endphp
											<h6 class="font-weight-semibold mb-0">{{$ip}}</h6>
										</div>
									</div>
									<div class="mt-3 mt-md-0">
										<div class="border-right pl-0 pl-md-4 pr-4 mt-1 d-xl-block">
											<p class="text-muted mb-1">Customer Rating</p>
											<div class="wideget-user-rating">
												<a href="#">
													<i class="fa fa-star text-success"></i>
												</a>
												<a href="#">
													<i class="fa fa-star text-success"></i>
												</a>
												<a href="#">
													<i class="fa fa-star text-success"></i>
												</a>
												<a href="#">
													<i class="fa fa-star text-success"></i>
												</a>
												<a href="#">
													<i class="fa fa-star text-success mr-1"></i>
												</a>

											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<!-- Page-header closed -->
@yield('content')



		<!-- Footer opened -->
			<footer class="footer-main icon-footer">
				<div class="container">
					<div class="  mt-2 mb-2 text-center">
					Copyright © {{date('Y')}}  <a href="#" class="fs-14 text-primary">{{__($general->sitename)}}</a> @lang('All rights reserved')
					</div>
				</div>
			</footer>
			<!-- Footer closed -->
		</div>

        @include('partials.notify-js')

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

		<!-- Jquery-scripts -->
		<script src="{{url('/')}}/back/js/vendors/jquery-3.2.1.min.js"></script>

		<!-- Moment js-->
        <script src="{{url('/')}}/back/plugins/moment/moment.min.js"></script>

		<!-- Bootstrap-scripts js -->
		<script src="{{url('/')}}/back/js/vendors/bootstrap.bundle.min.js"></script>

		<!-- Sparkline JS-->
		<script src="{{url('/')}}/back/js/vendors/jquery.sparkline.min.js"></script>

		<!-- Bootstrap-daterangepicker js -->
		<script src="{{url('/')}}/back/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

		<!-- Bootstrap-datepicker js -->
		<script src="{{url('/')}}/back/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

		<!-- Chart-circle js -->
		<script src="{{url('/')}}/back/js/vendors/circle-progress.min.js"></script>

		<!-- Rating-star js -->
		<script src="{{url('/')}}/back/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Clipboard js -->
		<script src="{{url('/')}}/back/plugins/clipboard/clipboard.min.js"></script>
		<script src="{{url('/')}}/back/plugins/clipboard/clipboard.js"></script>

		<!-- Prism js -->
		<script src="{{url('/')}}/back/plugins/prism/prism.js"></script>

		<!-- Custom scroll bar js-->
		<script src="{{url('/')}}/back/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- Nice-select js-->
		<script src="{{url('/')}}/back/plugins/jquery-nice-select/js/jquery.nice-select.js"></script>
		<script src="{{url('/')}}/back/plugins/jquery-nice-select/js/nice-select.js"></script>

        <!-- P-scroll js -->
		<script src="{{url('/')}}/back/plugins/p-scroll/p-scroll.js"></script>
		<script src="{{url('/')}}/back/plugins/p-scroll/p-scroll-1.js"></script>

		<!-- Sidemenu js-->
		<script src="{{url('/')}}/back/plugins/sidemenu/icon-sidemenu.js"></script>

		<!-- JQVMap -->
		<script src="{{url('/')}}/back/plugins/jqvmap/jquery.vmap.js"></script>
		<script src="{{url('/')}}/back/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="{{url('/')}}/back/plugins/jqvmap/jquery.vmap.sampledata.js"></script>

		<!-- Apexchart js-->
		<script src="{{url('/')}}/back/js/apexcharts.js"></script>

		<!-- Chart js-->
		<script src="{{url('/')}}/back/plugins/chart/chart.min.js"></script>

		<!-- Index js -->
		<script src="{{url('/')}}/back/js/index.js"></script>
		<script src="{{url('/')}}/back/js/index-map.js"></script>

		<!-- Rightsidebar js -->
		<script src="{{url('/')}}/back/plugins/sidebar/sidebar.js"></script>

		<!-- Custom js -->
		<script src="{{url('/')}}/back/js/custom.js"></script>
		<script src="{{url('/')}}/back/plugins/datatable/js/jquery.dataTables.js"></script>
		<script src="{{url('/')}}/back/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="{{url('/')}}/back/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="{{url('/')}}/back/plugins/datatable/responsive.bootstrap4.min.js"></script>

        @yield('javascript')

		<!-- Data table js -->
		<script src="{{url('/')}}/back/js/datatable.js"></script>

		<script src="{{url('/')}}/back/plugins/select2/select2.full.min.js"></script>
		<script src="{{url('/')}}/back/js/select2.js"></script>


	</body>
</html>
