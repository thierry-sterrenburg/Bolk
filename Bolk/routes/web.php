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

Route::get('/projects', ['middleware' => ['permission:read-project'], 'uses' => 'ProjectsController@index']);
Route::post('/newProject', ['middleware' => ['permission:create-project'], 'uses' => 'ProjectsController@newProject']);
Route::get('/getUpdate', ['middleware' => ['permission:read-project'], 'uses'=>'ProjectsController@getUpdate']);
Route::put('/newProject', ['middleware' => ['permission:create-project'], 'uses' => 'ProjectsController@newUpdate']);
Route::delete('/deleteProject', ['middleware' => ['permission:delete-project'], 'uses' => 'ProjectsController@deleteProject']);

Route::get('/project/id={id}', ['middleware' => ['permission:read-project'], 'uses' => 'ProjectController@index']);
Route::get('/project_transport/id={id}','Project_transportController@index');
Route::post('/newWindmill', ['middleware' => ['permission:create-windmill'], 'uses' => 'ProjectController@newWindmill']);
Route::get('/getUpdateWindmill', ['middleware' => ['permission:read-windmill'], 'uses' => 'ProjectController@getUpdateWindmill']);
Route::put('/newWindmill', ['middleware' => ['permission:edit-windmill'], 'uses' => 'ProjectController@newUpdateWindmill']);
Route::delete('/deleteWindmill', ['middleware' => ['permission:delete-windmill'], 'uses' => 'ProjectController@deleteWindmill']);

Route::post('/newComponent', ['middleware' => ['permission:create-component'], 'uses' => 'ProjectController@newComponent']);
Route::get('/getUpdateComponent', ['middleware' => ['permission:read-component'], 'uses' => 'ProjectController@getUpdateComponent']);
Route::put('/newComponent', ['middleware' => ['permission:edit-component'], 'uses' => 'ProjectController@newUpdateComponent']);
Route::delete('/deleteComponent', ['middleware' => ['permission:delete-component'], 'uses' => 'ProjectController@deleteComponent']);
View::composer('/newComponent', ['middleware' => ['permission:create-component'], 'uses' => 'App\Http\ViewComposers\newComponentComposer']);

Route::get('/windmill/id={id}', ['middleware' => ['permission:read-windmill'], 'uses' => 'WindmillController@index']);

Route::get('/component/id={id}', ['middleware' => ['permission:read-component'], 'uses' => 'ComponentController@index']);
Route::post('/newTransport', ['middleware' => ['permission:create-transport'], 'uses' => 'ComponentController@newTransport']);
Route::get('/getUpdateTransport', ['middleware' => ['permission:read-transport'], 'uses' => 'ComponentController@getUpdateTransport']);
Route::put('/newTransport', ['middleware' => ['permission:edit-transport'], 'uses' => 'ComponentController@newUpdateTransport']);
Route::delete('/deleteTransport', ['middleware' => ['permission:delete-transport'], 'uses' => 'ComponentController@deleteTransport']);

Route::get('/transportphase/id={id}', ['middleware' => ['permission:read-transport'], 'uses' => 'TransportphaseController@index']);

Route::get('/closestdeadlines', function () {
    return view('closestdeadlines');
});

Route::get('/modal', 'ProjectsController@index');



Auth::routes();

Route::get('/home', 'HomeController@index');
