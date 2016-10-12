<?php
use app\Providers\AppServiceProvider;
use app\Http\Controllers\NavController;
?>
<div class="row">
	<div class="col-sm-12">
    	<label for="treeview"></label>
    	<div id="tree"/>
    	{{--
   	@foreach($projectsoverview as $project => $name)
    	<div>{{$project}}</div>
    	@endforeach
    	--}}
  	
  		</div>
	</div>
</div>
<!-- custom Treeview code 
<script type="text/javascript" src="{{ asset('js/Treeview/Treeview.js') }}"></script>
-->
<script src={{ asset('bower_components/bootstrap-treeview-master/src/js/bootstrap-treeview.js') }}></script>
<script type="text/javascript">
	function getTree() {
  	// Some logic to retrieve, or generate tree structure 
  
  	var tree = [ 
  		  		
		<?php
		$sizeP = count($projectsoverview);
		$indexP = 1; 
		foreach($projectsoverview as $project){
			echo '{ text: "Project: '.substr(json_encode($project->name), 1).' 
			';
			$indexW = 1;
			$sizeW = count($windmilloverview);
			$firstW = True;
			foreach($windmilloverview as $windmill){
				if($project->id == $windmill->projectid){
					if ($firstW){
						echo ', nodes: [
						';
						$firstW = False;
					}else{
						echo ',
						';
					}
					echo '{text: "Mill: '.substr(json_encode($windmill->name), 1);
					$indexC = 1;
					$sizeC = count($componentoverview);
					$firstC = True;
					foreach($componentoverview as $component){
						if(!is_nan($component->mainwindmillid)&&($windmill->id == $component->mainwindmillid)){
							if ($firstC){
								echo ', nodes: [
								';
								$firstC = False;
							}else{
								echo ',
								';
							}
							echo '{text: "Component: '.substr(json_encode($component->name), 1).'}';
						}
						if((!$firstC)&&($indexC == $sizeC)){
							echo '
							]}';
						}
						$indexC ++;
					}

				}
				if((!$firstW)&&($indexW == $sizeW)){
					echo '}]';
				}
				$indexW ++;
			}
			if($indexP == $sizeP){
				echo '}]';
			}else{
				echo '
				},';
				$indexP ++;
			}
		}
			?>;
  	return tree;
	}
 
$('#tree').treeview({data: getTree()});
</script>