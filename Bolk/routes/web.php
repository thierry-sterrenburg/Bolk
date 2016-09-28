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

Route::get('/projects', 'ProjectsController@index');
Route::post('/newProject', 'ProjectsController@newProject');
Route::get('/getUpdate', 'ProjectsController@getUpdate');
Route::put('/newProject', 'ProjectsController@newUpdate');
Route::delete('/deleteProject', 'ProjectsController@deleteProject');

Route::get('/project/id={id}', 'ProjectController@index');
Route::post('/newWindmill/', 'ProjectController@newWindmill');
Route::get('/getUpdateWindmill', 'ProjectController@getUpdateWindmill');
Route::put('/newWindmill', 'ProjectController@newUpdateWindmill');
Route::delete('/deleteWindmill', 'ProjectController@deleteWindmill');

Route::get('/windmill/id={id}', 'WindmillController@index');

Route::get('/component/id={id}', 'ComponentController@index');

//Route::get('/transportphase', 'TransportphaseController@index');

Route::get('/transportphase/id={id}', 'TransportphaseController@index');

Route::get('/closestdeadlines', function () {
    return view('closestdeadlines');
});
Route::get('/General', function () {
    return view('GeneralPanel');
});
Route::get('/modal', 'ProjectsController@index'); 
Auth::routes();

Route::get('/home', 'HomeController@index');
