<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

//Route::get('/clients', function () {
//    return view('clients');
//});

Route::resource('users', 'UserController');

Route::get('/projects', 'ProjectsController@index');
Route::get('/archivedprojects', 'ProjectsController@FindArchivedProjects');
Route::post('/newProject', 'ProjectsController@newProject');
Route::get('/getUpdate', 'ProjectsController@getUpdate');
Route::put('/newProject', 'ProjectsController@newUpdate');
Route::delete('/deleteProject', 'ProjectsController@deleteProject');
Route::put('/archiveProject', 'ProjectsController@archiveProject');
Route::put('/dearchiveProject', 'ProjectsController@dearchiveProject');

Route::get('/project/id={id}','ProjectController@index');
Route::get('/project_transports/id={id}','Project_transportsController@index');
Route::get('/project_components/id={id}','Project_componentsController@index');
Route::post('/newWindmill', 'ProjectController@newWindmill');
Route::get('/getUpdateWindmill', 'ProjectController@getUpdateWindmill');
Route::put('/newWindmill', 'ProjectController@newUpdateWindmill');
Route::delete('/deleteWindmill', 'ProjectController@deleteWindmill');

Route::post('/newComponent', 'ProjectController@newComponent');
Route::get('/getUpdateComponent', 'ProjectController@getUpdateComponent');
Route::put('/newComponent', 'ProjectController@newUpdateComponent');
Route::delete('/deleteComponent','ProjectController@deleteComponent');

Route::get('/windmill/id={id}', 'WindmillController@index');
Route::put('/addComponentToWindmill', 'WindmillController@addComponent');

Route::get('/component/id={id}', 'ComponentController@index');
Route::post('/addTransportToComponent', 'ComponentController@addTransport');
Route::delete('/deleteTransportFromComponent', 'ComponentController@deleteTransportFromComponent');
Route::post('/newTransport','ProjectController@newTransport');
Route::get('/getUpdateTransport', 'ProjectController@getUpdateTransport');
Route::put('/newTransport', 'ProjectController@newUpdateTransport');
Route::delete('/deleteTransport', 'ProjectController@deleteTransport');

Route::get('/transportphase/id={id}','TransportphaseController@index');
Route::get('/transport_components/id={id}','Transport_componentsController@index');
Route::post('/addComponenttoTransport','Transport_componentsController@addComponent');
Route::delete('/deleteComponentfromTransport','Transport_componentsController@deleteComponent');
Route::post('/newRequirement','TransportphaseController@newRequirement');
Route::post('/newChecklist','TransportphaseController@newChecklist');

Route::get('/getUpdateRequirement', 'TransportphaseController@getUpdateRequirement');
Route::put('/newRequirement', 'TransportphaseController@newUpdateRequirement');
Route::delete('/deleteRequirement', 'TransportphaseController@deleteRequirement');


Route::get('/deadlines_components', 'Deadlines_componentsController@index');
Route::get('/deadlines_transports', 'Deadlines_transportsController@index');

Route::get('/modal', 'ProjectsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
