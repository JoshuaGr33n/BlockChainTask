@extends('include.admin')

@section('content')
<!-- row opened -->
						<div class="row">
							<div class="col-12">

							<div class="card-body card">
							<div class="card-header">
										<div class="card-title">Current Settings</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
                        <div class="table-responsive">
                            <table class="table">

                                <thead>
                                <tr>

                                    <th>Level</th>
                                    <th>Commision</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($trans as $key => $p)
                                    <tr>
                                        <td>LEVEL# {{ $p->level }}</td>
                                        <td>{{ $p->percent }} %</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

								<div class="card">
									<div class="card-header">
										<div class="card-title">Referral System</div>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-xl-12 col-md-12 col-sm-12">
												<div class="card  box-shadow-0">
													<div class="card-header">
														<h4 class="card-title">Activate Referral Features</h4>
													</div>
													<div class="card-body">
														<form action="{{ route('admin.setting.update') }}" class="form-horizontal" method="POST">
                            @csrf
                                <div class="form-row">

                                    <div class="form-group col">
                                        <p class="text-muted">Deposit Commission</p>
                                        <label class="custom-switch">
													<input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" class="custom-switch-input" name="deposit_commission" @if($general->deposit_commission) checked @endif>
													<span class="custom-switch-indicator"></span>

												</label>

                                    </div>
                                    <div class="form-group col">
                                        <p class="text-muted">Invest Commission</p>
                                         <label class="custom-switch">
													<input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" class="custom-switch-input" name="invest_commission" @if($general->invest_commission) checked @endif>
													<span class="custom-switch-indicator"></span>

												</label>

                                    </div>
                                    <div class="form-group col">
                                        <p class="text-muted">Interest return commission</p>
                                         <label class="custom-switch">
													<input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" class="custom-switch-input" name="invest_return_commission" @if($general->invest_return_commission) checked @endif>
													<span class="custom-switch-indicator"></span>

												</label>

                                    </div>

                                </div>
                            <div class="form-group row">
                                <div class="form-group col">
                                    <button type="submit"  style="background-color: {{$general->bclr}}"  class="btn btn-block btn-primary mr-2">Submit</button>
                                </div>
                            </div>


                        </form>
													</div>
												</div>
											</div>

											<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
												<div class="card  box-shadow-0 mb-0">
													<div class="card-header">
														<h4 class="card-title">Referral Level</h4>
													</div>
													<div class="card-body">
														<form class="form-horizontal" >
															<div class="form-group row">
																<label for="inputName1" class="col-md-3 col-form-label">Enter Referral Level</label>
																<div class="col-md-9">
																	<input  class="form-control" type="number" name="level" id="levelGenerate"  placeholder="Levels">
																</div>
															</div>

															<div class="form-group mb-0 mt-3 row justify-content-end">
																<div class="col-md-9">
																	<button type="button"  style="background-color: {{$general->bclr}}" id="generate" class="btn btn-primary">Generate</button>
																</div>
															</div>
														</form>

														 <form action="{{route('admin.store.refer')}}" id="prantoForm" style="display: none" method="post">
                           {{csrf_field()}}
                           <div class="form-group">
                               <label class="text-success"> Referral Earning : <small></small> </label>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="description" style="width: 100%;border: 1px solid #ddd;padding: 10px;border-radius: 5px" >
                                           <div class="row">
                                               <div class="col-md-12" id="planDescriptionContainer">

                                               </div>
                                           </div>


                                       </div>
                                   </div>
                               </div>
                           </div>
                           <hr>
                           <button type="submit"  style="background-color: {{$general->bclr}}"  class="btn btn-primary btn-block">Submit</button>
                       </form>


													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->


					</div>
				</div>
				<!-- App-content closed -->
			</div>

@endsection

@section('javascript')
    <script>
        var max = 1;
        $(document).ready(function () {
            $("#generate").on('click', function () {

                var da = $('#levelGenerate').val();
                var a = 0;
                var val = 1;
                var lev = 1;
                var guu = '';
                if (da !== '' && da >0)
                {
                    $('#prantoForm').css('display','block');

                    for (a; a < parseInt(da);a++){

                        console.log()

                        guu += '<div class="input-group" style="margin-top: 5px">\n' +
                            '<input name="level[]" hidden class="form-control margin-top-10" type="number" readonly value="'+val+++'" required placeholder="Level">\n' +
                            '<small>'+lev+++'</small><br><input name="percent[]" class="form-control margin-top-10" type="text" required placeholder="Referral Earning %">\n' +
                            '<span class="input-group-btn">\n' +
                            '<button class="btn btn-danger margin-top-10 delete_desc" type="button"><i class=\'fa fa-trash\'></i></button></span>\n' +
                            '</div>'
                    }
                    $('#planDescriptionContainer').html(guu);

                }else {
                    alert('Level Field Is Required')
                }

            });

            $(document).on('click', '.delete_desc', function () {
                $(this).closest('.input-group').remove();
            });
        });

    </script>
@endsection
