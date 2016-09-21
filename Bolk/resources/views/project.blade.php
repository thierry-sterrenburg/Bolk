@extends('layouts.master')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="projects.html">Projects</a></li>
							<li class="active">Project GE Auchrobert</li>
						</ol>
                        <h1 class="page-header">Project GE Auchrobert</h1>
						
						<!--panel content -->
						
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE A registration number:189207 latest update: 13-9-2016 13:52:07 number of windmills: 6
							</div>
						</div>
						
						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Windmill <span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>registration number</td>
								<td>name</td>
								<td>location</td>
								<td>number of components</td>
								<td>start date</td>
								<td>end date</td>
								<td>last update</td>
							</thead>
							
							<tbody>
								<tr class="success" onclick="document.location = 'windmill.html';">
									<td>1</td>
									<td>32150105</td>
									<td>T11</td>
									<td>Auchrobert</td>
									<td>9</td>
									<td>24-08-2016</td>
									<td>30-08-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
									<tr>
									<td>2</td>
									<td>32150106</td>
									<td>T12</td>
									<td>Auchrobert</td>
									<td>10</td>
									<td>27-08-2016</td>
									<td>08-09-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
								<tr class="warning">
									<td>2</td>
									<td>32150106</td>
									<td>T12</td>
									<td>Auchrobert</td>
									<td>10</td>
									<td>27-08-2016</td>
									<td>08-09-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
								<tr>
									<td>2</td>
									<td>32150106</td>
									<td>T12</td>
									<td>Auchrobert</td>
									<td>10</td>
									<td>27-08-2016</td>
									<td>08-09-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
									<tr>
									<td>2</td>
									<td>32150106</td>
									<td>T12</td>
									<td>Auchrobert</td>
									<td>10</td>
									<td>27-08-2016</td>
									<td>08-09-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
								<tr class="danger">
									<td>2</td>
									<td>32150106</td>
									<td>T12</td>
									<td>Auchrobert</td>
									<td>10</td>
									<td>27-08-2016</td>
									<td>08-09-2016</td>
									<td>13-09-2016 14:17:52</td>
								</tr>
							</tbody>
							
						</table>
						
                    </div>
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection