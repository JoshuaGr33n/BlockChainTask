@extends('include.admin')

@section('content')


						<!-- Banner opened -->
						<div class="row">
							<div class="col-xl-12">
								<div class="banner banner-color mt-0">
									<div class="col-xl-2 col-lg-3 col-md-12">
										<img src="{{url('/')}}/back/images/svg/new_message.svg" alt="image" class="image">
									</div>
									<div class="page-content col-xl-7 col-lg-6 col-md-12">
										<h3 class="mb-1">Welcome back! {{auth()->guard('admin')->user()->username}}</h3>
										<p class="mb-0 fs-16">Want to add more features to your {{$general->sitename}} App?</p>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 text-right d-flex d-block">
										<a href="#" class="btn btn-success mr-3" id="skip">Skip</a>
										<a href="#" class="btn btn-primary"  style="background-color: {{$general->bclr}}">Contact Author</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Banner opened -->

						<!-- row opened -->
						<div class="row">
						@foreach($widget['users_wallets'] as $data)
							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">{{strtoupper(str_replace('_',' ',$data->type))}}</p>
												<h2 class="mb-1 ">{{ $general->cur_sym }}  {{ formatter_money($data->amo) }}</h2>
												<p class="mb-0 text-muted"><span class="text-success">(+0.35%)<i class="fe fe-arrow-up text-success"></i></span>Increase</p>
											</div>
											<div class=" my-auto ml-auto">
												<div class="chart-wrapper text-center">
													<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto">
													 <a href="{{ route('admin.users.all') }}" class="btn btn-sm btn-neutral">View all</a>
													</canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach

							<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">Escrow Held</p>
												<h2 class="mb-1 ">{{ $general->cur_sym }}  {{ formatter_money($widget['escrow']) }}</h2>
												<p class="mb-0 text-muted"><span class="text-success"><i class="fe fe-lock text-danger"></i></span>Fund Held In Escrow</p>
											</div>
											<div class=" my-auto ml-auto">
												<div class="chart-wrapper text-center">
													<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto">
													 <a href="{{ route('admin.users.all') }}" class="btn btn-sm btn-neutral">View all</a>
													</canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
								<div class="card overflow-hidden">
									<div class="card-body">
										<div class="d-flex">
											<div class="">
												<p class="mb-2 h6">Escrow Settled</p>
												<h2 class="mb-1 ">{{ $general->cur_sym }}  {{ formatter_money($widget['escrows']) }}</h2>
												<p class="mb-0 text-muted"><span class="text-success"><i class="fe fe-unlock text-success"></i></span>Fund Settled In Escrow</p>
											</div>
											<div class=" my-auto ml-auto">
												<div class="chart-wrapper text-center">
													<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto">
													 <a href="{{ route('admin.users.all') }}" class="btn btn-sm btn-neutral">View all</a>
													</canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- row closed -->

						<!-- row opened -->
						<div class="row">
							<div class="col-xl-12 product">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Users Statistics</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
													<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">

											<div class="col-lg-12 col-xl-12 lg-mt-12">
												<div class="row">
													<div class="col-6">
														<div class="card box-shadow-0 overflow-hidden">
															<div class="card-body p-4">
																<div class="text-center">
																   <i class="fa fa-users fa-2x text-primary text-primary-shadow"></i>
																   <h3 class="mt-3 mb-0 ">{{ collect($widget['total_users'])->count() }}</h3>
																   <small class="text-muted">Total Users</small>
																</div>
															</div>
														</div>
													</div>
													 <div class="col-6">
														<div class="card box-shadow-0 overflow-hidden">
															<div class="card-body p-4">
																<div class="text-center">
																   <i class="fa fa-shield fa-2x text-secondary text-secondary-shadow"></i>
																	<h3 class="mt-3 mb-0 ">{{ collect($widget['total_users'])->where('status', 1)->count() }}</h3>
																   <small class="text-muted">Active Users</small>
																</div>
															</div>
														</div>
													</div>
													<div class="col-6">
														<div class="card box-shadow-0 mb-0 overflow-hidden">
															<div class="card-body p-4">
																<div class="text-center">
																   <i class="fa fa-phone fa-2x text-success text-success-shadow"></i>
																   <h3 class="mt-3 mb-0 ">{{ collect($widget['total_users'])->where('sv', 1)->count() }}</h3>
																   <small class="text-muted">SMS Verified Users</small>
																</div>
															</div>
														</div>
													</div>
													<div class="col-6 ">
														<div class="card box-shadow-0 mb-0 overflow-hidden">
															<div class="card-body p-4">
																<div class="text-center">
																   <i class="fa fa-envelope fa-2x text-info text-info-shadow"></i>
																   <h3 class="mt-3 mb-0 ">{{ collect($widget['total_users'])->where('ev', 1)->count() }}</h3>
																   <small class="text-muted">Email Verified Users</small>
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
						</div>
						<!-- row closed -->

						<!-- row opened -->
						<div class="row">

							<div class="col-xl-6 col-lg-6">
								<div class="card">
									<div id="carousel-indicator" class="carousel slide dashboard-carousel" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Deposits</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ formatter_money($widget['deposits']->total) }}<span class="font-weight-normal text-muted fs-13">/ Deposits</span></h2>

													</div>
												</div>
											</div>
											<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Deposited Amount</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ $general->cur_sym }}{{ formatter_money($widget['deposits']->total_amount) }}<span class="font-weight-normal text-muted fs-13">/ Deposited</span></h2>

													</div>
												</div>
											</div>

											<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Deposit Charge</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ $general->cur_sym }}{{ formatter_money($widget['deposits']->total_charge) }}<span class="font-weight-normal text-muted fs-13">/ Charges</span></h2>

													</div>
												</div>
											</div>
										</div>
										<a class="carousel-control-prev" href="#carousel-indicator" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carousel-indicator" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>

							</div>
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div id="carousel-indicator1" class="carousel slide dashboard-carousel" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Withdraws</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ formatter_money($widget['withdrawals']->total) }}<span class="font-weight-normal text-muted fs-13">/ Withdrawals</span></h2>

													</div>
												</div>
											</div>
											<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Withdrawals</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ $general->cur_sym }}{{ formatter_money($widget['withdrawals']->total_amount) }}<span class="font-weight-normal text-muted fs-13">/ Withdrawn</span></h2>

													</div>
												</div>
											</div>
											<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">
												<div class="card-body">
													<h4 class="card-title mb-4">Total Withdrawal Charge</h4>
													<small class=""> Since Startup</small>
													<div class="d-flex  align-items-center">
														<h2 class=" mb-0">{{ $general->cur_sym }}{{ formatter_money($widget['withdrawals']->total_charge) }}<span class="font-weight-normal text-muted fs-13">/ Charged</span></h2>

													</div>
												</div>
											</div>
										</div>
										<a class="carousel-control-prev" href="#carousel-indicator1" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carousel-indicator1" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>

							</div>
						</div>
						<!-- row closed -->

						<div class="row">

  <div class="col-xl-4 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="font-weight-normal">Users By OS</h4>
      </div>
      <div class="card-body">
        <canvas id="userOsChart"></canvas>
      </div>
    </div>
  </div><!--card end-->

  <div class="col-xl-4 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="font-weight-normal">Users By Browser</h4>
      </div>
      <div class="card-body">
        <canvas id="userBrowserChart"></canvas>
      </div>
    </div>
  </div><!--card end-->

  <div class="col-xl-4 col-lg-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="font-weight-normal">Users By Country</h4>
      </div>
      <div class="card-body">
        <canvas id="userCountryChart"></canvas>
      </div>
    </div>
  </div><!--card end-->

