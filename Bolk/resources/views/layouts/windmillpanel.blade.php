<?php 
	use App\Http\Controllers\ProjectController;
?>
						<!--panel windmillinfo-->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#windmillinfotable">
												<h3 class="panel-title">Windmill Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="windmillinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Windmill Registration Number:</u> {{$windmill->regnumber}}</td>
												<td colspan="1"><u>Name: </u> {{$windmill->name}}</td>
												<td colspan="1"><u>Location:</u> {{$windmill->location}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date: {{$windmill->startdate}}</u></td>
												<td colspan="2"><u>End Date:</u> {{$windmill->enddate}}</td>
											</tr>
												<td colspan="3"><u>Number of Components: {{ProjectController::countComponents($windmill->id)}}</u></td>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$windmill->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end panel windmillinfo-->