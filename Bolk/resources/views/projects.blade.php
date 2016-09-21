@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">Projects</h1>
						
						<!--panel content -->						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Project <span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>registration number</td>
								<td>name</td>
								<td>location</td>
								<td>number of windmills</td>
								<td>number of transports</td>
								<td>start date</td>
								<td>end date</td>
								<td>last update</td>
							</thead>
							
							<tbody>
								<tr class="success" onclick="document.location = 'project.html';">
									<td>1</td>
									<td>189207</td>
									<td>Project GE Auchrobert</td>
									<td>Auchrobert</td>
									<td>6</td>
									<td>60</td>
									<td>24-08-2016</td>
									<td>30-08-2016</td>
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