</div>







					</div>
				</div>
				<!-- App-content closed -->
			</div>
			@endsection

@section('javascript')

<link rel="stylesheet" href="{{ asset('assets/admin/css/chart.min.css') }}">

<script src="{{ asset('assets/admin/js/chart-all.min.js') }}"></script>
<script>
var ctx = document.getElementById('userBrowserChart').getContext('2d');
  ctx.canvas.height = 260;
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: @json($chart['user_browser_counter']->keys()),
          datasets: [{
              data: {{ $chart['user_browser_counter']->flatten() }},
              backgroundColor: [
                '#e74c3c',
                '#9b59b6',
                '#34495e',
                '#e67e22',
                '#f1c40f',
                '#7f8c8d',
                '#3498db',
                '#1abc9c',
              ],
              borderColor: [
                  'rgba(231, 80, 90, 0.75)'
              ],
              borderWidth: 1,

          }]
      },
      options: {
          elements: {
              line: {
                  tension: 1 // disables bezier curves
              }
          },

      }
  });


var ctx = document.getElementById('userOsChart').getContext('2d');
ctx.canvas.height = 260;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chart['user_os_counter']->keys()),
        datasets: [{
            data: {{ $chart['user_os_counter']->flatten() }},
            backgroundColor: [
              '#e74c3c',
              '#9b59b6',
              '#34495e',
              '#e67e22',
              '#f1c40f',
              '#7f8c8d',
              '#3498db',
              '#1abc9c',
            ],
            borderColor: [
                'rgba(231, 80, 90, 0.75)'
            ],
            borderWidth: 1,

        }]
    },
    options: {
        elements: {
            line: {
                tension: 1 // disables bezier curves
            }
        },

    }
});
var ctx = document.getElementById('userCountryChart').getContext('2d');
ctx.canvas.height = 260;
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chart['user_country_counter']->keys()),
        datasets: [{
            data: {{ $chart['user_country_counter']->flatten() }},
            backgroundColor: [
              '#e74c3c',
              '#9b59b6',
              '#34495e',
              '#e67e22',
              '#f1c40f',
              '#7f8c8d',
              '#3498db',
              '#1abc9c',
            ],
            borderColor: [
                'rgba(231, 80, 90, 0.75)'
            ],
            borderWidth: 1,

        }]
    },
    options: {
        elements: {
            line: {
                tension: 1 // disables bezier curves
            }
        },

    }
});
</script>
@endsection
