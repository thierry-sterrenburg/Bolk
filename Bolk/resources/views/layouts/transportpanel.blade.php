<?php 
	use App\Http\Controllers\ComponentController;
?>
<!--Panel transportinfo-->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#transportinfotable">
												<h3 class="panel-title">Transport Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="transportinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Transport Number:</u> {{$transport->transportnumber}}</td>
												<td colspan="2"><u>Company</u> {{$transport->company}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Truck:</u> {{$transport->truck}}</td>
												<td colspan="1"><u>Trailer:</u> {{$transport->trailer}}</td>
												<td colspan="1"><u>Configuration: {{$transport->configuration}}</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Start location: {{$transport->from}}</u></td>
												<td colspan="2"><u>End location:</u> {{$transport->to}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Date of loading:</u> {{$transport->dateofloading}}</td>
												<td colspan="1"><u>Date initial arrival:</u>{{$transport->dateofarrivalinitial}}</td>
												<td colspan="1"><u>Date final arrival:</u>{{$transport->dateofarrivalfinal}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Number of Requirements:</u>{{ComponentController::countRequirements($transport->id)}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$transport->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>