<?php
	use App\Http\Controllers\WindmillController;
?>
@permission(('read-component'))
						<!--panel componentinfo-->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#componentinfotable">
												<h3 class="panel-title">Component Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update: {{$component->updated_at}}</small>
											</div>
										</div>
									</div>
								</div>
								<div id="componentinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="2"><u>Component Registration Number:</u> {{$component->regnumber}}</td>
												<td colspan="2"><u>Name:</u> {{$component->name}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Length: {{$component->length}}</u></td>
												<td colspan="1"><u>Height: {{$component->height}}</u></td>
												<td colspan="1"><u>Width: {{$component->width}}</u></td>
												<td colspan="1"><u>Weight:</u> {{$component->weight}}</td>
											</tr>
											<tr>
												<td colspan="2"><u>Current location:</u> {{ WindmillController::getCurrentLocation($component->id)}}}</td>
												<td colspan="2"><u>Status:</u> {{$component->status}}</td>
											</tr>
											<tr>
												<td colspan="4"><u>Number of Transport Phases:</u>{{WindmillController::countTransports($component->id)}}</td>

											</tr>
											<tr>
												<td colspan="4"><u>Remarks:</u></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--End Panel componentinfo-->
						@endpermission
