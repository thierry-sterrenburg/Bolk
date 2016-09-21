@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Closest Deadlines</h1>
						
						<!--panel content -->

						<table class="table table-condensed table-hover">
							<thead>
								<td>Reg. number</td>
								<td>Component</td>
                                <td>Project Name</td>
								<td>From</td>
								<td>To</td>
								<td>Number of transport phases</td>
								<td>Date of loading</td>
								<td>Offloading(initial)</td>
								<td>Last update</td>
								<td>Remarks</td>
							</thead>
							
							<tbody>
								<tr class="success" onclick="document.location = 'transport.html';">
									<td>32150105</td>
									<td>PPM</td>
                                    <td>Project Name</td>
									<td>Almelo</td>
									<td>Auchrobert</td>
									<td>3</td>
									<td>16-08-2016</td>
									<td>23-08-2016</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
								</tr>
									<td>32150105</td>
									<td>T-Base</td>
                                    <td>Project Name</td>
									<td>Grangemouth</td>
									<td>Auchrobert</td>
									<td>3</td>
									<td>23-08-2016</td>
									<td>25-08-2016</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
								</tr>
								<tr class="warning">
									<td>32150105</td>
									<td>T-Mid</td>
                                    <td>Project Name</td>
									<td>Grangemouth</td>
									<td>Auchrobert</td>
									<td>3</td>
									<td>23-08-2016</td>
									<td>25-08-2016</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
								</tr>
								<tr>
									<td>32150105</td>
									<td>T-Top</td>
                                    <td>Project Name</td>
									<td>Grangemouth</td>
									<td>Auchrobert</td>
									<td>3</td>
									<td>22-08-2016</td>
									<td>23-08-2016</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
								</tr>
								<tr>
									<td>32150105</td>
									<td>Nacelle</td>
                                    <td>Project Name</td>
									<td>Spelle</td>
									<td>Auchrobert</td>
									<td>3</td>
									<td>22-08-2016</td>
									<td>23-08-2016</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
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