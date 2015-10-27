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



Route::get('/', ['as' => 'main', function () {
	return view('main');
}]);

Route::get('/user', 'UserController@check');
Route::post('/user/login', 'UserController@login');
Route::get('/user/logout', 'UserController@logout');

Route::get('user/token/{token}', 'UserController@checkToken');

Route::get('users', ['middleware' => 'auth', 'uses' => 'UserController@index']);
Route::get('users/{id}', ['middleware' => 'auth', 'uses' => 'UserController@show']);
Route::post('user/store', ['middleware' => 'auth', 'uses' => 'UserController@store']);
Route::post('user/update', ['middleware' => 'auth', 'uses' => 'UserController@update']);
Route::post('user/destroy', ['middleware' => 'auth', 'uses' => 'UserController@destroy']);
Route::get('user/validating/nik/{nik}/{id?}', ['middleware' => 'auth', 'uses' => 'UserController@validatingNik']);
Route::get('user/validating/email/{email}/{id?}', ['middleware' => 'auth', 'uses' => 'UserController@validatingEmail']);
Route::get('user/jobs/{id}', ['middleware' => 'auth', 'uses' => 'UserController@jobs']);
Route::post('user/register', ['middleware' => 'auth', 'uses' => 'UserController@register']);

Route::get('userjobs/get/{id}', ['middleware' => 'auth', 'uses' => 'UserJobController@index']);
Route::get('userjobs/{id}', ['middleware' => 'auth', 'uses' => 'UserJobController@show']);
Route::post('userjob/store', ['middleware' => 'auth', 'uses' => 'UserJobController@store']);
Route::post('userjob/update', ['middleware' => 'auth', 'uses' => 'UserJobController@update']);
Route::post('userjob/destroy', ['middleware' => 'auth', 'uses' => 'UserJobController@destroy']);
Route::post('userjob/validating/job/{jobId}/{userId}/{id?}', ['middleware' => 'auth', 'uses' => 'UserJobController@validatingJob']);


Route::get('standards', ['middleware' => 'auth', 'uses' => 'StandardController@index']);
Route::get('standardsAll', ['middleware' => 'auth', 'uses' => 'StandardController@getAll']);
Route::get('standards/{id}', ['middleware' => 'auth', 'uses' => 'StandardController@show']);
Route::post('standard/store', ['middleware' => 'auth', 'uses' => 'StandardController@store']);
Route::post('standard/update', ['middleware' => 'auth', 'uses' => 'StandardController@update']);
Route::post('standard/destroy', ['middleware' => 'auth', 'uses' => 'StandardController@destroy']);
Route::get('standard/validating/{description}/{id?}', ['middleware' => 'auth', 'uses' => 'StandardController@validating']);

