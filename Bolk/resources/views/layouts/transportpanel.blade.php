<?php
	use App\Http\Controllers\ComponentController;
?>
@permission(('read-transport'))
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
												<small>Latest Update: {{$transport->updated_at}}</small>
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
												<td colspan="1"><u>Desired arrival:</u>{{$transport->datedesired}}</td>
												<td colspan="1"><u>Estimated arrival:</u>{{$transport->dateestimated}}</td>
												<td colspan="1"><u>Planned arrival:</u>{{$transport->dateplanned}}</td>
												<td colspan="1"><u>Actual arrival:</u>{{$transport->dateactual}}</td>
												<td colspan="1"><u>Date of unloading:</u>{{$transport->unloadingdate}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Number of Requirements:{{ComponentController::countRequirements($transport->id)}}</u></td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$transport->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@endpermission
