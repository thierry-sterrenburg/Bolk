<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bolk</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Projects</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Project</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Project</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="panel-body">
	<table class="table table-hover">
		<caption>Projects</caption>
			<thead>
				<td>#</td>
				<td>registration number</td>
				<td>name</td>
				<td>location</td>
				<td>number of windmills</td>
				<td>number of transports</td>
				<td>start date</td>
				<td>end date</td>
				<td>remarks</td>
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
					<td>blabla</td>
				</tr>
				
				@foreach($projects as $project)
				<tr>
					<td>{{ $project->id }}</td>
					<td>{{ $project->regnumber }}</td>
					<td>{{ $project->name }}</td>
					<td>{{ $project->location }}</td>
					<td>{{ $project->startdate }}</td>
					<td>{{ $project->enddate }}</td>
					<td>{{ $project->remarks }}</td>
				</tr>
				@endforeach
			</tbody>
	</table>
  </div>
</div>

</body>
</html>