Route::get('standarddocuments', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@index']);
Route::get('standarddocuments/{id}', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@show']);
Route::post('standarddocument/store', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@store']);
Route::post('standarddocument/update', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@update']);
Route::post('standarddocument/destroy', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@destroy']);
Route::get('standarddocument/standard/{id}', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@standard']);
Route::get('standarddocument/validating/no/{no}/{id?}', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@validatingNo']);
Route::get('standarddocument/validating/description/{description}/{id?}', ['middleware' => 'auth', 'uses' => 'StandardDocumentController@validatingDescription']);

Route::get('guides', ['middleware' => 'auth', 'uses' => 'GuideController@index']);
Route::get('guides/{id}', ['middleware' => 'auth', 'uses' => 'GuideController@show']);
Route::post('guide/store', ['middleware' => 'auth', 'uses' => 'GuideController@store']);
Route::post('guide/update', ['middleware' => 'auth', 'uses' => 'GuideController@update']);
Route::post('guide/destroy', ['middleware' => 'auth', 'uses' => 'GuideController@destroy']);
Route::get('guide/standarddocument/{id}', ['middleware' => 'auth', 'uses' => 'GuideController@standarddocument']);
Route::get('guide/validating/no/{no}/{id?}', ['middleware' => 'auth', 'uses' => 'GuideController@validatingNo']);
Route::get('guide/validating/description/{no}/{id?}', ['middleware' => 'auth', 'uses' => 'GuideController@validatingDescription']);

Route::get('instructions', ['middleware' => 'auth', 'uses' => 'InstructionController@index']);
Route::get('instructions/{id}', ['middleware' => 'auth', 'uses' => 'InstructionController@show']);
Route::post('instruction/store', ['middleware' => 'auth', 'uses' => 'InstructionController@store']);
Route::post('instruction/update', ['middleware' => 'auth', 'uses' => 'InstructionController@update']);
Route::post('instruction/destroy', ['middleware' => 'auth', 'uses' => 'InstructionController@destroy']);
Route::get('instruction/guide/{id}', ['middleware' => 'auth', 'uses' => 'InstructionController@guide']);
Route::get('instruction/validating/no/{no}/{id?}', ['middleware' => 'auth', 'uses' => 'InstructionController@validatingNo']);
Route::get('instruction/validating/description/{description}/{id?}', ['middleware' => 'auth', 'uses' => 'InstructionController@validatingDescription']);

Route::get('forms', ['middleware' => 'auth', 'uses' => 'FormController@index']);
Route::get('forms/{id}', ['middleware' => 'auth', 'uses' => 'FormController@show']);
Route::post('form/store', ['middleware' => 'auth', 'uses' => 'FormController@store']);
Route::post('form/update', ['middleware' => 'auth', 'uses' => 'FormController@update']);
Route::post('form/destroy', ['middleware' => 'auth', 'uses' => 'FormController@destroy']);
Route::get('form/instruction/{id}', ['middleware' => 'auth', 'uses' => 'FormController@instruction']);
Route::get('form/validating/no/{no}/{id?}', ['middleware' => 'auth', 'uses' => 'FormController@validatingNo']);
Route::get('form/validating/description/{description}/{id?}', ['middleware' => 'auth', 'uses' => 'FormController@validatingDescription']);

Route::get('universities', ['middleware' => 'auth', 'uses' => 'UniversityController@index']);
Route::get('universities/{id}', ['middleware' => 'auth', 'uses' => 'UniversityController@show']);
Route::post('university/store', ['middleware' => 'auth', 'uses' => 'UniversityController@store']);
Route::post('university/update', ['middleware' => 'auth', 'uses' => 'UniversityController@update']);
Route::post('university/destroy', ['middleware' => 'auth', 'uses' => 'UniversityController@destroy']);
Route::get('university/validating/{name}/{id?}', ['middleware' => 'auth', 'uses' => 'UniversityController@validating']);

Route::get('departments', ['middleware' => 'auth', 'uses' => 'DepartmentController@index']);
Route::get('departments/{id}', ['middleware' => 'auth', 'uses' => 'DepartmentController@show']);
Route::post('department/store', ['middleware' => 'auth', 'uses' => 'DepartmentController@store']);
Route::post('department/update', ['middleware' => 'auth', 'uses' => 'DepartmentController@update']);
Route::post('department/destroy', ['middleware' => 'auth', 'uses' => 'DepartmentController@destroy']);
Route::get('department/university/{id}', ['middleware' => 'auth', 'uses' => 'DepartmentController@university']);
Route::get('department/validating/{name}/{id?}/{universityId}', ['middleware' => 'auth', 'uses' => 'DepartmentController@validating']);

Route::get('jobs', ['middleware' => 'auth', 'uses' => 'JobController@index']);
Route::get('jobs/{id}', ['middleware' => 'auth', 'uses' => 'JobController@show']);
Route::post('job/store', ['middleware' => 'auth', 'uses' => 'JobController@store']);
Route::post('job/update', ['middleware' => 'auth', 'uses' => 'JobController@update']);
Route::post('job/destroy', ['middleware' => 'auth', 'uses' => 'JobController@destroy']);
Route::get('job/university/{id}', ['middleware' => 'auth', 'uses' => 'JobController@university']);
Route::get('job/department/{id}', ['middleware' => 'auth', 'uses' => 'JobController@department']);
Route::get('job/validating/{name}/{departmentId}/{id?}', ['middleware' => 'auth', 'uses' => 'JobController@validating']);
Route::get('job/users/{id}', ['middleware' => 'auth', 'uses' => 'JobController@users']);
Route::get('job/subs/{id}', ['middleware' => 'auth', 'uses' => 'JobController@subs']);

Route::get('groupjobs', ['middleware' => 'auth', 'uses' => 'GroupJobController@index']);
Route::get('groupjobs/{id}', ['middleware' => 'auth', 'uses' => 'GroupJobController@show']);
Route::post('groupjob/store', ['middleware' => 'auth', 'uses' => 'GroupJobController@store']);
Route::post('groupjob/update', ['middleware' => 'auth', 'uses' => 'GroupJobController@update']);
Route::post('groupjob/destroy', ['middleware' => 'auth', 'uses' => 'GroupJobController@destroy']);
Route::get('groupjob/validating/name/{name}/{id?}', ['middleware' => 'auth', 'uses' => 'GroupJobController@validatingName']);
Route::get('groupjob/users', ['middleware' => 'auth', 'uses' => 'GroupJobController@users']);
Route::get('groupJob/jobs/{id}', ['middleware' => 'auth', 'uses' => 'GroupJobController@jobs']);

Route::get('groupjobdetails/get/{id}', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@index']);
Route::get('groupjobdetails/{id}', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@show']);
Route::post('groupjobdetail/store', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@store']);
Route::post('groupjobdetail/update', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@update']);
Route::post('groupjobdetail/destroy', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@destroy']);
Route::get('groupjobdetail/university/{group_job_id}/{university_id}', ['middleware' => 'auth', 'uses' => 'GroupJobDetailController@university']);

Route::get('semesters', ['middleware' => 'auth', 'uses' => 'SemesterController@index']);
Route::get('semesters/{id}', ['middleware' => 'auth', 'uses' => 'SemesterController@show']);
Route::post('semester/store', ['middleware' => 'auth', 'uses' => 'SemesterController@store']);
Route::post('semester/update', ['middleware' => 'auth', 'uses' => 'SemesterController@update']);
Route::post('semester/destroy', ['middleware' => 'auth', 'uses' => 'SemesterController@destroy']);
Route::get('semester/intersect/{date}/{id?}', ['middleware' => 'auth', 'uses' => 'SemesterController@intersect']);
Route::get('semester/included/{dateStart}/{dateEnded}/{id?}', ['middleware' => 'auth', 'uses' => 'SemesterController@included']);


Route::get('works', ['middleware' => 'auth', 'uses' => 'WorkController@index']);
Route::get('works/{id}', ['middleware' => 'auth', 'uses' => 'WorkController@show']);
Route::post('work/store', ['middleware' => 'auth', 'uses' => 'WorkController@store']);
Route::post('work/update', ['middleware' => 'auth', 'uses' => 'WorkController@update']);
Route::post('work/destroy', ['middleware' => 'auth', 'uses' => 'WorkController@destroy']);
Route::get('work/execute/{id}', ['middleware' => 'auth', 'uses' => 'WorkController@execute']);
Route::post('work/eventToggle', ['middleware' => 'auth', 'uses' => 'WorkController@eventToggle']);
Route::get('work/validating/name/{name}/{id?}', ['middleware' => 'auth', 'uses' => 'WorkController@validatingName']);
Route::get('work/startAllEvent', ['middleware' => 'auth', 'uses' => 'WorkController@startAllEvent']);
Route::get('work/pauseAllEvent', ['middleware' => 'auth', 'uses' => 'WorkController@pauseAllEvent']);
Route::get('work/executeAllWork', ['middleware' => 'auth', 'uses' => 'WorkController@executeAllWork']);
Route::get('work/tasks/{id}', ['middleware' => 'auth', 'uses' => 'WorkController@tasks']);
Route::get('work/users/{id}', ['middleware' => 'auth', 'uses' => 'WorkController@users']);

Route::get('workForms/get/{id}', ['middleware' => 'auth', 'uses' => 'WorkFormController@index']);
Route::get('workForms/{id}', ['middleware' => 'auth', 'uses' => 'WorkFormController@show']);
Route::post('workForm/store', ['middleware' => 'auth', 'uses' => 'WorkFormController@store']);
Route::post('workForm/update', ['middleware' => 'auth', 'uses' => 'WorkFormController@update']);
Route::post('workForm/destroy', ['middleware' => 'auth', 'uses' => 'WorkFormController@destroy']);

Route::get('tasks/user/{id}', ['middleware' => 'auth', 'uses' => 'TaskController@index']);
Route::get('tasks/retrive/{userId}/{jobId}', ['middleware' => 'auth', 'uses' => 'TaskController@retrive']);
Route::get('tasks/{userId}/{batchId}', ['middleware' => 'auth', 'uses' => 'TaskController@show']);
Route::get('task/users/{id}', ['middleware' => 'auth', 'uses' => 'TaskController@users']);
Route::post('task/update', ['middleware' => 'auth', 'uses' => 'TaskController@update']);

Route::get('projects', ['middleware' => 'auth', 'uses' => 'ProjectController@index']);
Route::get('projectsLast/{id}', ['middleware' => 'auth', 'uses' => 'ProjectController@showLast']);
Route::get('projects/{id}', ['middleware' => 'auth', 'uses' => 'ProjectController@show']);
Route::post('project/store', ['middleware' => 'auth', 'uses' => 'ProjectController@store']);
Route::post('project/update', ['middleware' => 'auth', 'uses' => 'ProjectController@update']);
Route::post('project/destroy', ['middleware' => 'auth', 'uses' => 'ProjectController@destroy']);

Route::get('project/user/{id}', ['middleware' => 'auth', 'uses' => 'ProjectController@user']);
Route::post('project/delegate', ['middleware' => 'auth', 'uses' => 'ProjectController@delegate']);
Route::get('project/form/{id}', ['middleware' => 'auth', 'uses' => 'ProjectController@form']);
Route::get('project/leader/{id}', ['middleware' => 'auth', 'uses' => 'ProjectController@leader']);
Route::post('project/upload', ['middleware' => 'auth', 'uses' => 'ProjectController@upload']);
Route::get('project/validating/name/{name}/{id?}', ['middleware' => 'auth', 'uses' => 'ProjectController@validatingName']);

