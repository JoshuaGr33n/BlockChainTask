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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Data table css -->
		<link href="{{url('/')}}/back/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{url('/')}}/back/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/datatable/css/buttons.bootstrap4.min.css">
		<link href="{{url('/')}}/back/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<!-- Bootstrap css -->
		<link href="{{url('/')}}/back/plugins/bootstrap-4.1.3/css/bootstrap.min.css" rel="stylesheet" />


		<link href="{{url('/')}}/back/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

		<!-- News-Ticker css-->
		<link href="{{url('/')}}/back/plugins/newsticker/jquery.jConveyorTicker.css" rel="stylesheet"/>

		<!-- Style css -->
		<link href="{{url('/')}}/back/css/style.css" rel="stylesheet" />

		<!-- Default css -->
		<link href="{{url('/')}}/back/css/default.css" rel="stylesheet">

		<!-- Sidemenu css-->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/sidemenu/sidemenu.css">

		<!-- Bootstrap-daterangepicker css -->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/bootstrap-daterangepicker/daterangepicker.css">

		<!-- Bootstrap-datepicker css -->
		<link rel="stylesheet" href="{{url('/')}}/back/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

		<!-- Custom scroll bar css -->
		<link href="{{url('/')}}/back/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

		<!-- Sidemenu-repsonsive-tabs  css -->
		<link href="{{url('/')}}/back/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css" rel="stylesheet">

		<!-- P-scroll css -->
		<link href="{{url('/')}}/back/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

		<!-- Nice-select css  -->
		<link href="{{url('/')}}/back/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet"/>

		<!-- Select2 Plugin -->
		<link href="{{url('/')}}/back/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- News-Ticker css-->
		<link href="{{url('/')}}/back/plugins/newsticker/jquery.jConveyorTicker.css" rel="stylesheet" />

		<!-- Font icons css-->
		<link  href="{{url('/')}}/back/css/icons.css" rel="stylesheet">

		<!-- Rightsidebar css -->
		<link href="{{url('/')}}/back/plugins/sidebar/sidebar.css" rel="stylesheet">


		<!-- Color-palette css-->
		<link rel="stylesheet" href="{{url('/')}}/back/css/skins.css"/>

	</head>
	<body class="app @if(Auth::user()->darkmode == 1 ) dark-mode @endif">

		<!-- Loader -->
		<div id="loading">
			<img src="{{url('/')}}/back/images/other/loader.svg" class="loader-img" alt="Loader">
		</div>

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!-- Top-header opened -->
				<div class="header-main header sticky">
					<div class="app-header header top-header navbar-collapse " style="background-color: {{$general->bclr}}">
						<div class="container-fluid">
							<div class="d-flex">
								<a class="header-brand" href="{{url('/')}}">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}"  class="header-brand-img desktop-logo " alt="Dashlot logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}"  class="header-brand-img desktop-logo-1 " alt="Dashlot logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}"  width="80"  class="mobile-logo" alt="Dashlot logo">
									<img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}"  width="80" class="mobile-logo-1" alt="Dashlot logo">
								</a>
								<a href="#" data-toggle="sidebar" class="nav-link icon toggle"><i class="fe fe-align-justify fs-20 text-white"></i></a>
								<div class="d-flex header-left left-header">
									<div class="d-none d-lg-block horizontal">
										<ul class="nav">
											<li class="">
												<div class="dropdown d-none d-md-flex">
													<a href="#" class="d-flex nav-link pr-0  pt-2 mt-3 country-flag1" data-toggle="dropdown">
														<span class="d-flex"><img src="{{url('/')}}/back/images/us_flag.jpg" alt="img" class="avatar country-Flag mr-2 align-self-center"></span>
														<div>
															<span class="d-flex fs-14 mr-3 mt-0 text-white">English<span><i class="mdi mdi-chevron-down text-white"></i></span></span>
														</div>
													</a>
													<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
														<a href="#" class="dropdown-item d-flex align-items-center mt-2">
															<img src="{{url('/')}}/back/images/french_flag.jpg" alt="flag-img" class="w-6 flag-sm mr-3 align-self-center">
															<div>
																<span>French</span>
															</div>
														</a>
														<a href="#" class="dropdown-item d-flex align-items-center">
															<img src="{{url('/')}}/back/images/germany_flag.jpg" alt="flag-img" class="w-6 flag-sm mr-3 align-self-center">
															<div>
																<span>Germany</span>
															</div>
														</a>
														<a href="#" class="dropdown-item d-flex align-items-center">
															<img src="{{url('/')}}/back/images/italy_flag.jpg" alt="flag-img" class="w-6 flag-sm  mr-3 align-self-center">
															<div>
																<span>Italy</span>
															</div>
														</a>
														<a href="#" class="dropdown-item d-flex align-items-center">
															<img src="{{url('/')}}/back/images/russia_flag.jpg" alt="flag-img" class="w-6 flag-sm mr-3 align-self-center">
															<div>
																<span>Russia</span>
															</div>
														</a>
														<a href="#" class="dropdown-item d-flex align-items-center mb-2">
															<img src="{{url('/')}}/back/images/spain_flag.jpg" alt="flag-img" class="w-6 flag-sm mr-3 align-self-center">
															<div>
																<span>Spain</span>
															</div>
														</a>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="d-flex header-right ml-auto">
									<div class="dropdown header-fullscreen">
										<a class="nav-link icon full-screen-link" id="fullscreen-button">
											<i class="mdi mdi-arrow-collapse fs-20 text-white"></i>
										</a>
									</div><!-- Fullscreen -->

									@php $notify = App\SupportTicket::where('user_id', Auth::id())->whereStatus(1)->latest()->get() @endphp
									<div class="dropdown header-notify">
										<a class="nav-link icon text-center" data-toggle="dropdown">
											@if(count($notify) > 0)
											<i class="typcn typcn-bell text-white bell-animations"></i>
											<span class="pulse bg-success"></span>
											@else
											<i class="typcn typcn-bell text-white"></i>

											@endif

										</a>

										<div class="dropdown-menu dropdown-menu-right animated bounceInDown dropdown-menu-arrow w-250">
											<div class="dropdown-header p-4 mb-2 bg-header-image p-5 text-white">
												<h5 class="dropdown-title mb-1 font-weight-semibold text-drak">Notifications</h5>

												<p class="dropdown-title-text subtext mb-0 pb-0 fs-13">You have {{count($notify)}} new notifications</p>
											</div>
											<div class="drop-notify">

											 @foreach($notify as $k=>$data)
												<a href="{{ route('user.message', $data->ticket) }}" class="dropdown-item d-flex pb-3 pl-4 pr-2 border-bottom">
													<div class="notifyimg bg-success-transparent text-success-shadow"><i class="fa fa-calendar fs-18 text-success"></i></div>
													<div><strong>New Message</strong>
														<div class="small fs-14 text-muted">{{date(' d M, Y ', strtotime($data->created_at))}}</div>
													</div>
												</a>
											@endforeach

											</div>
											<div class="dropdown-divider mb-0"></div>
											<a href="#" class="dropdown-item text-center br-br-6 br-bl-6">See all Messages</a>
										</div>
									</div><!-- Notification -->
									<div class="dropdown d-md-flex message">
									<a class="nav-link icon text-center" data-toggle="dropdown">
										@if(Auth::user()->darkmode == 1 )
                                       <i class="wi wi-day-sunny test-white"></i>
									    <!-- Lightmode -->
									    @else
                                        <i class="wi wi-moonrise text-white"></i>

								    	<!-- Darkmode -->
									    @endif
										<div class="dropdown-menu dropdown-menu-right animated bounceInDown dropdown-menu-arrow">



											@if(Auth::user()->darkmode == 1 )
											<a href="{{route('user.lightmode')}}" class="dropdown-item text-center p-3">ACTIVAT LIGHT MODE</a>

									    <!-- Lightmode -->
									    @else
                                        <a href="{{route('user.darkmode')}}" class="dropdown-item text-center p-3">ACTIVATE DARK MODE</a>
								    	<!-- Darkmode -->
									    @endif

										</div>
									</div><!-- Message-box -->
									<div class="dropdown d-md-flex d-cart">

										<div class="dropdown-menu dropdown-menu-right animated bounceInDown dropdown-menu-arrow">


											<div class="dropdown-divider mb-0 mt-0"></div>
											<a href="#" class="dropdown-item text-center p-3">See all Items</a>
										</div>
									</div><!-- Cart -->
									<div class="dropdown drop-profile">
										<a class="nav-link pr-0 leading-none" href="#" data-toggle="dropdown" aria-expanded="false">
											<div class="profile-details mt-1">
												<span class="mr-3 mb-0  fs-15 font-weight-semibold text-white">{{Auth::user()->username}}</span>
												<small class="text-muted mr-3 text-white">{{Auth::user()->address->country}}</small>
											</div>
											<img class="avatar avatar-md brround" src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}" alt="image">&nbsp;
										 </a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated bounceInDown w-250">
											<div class="user-profile bg-header-image border-bottom p-3">
												<div class="user-image text-center">
													<img class="user-images" src="{{ get_image(config('constants.user.profile.path') .'/'. Auth::user()->image) }}" alt="image">
												</div>
												<div class="user-details text-center">
													<h4 class="mb-0">{{Auth::user()->firstname . Auth::user()->lastname}}</h4>
													<p class="mb-1 fs-13 text-white-50">{{Auth::user()->email}}</p>
												</div>
											</div>
											<a class="dropdown-item" href="{{route('user.edit-profile')}}">
												<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
											</a>
											<a class="dropdown-item" href="{{route('user.twoFA')}}">
												<i class="dropdown-icon  mdi mdi-settings"></i> Settings
											</a>
											<a class="dropdown-item" href="{{route('user.ticket')}}">
												<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Messages
											</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{route('user.ticket.open') }}">
												<i class="dropdown-icon mdi mdi-compass"></i> Need help?
											</a>
											<a class="dropdown-item mb-1" href="{{route('user.logout')}}">
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
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar" >
					<div class="side-tab-body p-0 border-0" id="sidemenu-Tab" >
						<div class="first-sidemenu" style="background-color: {{$general->bclr}}">
							<div class="line-animations">
								<ul class="resp-tabs-list hor_1">
									<li href="{{route('user.home')}}"><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/homepage.svg" class="side_menu_img svg-1" alt="image"></li>
									<li class="resp-tab-active active"><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/bitcoin-logo.svg" class="side_menu_img svg-1" alt="image"></li>
									<li><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/bars-graphic.svg" class="side_menu_img svg-1" alt="image"></li>
									<li><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/shopping-cart.svg" class="side_menu_img svg-1" alt="image"></li>
									<li><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/email.svg" class="side_menu_img svg-1" alt="image"></li>
									<li><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/happy.svg" class="side_menu_img svg-1" alt="image"></li>
									<li><span class="side-menu__icon"></span><img src="{{url('/')}}/back/images/svgs/login.svg" class="side_menu_img svg-1" alt="image"></li>
								</ul>
							</div>
						</div>
						<div class="second-sidemenu">
							<div class="resp-tabs-container hor_1">
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side1">
															<h5 class="mt-3 mb-4">Dashboard</h5>
															<a class="slide-item" href="{{route('user.home')}}">Dashboard</a>
															<a class="slide-item" href="{{route('user.transactions')}}">Account Statement</a>



														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="resp-tab-content-active">
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side11">
															<h5 class="mt-3 mb-4">Blockchain Wallets</h5>

															@php $currencies = App\Currency::whereStatus(1)->whereCanwallet(1)->orderBy('name','asc')->get(); @endphp
															@foreach($currencies as $data)
															@php $walletbal = number_format(App\Cryptowallet::whereStatus(1)->whereCoin_id($data->id)->sum('usd'),2); @endphp
															<a href="{{route('user.wallet',$data->symbol)}}">
															<div class="d-flex mb-4">
																<img class="w-6 h-6 mt-2 mr-4" src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$data->image}}" alt="image">
																<div class="mr-4">
																	<div class="fs-15">
																		<span class="fs-14">{{$data->name}}</span>
																		<strong>{{$data->symbol}}</strong>
																	</div>
																	<div class="fs-15">
																		<strong class="@if($walletbal > 0) text-success @else text-danger @endif">${{$walletbal}}</strong>
																	</div>
																</div>
															</div>
															</a>
															@endforeach

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active" id="side-1">
															<h5 class="mt-3 mb-4">Deposit Fiat</h5>
															<a href="{{route('user.deposit')}}" class="slide-item">Deposit Fiat</a>
															<a href="{{route('user.deposit.history')}}" class="slide-item">Deposit Log</a>
                                                            <hr>
                                                            <h5 class="mt-3 mb-4">Withdraw Fiat</h5>
															<a href="{{route('user.withdraw.money')}}" class="slide-item">New Withdrawal</a>
															<a href="{{route('user.withdrawLog')}}" class="slide-item">Withdrawal Log</a>
															<hr>
															<h5 class="mt-3 mb-4">Lock Fund</h5>
															<a href="{{route('user.vault')}}" class="slide-item">Lock Fund</a>
															<a href="{{route('user.interest.log')}}" class="slide-item">Returns Log</a>

                                                            <h5 class="fs-15 font-weight-semibold mt-5 mb-4">Overview</h5>

													<div class="card p-3 px-4">
														<div class=" fs-14 mb-1">Total Deposits</div>
														<div class=" m-0 mb-1 h3 text-primary-1">{{$general->cur_sym}}{{formatter_money(App\Deposit::where('user_id', Auth::id())->whereStatus(1)->sum('amount'))}}</div>
														<div class="progress progress-xs box-shadow-0 mt-2 mb-2">
															<div class="progress-bar progress-animated bg-success box-shadow-0 w-100"></div>
														</div>
														<div class="d-flex">
															<small class="text-muted">Latest</small>
															<div class="ml-auto"><i class="fa fa-caret-up text-green"></i> {{$general->cur_sym}}{{formatter_money(App\Deposit::where('user_id', Auth::id())->where('status', 1)->orderby('id', 'desc')->first()->amount ?? "0.00")}}</div>
														</div>
													</div>



													<div class="card p-3 px-4">
														<div class=" fs-14 mb-1">Total Withdrawal</div>
														<div class=" m-0 mb-1 h3 text-primary-1">{{$general->cur_sym}}{{formatter_money(App\Withdrawal::where('user_id', Auth::id())->whereStatus(1)->sum('amount'))}}</div>
														<div class="progress progress-xs box-shadow-0 mt-2 mb-2">
															<div class="progress-bar progress-animated bg-success box-shadow-0 w-100"></div>
														</div>
														<div class="d-flex">
															<small class="text-muted">Latest</small>
															<div class="ml-auto"><i class="fa fa-caret-up text-green"></i> {{$general->cur_sym}}{{formatter_money(App\Withdrawal::where('user_id', Auth::id())->where('status', 1)->orderby('id', 'desc')->first()->amount ?? "0.00")}}</div>
														</div>
													</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side-11">
															<h5 class="mt-3 mb-4">Trade Cryptocurrency</h5>
															<a href="{{route('user.buy')}}" class="slide-item">Buy Cryptocurrency</a>
															<a href="{{route('user.sell')}}" class="slide-item">Sell Cryptocurrency</a>
															<a href="{{route('user.p2p')}}" class="slide-item">P2P Market Offers</a>
															<a href="{{route('user.p2plog')}}" class="slide-item">P2P Trade Log</a>
															<a href="{{route('user.createoffer')}}" class="slide-item">Create New Offer</a>
															<a href="{{route('user.myoffers')}}" class="slide-item">My Offers</a>

														</div>
													</div>
													<h5 class="fs-15 font-weight-semibold mt-5 mb-4">Overview</h5>
													<div class=" mt-4">
																<div class="card menu-icons">
																	<div class="card-body p-3">
																		<div class="d-flex">
																			<div class="pr-4 mt-0">
																				<i class="fa fa-bank bg-info-transparent text-info-shadow text-info menu-icon"></i>
																			</div>
																			<div class="">
																				<span>Total Sales</span>
																				<h3 class="mb-0 fs-20">${{formatter_money(App\Trade::where('user_id', Auth::id())->whereStatus(1)->whereType(2)->sum('amount'))}}</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class=" mt-4">
																<div class="card menu-icons">
																	<div class="card-body p-3">
																		<div class="d-flex">
																			<div class="pr-4 mt-0">
																				<i class="fa fa-handshake-o  bg-success-transparent text-success-shadow text-success menu-icon"></i>
																			</div>
																			<div class="">
																				<span>Total Buy</span>
																				<h3 class="mb-0 fs-20">${{formatter_money(App\Trade::where('user_id', Auth::id())->whereStatus(1)->whereType(1)->sum('amount'))}}</h3>
																			</div>
																		</div>
																	</div>
																</div>
															</div>


												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side-21">
															<h5 class="mt-3 mb-4">Support</h5>
															<a href="{{route('user.ticket.open') }}" class="slide-item"> Create Tickets</a>
															<a href="{{route('user.ticket')}}" class="slide-item"> Support Tickets</a>

															<div class="row p-2">
																<div class="col-6 p-0">
																	<div class="border text-center border-right-0"><i class="fa fa-phone fs-30 text-secondary-shadow text-secondary"></i> <a><small class="mb-0">Call</small></a> </div>
																</div>
																<div class="col-6 p-0">
																	<div class="border text-center"><i class="fa fa-envelope fs-30 text-warning-shadow text-warning"></i> <a><small class="mb-0">Mail</small></a> </div>
																</div>

															</div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side21">
															<h5 class="mt-3 mb-4">Account Settings</h5>
															<a href="{{route('user.referral')}}" class="slide-item">Referral Log</a>
															<a href="{{route('user.my-profile')}}" class="slide-item">My Profile</a>
															<a href="{{route('user.edit-profile')}}" class="slide-item">Edit Profile</a>
															<a href="{{route('user.kyc')}}" class="slide-item">KYC Verification</a>


														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>



									<div class="row">
										<div class="col-md-12">
											<div class="panel sidetab-menu">
												<div class="panel-body tabs-menu-body p-0 border-0">
													<div class="tab-content">
														<div class="tab-pane active " id="side21">
															<h5 class="mt-3 mb-4">Account Settings</h5>
															<a href="{{route('user.change-password')}}" class="slide-item">Password</a>
															<a href="{{route('user.twoFA')}}" class="slide-item">Google 2FA</a>
															<a href="{{route('user.sessionlog')}}" class="slide-item">Session Log</a>
															<a href="{{route('user.logout')}}" class="slide-item">Logout</a>


														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>

								</div>
							</div>
						</div>
					</div>
				</aside>
				<!-- Sidemenu closed -->

				<!-- App-content opened -->
				<div class="app-content">
					<div class="section">

						<!-- Page-header opened -->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">
								<?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        echo "Good morning";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        echo "Good afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        echo "Good evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        echo "Good night";
    }
    ?>
								! {{Auth::user()->username}}</h4><br>
								<small class="text-muted mt-0">{{$page_title}}</small>
								<ul class="product-gallery-rating">
															<li>
														KYC Verification	 @if(Auth::user()->kyc == 1)
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																<a href="#"><i class="fa fa-star text-success"></i></a>
																@else
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																<a href="#"><i class="fa fa-star-o text-warning"></i></a>
																@endif
															</li>
														</ul>
							</div>
							<div class="page-rightheader">
								<div class="d-flex mt-4 mt-xl-0 mt-lg-0">
									<div class="media mr-5 mt-0">
										<div class="media-body">
											<label class="text-muted mb-1">IP</label>
											<h6 class="mb-0">{{App\UserLogin::whereUser_id(Auth::user()->id)->orderby('id','desc')->first()->user_ip ?? 'unknown'}}</h6>
										</div><!-- media-body -->
									</div><!-- media -->
									<div class="media mr-2 mt-0">
										<div class="media-body">
											<label class="text-muted mb-1">Country</label>
											<h6 class="mb-0">{{App\UserLogin::whereUser_id(Auth::user()->id)->orderby('id','desc')->first()->country ?? 'unknown'}}</h6>
										</div><!-- media-body -->
									</div><!-- media -->

								</div>
							</div>
						</div>
						<!-- Page-header closed -->

