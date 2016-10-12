<ul class="nav nav-tabs">
	<li id="componenttab"><a onclick="document.location= '/transport_components/id={{$transport->id}}';">Components</a></li>
	<li id="requirementtab"><a onclick="document.location= '/transportphase/id={{$transport->id}}';">Transports</a></li>
</ul>

<script type=text/javascript>
	var url = document.location.toString();
	if (url.match('/transportphase/id=')) {
    	$('#requirementtab').addClass('active');
   	} else if (url.match('/transport_components/id=')) {
   		$('#componenttab').addClass('active');
	}
</script>