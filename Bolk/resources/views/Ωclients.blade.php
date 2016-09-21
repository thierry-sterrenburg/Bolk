@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">Clients</h1>
						
						<!--panel content -->						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Client<span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>name</td>
								<td>address</td>
								<td>number of projects</td>
								<td>number of ongoing projects</td>
								<td>number of finished projects</td>
							</thead>
							
							<tbody>
								<tr class="" onclick="document.location = '#';">
									<td>1</td>
									<td>General Electric</td>
									<td>Rosastraße 10, 48480 Spelle, Duitsland</td>
									<td>20</td>
									<td>3</td>
									<td>17</td>
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