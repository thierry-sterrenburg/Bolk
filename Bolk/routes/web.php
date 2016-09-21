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

Route::get('/projects', function () {
    return view('projects');
});

Route::get('/project', function () {
    return view('project');
});

Route::get('/windmill', 'WindmillController@index');

Route::get('/component', function () {
    return view('component');
});

Route::get('/transportphase', function () {
    return view('transportphase');
});

Route::get('/closestdeadlines', function () {
    return view('closestdeadlines');
});

Route::get('/modal', 'ProjectController@index');