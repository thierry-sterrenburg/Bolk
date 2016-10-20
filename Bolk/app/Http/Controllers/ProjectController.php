<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;
use App\Switchable;
use App\Transport;
use Cookie;
use DB;

class ProjectController extends Controller
{
	public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->get();
	$project = Project::where('id','=',$id)->first();
	return view('/project', ['windmills' => $windmills, 'components' => $components,  'project' => $project]);
	}

	public static function countComponents($windmillid) {
		$numberofcomponents = Component::where('mainwindmillid','=', $windmillid)->count();
		return $numberofcomponents;
	}
	
	public function newWindmill(Request $request){
	   if($request->ajax()){
		   $windmill = new Windmill();
		   $this->checkInput($windmill, $request);
		   $windmill->save();
		   return response()->json($windmill);
	   }
   }
   public function getUpdateWindmill(Request $request){
	  if ($request->ajax()){
		  $windmill=Windmill::find($request->id);
		  return Response($windmill);
	  }
   }
   public function newUpdateWindmill(Request $request){
	   if ($request->ajax()){
		   $windmill=Windmill::find($request->id);
		   $this->checkInput($windmill, $request);
		   $windmill->save();
		   return Response($windmill);
	   }
   }
   public function deleteWindmill(Request $request){
	   if ($request->ajax()){
		   Windmill::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   public function newComponent(Request $request){
	   if($request->ajax()){
		   $component = new Component();
		   $this->checkInputComponent($component, $request);
		   $component->save();
		   $windmills = Windmill::where('projectid', '=', $request->projectid)->get();
			
		   foreach($windmills as $windmill){
			   $checkwindmill = $windmill->id;
			   if($request->input('windmill'.$checkwindmill)==true){
				  $switchable = new Switchable();
				  $switchable->componentid = $component->id;
				  $switchable->windmillid = $checkwindmill;
				  $switchable->save();
			 }
		   }
		   return response()->json($component);
	   }
   }
   public function getUpdateComponent(Request $request){
	  if ($request->ajax()){
		  $component=Component::find($request->id);
		  $switchablewindmills = Switchable::where('componentid', '=', $request->id)->pluck('windmillid');
		  return Response($component)->withCookie(Cookie::make('componentid', $request->id, 60));
	  }
   }
   public function newUpdateComponent(Request $request){
	   if ($request->ajax()){
		   $component=Component::find($request->componentid);
		   $this->checkInputComponent($component, $request);
		   $component->save();
		   $windmills = Windmill::where('projectid', '=', $request->projectid)->get();
			
		   foreach($windmills as $windmill){
			   $checkwindmill = $windmill->id;
			   $checkswitchable = Switchable::where('windmillid', '=', $checkwindmill)->where('componentid','=', $component->id);
			   if($checkswitchable->exists()){
				    if($request->input('windmill'.$checkwindmill)!=true){
						$checkswitchable->delete();
					}
			   }else{
				 if($request->input('windmill'.$checkwindmill)==true){
				  $switchable = new Switchable();
				  $switchable->componentid = $component->id;
				  $switchable->windmillid = $checkwindmill;
				  $switchable->save();
				} 
			 }
		   }

		   return Response($component);
	   }
   }
   public function deleteComponent(Request $request){
	   if ($request->ajax()){
		   Component::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   public function newTransport(Request $request){
	   if($request->ajax()){
		   $transport = new Transport();
		   $this->checkInputTransport($transport, $request);
		   $transport->save();
		   
		   if($request->componentid != null){
			   $componenttransport = new Component_Transport();
			   $componenttransport->componentid = $request->componentid;
			   $componenttransport->transportid = $transport->id;
			   $componenttransport->save();
		   }
		   return response()->json($transport);
	   }
   }
   
   public function getUpdateTransport(Request $request){
	  if ($request->ajax()){
		  $transport=Transport::find($request->id);
		  return Response($transport)->withCookie(Cookie::make('transportid', $request->id, 60));
	  }
   }
   
   public function newUpdateTransport(Request $request){
	   if ($request->ajax()){
		   $transport=Transport::find($request->id);
		   $this->checkInputTransport($transport, $request);
		   $transport->save();
		   return Response($transport);
	   }
   }
   public function deleteTransport(Request $request){
	   if ($request->ajax()){
		   Transport::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   public function checkInput($windmill, $request){
			$windmill->projectid=$request->projectid;
		   if($request->regnumber == ''){
			   $windmill->regnumber=null;
		   }else{
			   $windmill->regnumber=$request->regnumber;
		   }
		   if($request->name == ''){
			   $windmill->name=null;
		   }else{
			   $windmill->name=$request->name;
		   }
		   if($request->location == ''){
			   $windmill->location=null;
		   }else{
			   $windmill->location=$request->location;
		   }
		   if($request->startdate == ''){
			   $windmill->startdate=null;
		   }else{
			   $windmill->startdate=$request->startdate;
		   }
		   if($request->enddate == ''){
			   $windmill->enddate=null;
		   }else{
			   $windmill->enddate=$request->enddate;
		   }
		   if($request->remarks == ''){
			   $windmill->remarks=null;
		   }else{
			   $windmill->remarks=$request->remarks;
		   }
	   return $windmill;
   }
   
   public function checkInputComponent($component, $request){
		$component->projectid=$request->projectid;
		$component->status=$request->componentstatus;
		   if($request->componentregnumber == ''){
			   $component->regnumber=null;
		   }else{
			   $component->regnumber=$request->componentregnumber;
		   }
		   if($request->componentname == ''){
			   $component->name=null;
		   }else{
			   $component->name=$request->componentname;
		   }
		    if($request->componentlength == ''){
			   $component->length=null;
		   }else{
			   $component->length=$request->componentlength;
		   }
		    if($request->componentwidth == ''){
			   $component->width=null;
		   }else{
			   $component->width=$request->componentwidth;
		   }
		    if($request->componentheight == ''){
			   $component->height=null;
		   }else{
			   $component->height=$request->componentheight;
		   }
		    if($request->componentweight == ''){
			   $component->weight=null;
		   }else{
			   $component->weight=$request->componentweight;
		   }
		   if($request->componentremarks == ''){
			   $component->remarks=null;
		   }else{
			   $component->remarks=$request->componentremarks;
		   }if($request->componentinwindmill == 'none'){
			   $component->mainwindmillid = null;
		   }else{
			   $component->mainwindmillid=$request->componentinwindmill;
		   }
		   
	   return $component;
   }
   
   public function checkInputTransport($transport, $request){
			$transport->projectid=$request->projectid;
		   if($request->transportnumber == ''){
			   $transport->transportnumber=null;
		   }else{
			   $transport->transportnumber=$request->transportnumber;
		   }
		   if($request->transportcompany == ''){
			   $transport->company=null;
		   }else{
			   $transport->company=$request->transportcompany;
		   }
		   if($request->transporttruck == ''){
			   $transport->truck=null;
		   }else{
			   $transport->truck=$request->transporttruck;
		   }
		   if($request->transporttrailer == ''){
			   $transport->trailer=null;
		   }else{
			   $transport->trailer=$request->transporttrailer;
		   }
		   if($request->transportconfiguration == ''){
			   $transport->configuration=null;
		   }else{
			   $transport->configuration=$request->transportconfiguration;
		   }
		   if($request->transportfrom == ''){
			   $transport->from=null;
		   }else{
			   $transport->from=$request->transportfrom;
		   }
		   if($request->transportto == ''){
			   $transport->to=null;
		   }else{
			   $transport->to=$request->transportto;
		   }
		   if($request->loadingdate == ''){
			   $transport->loadingdate=null;
		   }else{
			   $transport->loadingdate=$request->loadingdate;
		   }
		   if($request->datedesired == ''){
			   $transport->datedesired=null;
		   }else{
			   $transport->datedesired=$request->datedesired;
		   }
		   if($request->dateplanned == ''){
			   $transport->dateplanned=null;
		   }else{
			   $transport->dateplanned=$request->dateplanned;
		   }
		   if($request->dateestimated == ''){
			   $transport->dateestimated=null;
		   }else{
			   $transport->dateestimated=$request->dateestimated;
		   }
		   if($request->dateactual == ''){
			   $transport->dateactual=null;
		   }else{
			   $transport->dateactual=$request->dateactual;
		   }
		   if($request->unloadingdate == ''){
			   $transport->unloadingdate=null;
		   }else{
			   $transport->unloadingdate=$request->unloadingdate;
		   }		   
		   if($request->transportremarks == ''){
			   $transport->remarks=null;
		   }else{
			   $transport->remarks=$request->transportremarks;
		   }
	   return $transport;
   }
   
   public static function checkSwitchable($componentid, $windmillid){
	   if(!is_null(Switchable::where('componentid', '=', $componentid)->where('windmillid', '=', $windmillid)->first())){
		   return true;
	   }
	   return false;
   }


}