<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Response;


//header('Access-Control-Allow-Origin: http://localhost:3000, http://localhost:8000');

//header('Access-Control-Allow-Credentials: true');


Route::get('dl', function(){
	$file = public_path() . '/upload/standardDocument/STANDARDKOMPETENSIKELULUSAN_20151103163702.pdf';
	//header('Content-Type: application/pdf');
	return response()->download($file);
	
});

Route::get('/', ['as' => 'main', function () {
	return view('main');
}]);

Route::get('authenticate', 'AuthenticateController@index');
Route::post('authenticate', 'AuthenticateController@authenticate');

Route::get('/user', 'UserController@check');
Route::post('/user/login', 'UserController@login');
Route::get('/user/fakeLogin/{username}/{password}/{token}', 'UserController@fakeLogin');
Route::get('/user/logout', 'UserController@logout');

Route::get('auth/token', function() {
	$encrypter = app('Illuminate\Encryption\Encrypter');
	$encrypted_token = $encrypter->encrypt(csrf_token());
	return response()->json($encrypted_token);
});

Route::get('user/token/{token}', 'UserController@checkToken');

Route::group(['middleware'=> ['jwt.auth']], function(){
	
//Route::group(['middleware'=> ['jwt.auth']], function(){
	
	Route::get('user/validating/nik/{nik}/{id?}', 'UserController@validatingNik');
	Route::get('user/validating/email/{email}/{id?}', 'UserController@validatingEmail');
	Route::get('user/jobs/{id}', 'UserController@jobs');
	Route::post('user/register', 'UserController@register');
	
	
	Route::resource('user', 'UserController',
		['except' => ['create', 'edit']]);
		
	Route::resource('user.job', 'UserJobController',
		['only' => ['store', 'update', 'destroy']]);
	
	Route::get('form/instruction/{id}', 'FormController@instruction');
	Route::get('form/validating/no/{no}/{id?}', 'FormController@validatingNo');
	Route::get('form/validating/description/{description}/{id?}', 'FormController@validatingDescription');
	Route::resource('form', 'FormController',
		['except' => ['create', 'edit']]);
	
	Route::get('university/validating/{name}/{id?}', 'UniversityController@validating');
	Route::resource('university', 'UniversityController',
		['except' => ['create', 'edit']]);
	
	Route::get('department/university/{id}', 'DepartmentController@university');
	Route::get('department/validating/{name}/{id?}/{universityId}', 'DepartmentController@validating');
	Route::resource('department', 'DepartmentController',
		['except' => ['create', 'edit']]);
	
	Route::get('job/university/{id}', 'JobController@university');
	Route::get('job/department/{id}', 'JobController@department');
	Route::get('job/validating/{name}/{departmentId}/{id?}', 'JobController@validating');
	Route::get('job/users/{id}', 'JobController@users');
	Route::get('job/subs/{id}', 'JobController@subs');
	Route::resource('job', 'JobController',
		['except' => ['create', 'edit']]);
	
	Route::get('standard/all', 'StandardController@all');
	Route::get('standard/validating/{description}/{id?}', 'StandardController@validating');
	Route::resource('standard', 'StandardController', 
		['except' => ['create', 'edit']]);
	
	Route::get('standardDocument/standard/{id}', 'StandardDocumentController@standard');
	Route::get('standardDocument/validating/no/{no}/{id?}', 'StandardDocumentController@validatingNo');
	Route::get('standardDocument/validating/description/{description}/{id?}', 'StandardDocumentController@validatingDescription');
	Route::resource('standardDocument', 'StandardDocumentController',
		['except'=> ['create', 'edit']]);
	
	Route::get('guide/standardDocument/{id}', 'GuideController@standardDocument');
	Route::get('guide/validating/no/{no}/{id?}', 'GuideController@validatingNo');
	Route::get('guide/validating/description/{no}/{id?}', 'GuideController@validatingDescription');
	Route::resource('guide', 'GuideController', 
		['except'=> ['create', 'edit']]);
	
	Route::get('instruction/guide/{id}', 'InstructionController@guide');
	Route::get('instruction/validating/no/{no}/{id?}', 'InstructionController@validatingNo');
	Route::get('instruction/validating/description/{description}/{id?}', 'InstructionController@validatingDescription');
	Route::resource('instruction', 'InstructionController',
		['except' => ['create', 'edit']]);
	
	Route::get('groupJob/validating/name/{name}/{id?}', 'GroupJobController@validatingName');
	Route::get('groupJob/users', 'GroupJobController@users');
	Route::get('groupJob/jobs/{id}', 'GroupJobController@jobs');
	Route::resource('groupJob', 'GroupJobController',
		['except' => ['create', 'edit']]);

	Route::resource('groupJob.job', 'GroupJobDetailController', 
		['only' => ['store', 'show', 'update', 'destroy']]);
	
	
	Route::get('semester/intersect/{date}/{id?}', 'SemesterController@intersect');
	Route::get('semester/included/{dateStart}/{dateEnded}/{id?}', 'SemesterController@included');
	Route::resource('semester', 'SemesterController',
		['except' => ['create', 'edit']]);
	
	Route::get('work/execute/all', 'WorkController@executeAllWork');
	Route::get('work/execute/{id}', 'WorkController@execute');
	Route::get('work/event/start', 'WorkController@startAllEvent');
	Route::get('work/event/pause', 'WorkController@pauseAllEvent');
	Route::get('work/event/{id}', 'WorkController@eventToggle');
	Route::get('work/validating/name/{name}/{id?}', 'WorkController@validatingName');
	Route::get('work/tasks/{id}', 'WorkController@tasks');
	Route::get('work/users/{id}', 'WorkController@users');
	Route::resource('work', 'WorkController',
		['except' => ['create', 'edit']]);
	Route::resource('work.form', 'WorkFormController', 
		['only' => ['store', 'update', 'destroy']]);
	
	Route::get('task/user/{id}', 'TaskController@index');
	Route::get('task/retrive/{userId}/{jobId}', 'TaskController@retrive');
	Route::get('task/{userId}/{batchId}', 'TaskController@show');
	Route::get('task/users/{id}', 'TaskController@users');
	Route::post('task/update', 'TaskController@update');
	
	Route::get('projects', 'ProjectController@index');
	
	Route::get('projectsLast/{id}', 'ProjectController@showLast');
	
	Route::get('project/user/{id}', 'ProjectController@user');
	Route::post('project/delegate', 'ProjectController@delegate');
	Route::get('project/form/{id}', 'ProjectController@form');
	Route::get('project/leader/{id}', 'ProjectController@leader');
	Route::post('project/upload', 'ProjectController@upload');
	Route::get('project/validating/name/{name}/{id?}', 'ProjectController@validatingName');
	Route::resource('project', 'ProjectController',
		['except' => ['create', 'edit']]);
	
	
});
