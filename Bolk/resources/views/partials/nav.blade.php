<?php
use app\Providers\AppServiceProvider;
use app\Http\Controllers\NavController;
?>

<!-- custom Treeview code 
<script type="text/javascript" src="{{ asset('js/Treeview/Treeview.js') }}"></script>
-->
<script src={{ asset('bower_components/bootstrap-treeview-master/src/js/bootstrap-treeview.js') }}></script>
<script type="text/javascript">
	function getTree() {
  	// Some logic to retrieve, or generate tree structure 
  
  	var tree = [ 
  	{
  		text: "Home",
  		icon: "fa fa-home fa-fw",
  		href: "/index"
  	},
  	{
  		text: "Overview",
  		icon: "fa fa-truck",
  		href: "/projects",
  		nodes:
  		[
  	
  		  		
		<?php
		$sizeP = count($projectsoverview);
		$indexP = 1; 
		foreach($projectsoverview as $project){
            if(Auth::user()->projectid == $project->id){
			echo '{ 
				text: '.json_encode($project->name).', 
				icon: "fa fa-institution",
				href: "../project/id='.$project->id.'"';
			$indexW = 1;
			$sizeW = count($windmilloverview);
			$firstW = True;
			foreach($windmilloverview as $windmill){
				if($project->id == $windmill->projectid){
					if ($firstW){
					echo ', nodes: 
						[
						';
						$firstW = False;
					}else{
						echo ',
						';
					}
				echo '{
					text: '.json_encode($windmill->name).',
					icon: "fa fa-tencent-weibo",
					href: "../windmill/id='.$windmill->id.'"';
					$indexC = 1;
					$sizeC = count($componentoverview);
					$firstC = True;
					foreach($componentoverview as $component){
						if(!is_null($component->mainwindmillid)&&($windmill->id == $component->mainwindmillid)){
							if ($firstC){
	 					echo ', nodes: 
							[
							';
								$firstC = False;
							}else{
						echo ',
							';
							}
							echo '{text: '.json_encode($component->name).',
							icon: "fa fa-archive",
							href: "../component/id='.$component->id.'"}';
						}
						if((!$firstC)&&($indexC == $sizeC)){
							echo '
							]
						';
						}
						$indexC ++;
					}
				if((!$firstW)){
					echo '
					}
					';
				}
				}
				$indexW ++;
			}

			$indexC = 1;
			$sizeC = count($componentoverview);
			$firstC = True;
			foreach($componentoverview as $component){
				if(is_null($component->mainwindmillid)&&$component->projectid == $project->id){
					if($firstC){
						if ($firstW) {
				echo ', nodes: 
				[
				';
						}else{
				echo ',
				';
						}
					$firstC = False;
					}else{
				echo ',
				';
					}
				echo'{
				text: '.json_encode($component->name).',
				icon: "fa fa-archive",
				href: "../component/id='.$component->id.'"
				}
				';
				}
				if(((!$firstC)||(!$firstW))&&($indexC == $sizeC)){
				echo ']
					';
				}
				$indexC++;
				}
			
		
		if($indexP == $sizeP){
			echo '
			}';
		}else{
			echo '
			},';
			$indexP ++;
		}
	}
		elseif(Auth::user()->projectid == ''){
            echo '{
				text: '.json_encode($project->name).',
				icon: "fa fa-institution",
				href: "../project/id='.$project->id.'"';
            $indexW = 1;
            $sizeW = count($windmilloverview);
            $firstW = True;
            foreach($windmilloverview as $windmill){
                if($project->id == $windmill->projectid){
                    if ($firstW){
                        echo ', nodes:
						[
						';
                        $firstW = False;
                    }else{
                        echo ',
						';
                    }
                    echo '{
					text: '.json_encode($windmill->name).',
					icon: "fa fa-tencent-weibo",
					href: "../windmill/id='.$windmill->id.'"';
                    $indexC = 1;
                    $sizeC = count($componentoverview);
                    $firstC = True;
                    foreach($componentoverview as $component){
                        if(!is_null($component->mainwindmillid)&&($windmill->id == $component->mainwindmillid)){
                            if ($firstC){
                                echo ', nodes:
							[
							';
                                $firstC = False;
                            }else{
                                echo ',
							';
                            }
                            echo '{text: '.json_encode($component->name).',
							icon: "fa fa-archive",
							href: "../component/id='.$component->id.'"}';
                        }
                        if((!$firstC)&&($indexC == $sizeC)){
                            echo '
							]
						';
                        }
                        $indexC ++;
                    }
                    if((!$firstW)){
                        echo '
					}
					';
                    }
                }
                $indexW ++;
            }

            $indexC = 1;
            $sizeC = count($componentoverview);
            $firstC = True;
            foreach($componentoverview as $component){
                if(is_null($component->mainwindmillid)&&$component->projectid == $project->id){
                    if($firstC){
                        if ($firstW) {
                            echo ', nodes:
				[
				';
                        }else{
                            echo ',
				';
                        }
                        $firstC = False;
                    }else{
                        echo ',
				';
                    }
                    echo'{
				text: '.json_encode($component->name).',
				icon: "fa fa-archive",
				href: "../component/id='.$component->id.'"
				}
				';
                }
                if(((!$firstC)||(!$firstW))&&($indexC == $sizeC)){
                    echo ']
					';
                }
                $indexC++;
            }


            if($indexP == $sizeP){
                echo '
			}';
            }else{
                echo '
			},';
                $indexP ++;
            }
        }}
	?>
	]
	},
	{
		text: "Deadlines",
		icon: "fa fa-clock-o fa-fw",
		href: "/closestdeadlines"
	}
	<?php
	if(Entrust::hasRole('admin')){
		echo '
	,
	{
		text: "Administration",
		icon: "fa fa-gears fa-fw",
		href: "/Administration"
	}';
	}
	?>
	]
	return tree;
	}
 
$('#tree').treeview({
	data: getTree(),
	enableLinks: true
});
</script>