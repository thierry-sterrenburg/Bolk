<ul class="nav nav-tabs">
	<li id="componentstab"><a onclick="document.location= '/deadlines_components';">Components</a></li>
	<li id="transportstab"><a onclick="document.location= '/deadlines_transports';">Transports</a></li>
</ul>

<script type=text/javascript>
	var url = document.location.toString();
	if (url.match('/deadlines_components')) {
    	$('#componentstab').addClass('active');
   	} else if (url.match('/deadlines_transports')) {
   		$('#transportstab').addClass('active');
   	}
</script>