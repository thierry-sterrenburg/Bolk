@extends('layouts.master')
@section('content')
		<!--General information panel-->				
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="projects.html">Projects</a></li>
							<li><a href="project.html">Project GE Auchrobert</a></li>
							<li><a href="windmill.html">Windmill T11</a></li>
							<li class="active">PPM</li>
						</ol>
                        <h1 class="page-header">PPM</h1>
						
						<!--panel content -->
						
						
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
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="projectinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Project Registration Number:</u></td>
												<td colspan="1"><u>Name:</u></td>
												<td colspan="1"><u>Location:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date:</u></td>
												<td colspan="2"><u>End Date:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Toatal number of Windmills:</u></td>
												<td colspan="1"><u>Total number of Components:</u></td>
												<td colspan="1"><u>Total number of Transport Phases:</u></td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>


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
												<td colspan="1"><u>Windmill Registration Number:</u></td>
												<td colspan="1"><u>Name: </u></td>
												<td colspan="1"><u>Location:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date:</u></td>
												<td colspan="2"><u>End Date:</u></td>
											</tr>
												<td colspan="3"><u>Number of Components:</u></td>
											<tr>
												<td colspan="3"><u>Remarks:</u></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>




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
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="componentinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="2"><u>Component Registration Number:</u></td>
												<td colspan="2"><u>Name:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Length:</u></td>
												<td colspan="1"><u>Heigth:</u></td>
												<td colspan="1"><u>Width:</u></td>
												<td colspan="1"><u>Weight:</u></td>
											</tr>
											<tr>
												<td colspan="2"><u>Switchable:</u></td>
												<td colspan="2"><u>Status:</u></td>
											</tr>
											<tr>
												<td colspan="4"><u>Number of Transport Phases:</u></td>

											</tr>
											<tr>
												<td colspan="4"><u>Remarks:</u></td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
						</div>	

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
												<td colspan="1"><u>Transport Number:</u></td>
												<td colspan="2"><u>Company</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Truck:</u></td>
												<td colspan="1"><u>Trailer:</u></td>
												<td colspan="1"><u>Configuration:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Start location:</u></td>
												<td colspan="2"><u>End location:</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Date of loading:</u></td>
												<td colspan="1"><u>Date initial arrival:</u></td>
												<td colspan="1"><u>Date final arrival:</u></td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>



						<br>












						
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Transport Phase<span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						
							
							<tbody>
								
								<p> Tabel hier </p>
							</tbody>
							
                    </div>
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->