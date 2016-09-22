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
Route::post('newProject', 'ProjectsController@newProject');

Route::get('/project', 'ProjectController@index');

Route::get('/windmill', 'WindmillController@index');

Route::get('/component', 'ComponentController@index');

//Route::get('/transportphase', 'TransportphaseController@index');

Route::get('/transportphase/id={id}', 'TransportphaseController@index');

Route::get('/closestdeadlines', function () {
    return view('closestdeadlines');
});

Route::get('/modal', 'ProjectsController@index'); 