@yield('content')



			<!-- Footer opened -->
			<footer class="footer-main leftmenu-footer">
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

		<!-- Rating-star js -->
		<script src="{{url('/')}}/back/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Custom scroll bar js-->
		<script src=".{{url('/')}}/back/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- P-scroll js -->
		<script src="{{url('/')}}/back/plugins/p-scroll/p-scroll.js"></script>
		<script src="{{url('/')}}/back/plugins/p-scroll/p-scroll-leftmenu.js"></script>

		<!-- Sidemenu js-->
		<script src="{{url('/')}}/back/plugins/sidemenu/sidemenu.js"></script>

		<!-- Sidemenu-respoansive-tabs js -->
		<script src="{{url('/')}}/back/plugins/sidemenu-responsive-tabs/js/sidemenu-responsive-tabs.js"></script>

		<!-- Leftmenu js -->
		<script src="{{url('/')}}/back/js/left-menu.js"></script>

		<!--Newsticker js-->
		<script src="{{url('/')}}/back/plugins/newsticker/jquery.jConveyorTicker.js"></script>
		<script src="{{url('/')}}/back/js/newsticker.js"></script>

		<!-- Chart js-->
		<script src="{{url('/')}}/back/plugins/chart/chart.min.js"></script>

		<!-- Nice-select js-->
		<script src="{{url('/')}}/back/plugins/jquery-nice-select/js/jquery.nice-select.js"></script>
		<script src="{{url('/')}}/back/plugins/jquery-nice-select/js/nice-select.js"></script>

		<!-- Rightsidebar js -->
		<script src="{{url('/')}}/back/plugins/sidebar/sidebar.js"></script>

		<!-- Index js-->
		<script src="{{url('/')}}/back/js/index2.js"></script>

		<!-- Custom js-->
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





			<script>
	(function($) {
		"use strict";

		//accordion-wizard
		var options = {
			mode: 'wizard',
			autoButtonsNextClass: 'btn btn-primary float-right',
			autoButtonsPrevClass: 'btn btn-info',
			stepNumberClass: 'badge badge-pill badge-primary mr-1',
			//onSubmit: function() {
			  //alert('Form sdon ubmitted!');
			  //return true;
			//}
		}
		$( "#form" ).accWizard(options);

	})(jQuery);
</script>


	</body>
</html>
