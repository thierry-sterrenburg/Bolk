<?php
function DFD($date){
   	if ($date == ""){
   		return null;
   	}else{
   		return (date("Y-m-d" , strtotime($date)));
   	}
}
function DFT($date){
   	if ($date == null){
   		return "";
   	}else{
   		return (date("d-m-Y" , strtotime($date)));
   	}
}
?>