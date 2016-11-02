<?php
	use App\Http\Controllers\ProjectsController;
?>
@permission(('read-project'))
						<!--panel projectinfo -->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#projectinfotable">
												<h3 class="panel-title">Project Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update: {{$project->updated_at}}</small>
											</div>
										</div>
									</div>
								</div>
								<div id="projectinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Project Registration Number:</u> {{$project->regnumber}}</td>
												<td colspan="1"><u>Name:</u> {{$project->name}}</td>
												<td colspan="1"><u>Location:</u> {{$project->location}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date:</u> {{$project->startdate}}</td>
												<td colspan="2"><u>End Date:</u> {{$project->enddate}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Total number of Windmills:</u> {{ProjectsController::countWindmills($project->id)}}</td>
												<td colspan="1"><u>Total number of Components:</u> {{ProjectsController::countComponents($project->id)}}</td>
												<td colspan="1"><u>Total number of Transport Phases:</u> {{ProjectsController::countTransports($project->id)}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$project->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end panel projectinfo-->
						@endpermission
