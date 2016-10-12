<ul class="nav nav-tabs">
	<li id="projecttab"><a onclick="document.location= '/project/id={{$project->id}}';">Windmills</a></li>
	<li id="componenttab"><a onclick="document.location= '/project_components/id={{$project->id}}';">Components</a></li>
	<li id="transporttab"><a onclick="document.location= '/project_transports/id={{$project->id}}';">Transports</a></li>
	<li><a href="#">Menu 3</a></li>
</ul>

<script type=text/javascript>
	var url = document.location.toString();
	if (url.match('/project/id=')) {
    	$('#projecttab').addClass('active');
   	} else if (url.match('/project_components/id=')) {
   		$('#componenttab').addClass('active');
   	} else if (url.match('/project_transports/id=')) {
   		$('#transporttab').addClass('active');
   	}
</script>