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

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::post('user/store', 'UserController@store');
Route::post('user/update', 'UserController@update');
Route::post('user/destroy', 'UserController@destroy');
Route::post('user/validating/nik', 'UserController@validatingNik');
Route::post('user/validating/email', 'UserController@validatingEmail');
Route::get('user/jobs/{id}', 'UserController@jobs');

Route::get('userjobs/get/{id}', 'UserJobController@index');
Route::get('userjobs/{id}', 'UserJobController@show');
Route::post('userjob/store', 'UserJobController@store');
Route::post('userjob/update', 'UserJobController@update');
Route::post('userjob/destroy', 'UserJobController@destroy');
Route::post('userjob/validating/job', 'UserJobController@validatingJob');


Route::get('standards', 'StandardController@index');
Route::get('standards/{id}', 'StandardController@show');
Route::post('standard/store', 'StandardController@store');
Route::post('standard/update', 'StandardController@update');
Route::post('standard/destroy', 'StandardController@destroy');
Route::post('standard/validating', 'StandardController@validating');

Route::get('standarddocuments', 'StandardDocumentController@index');
Route::get('standarddocuments/{id}', 'StandardDocumentController@show');
Route::post('standarddocument/store', 'StandardDocumentController@store');
Route::post('standarddocument/update', 'StandardDocumentController@update');
Route::post('standarddocument/destroy', 'StandardDocumentController@destroy');
Route::get('standarddocument/standard/{id}', 'StandardDocumentController@standard');
Route::post('standarddocument/validating/no', 'StandardDocumentController@validatingNo');
Route::post('standarddocument/validating/description', 'StandardDocumentController@validatingDescription');

Route::get('guides', 'GuideController@index');
Route::get('guides/{id}', 'GuideController@show');
Route::post('guide/store', 'GuideController@store');
Route::post('guide/update', 'GuideController@update');
Route::post('guide/destroy', 'GuideController@destroy');
Route::get('guide/standarddocument/{id}', 'GuideController@standarddocument');
Route::post('guide/validating/no', 'GuideController@validatingNo');
Route::post('guide/validating/description', 'GuideController@validatingDescription');
Route::post('guide/validating/no', 'GuideController@validatingNo');
Route::post('guide/validating/description', 'GuideController@validatingDescription');

Route::get('instructions', 'InstructionController@index');
Route::get('instructions/{id}', 'InstructionController@show');
Route::post('instruction/store', 'InstructionController@store');
Route::post('instruction/update', 'InstructionController@update');
Route::post('instruction/destroy', 'InstructionController@destroy');
Route::get('instruction/guide/{id}', 'InstructionController@guide');
Route::post('instruction/validating/no', 'InstructionController@validatingNo');
Route::post('instruction/validating/description', 'InstructionController@validatingDescription');

Route::get('forms', 'FormController@index');
Route::get('forms/{id}', 'FormController@show');
Route::post('form/store', 'FormController@store');
Route::post('form/update', 'FormController@update');
Route::post('form/destroy', 'FormController@destroy');
Route::get('form/instruction/{id}', 'FormController@instruction');
Route::post('form/validating/no', 'FormController@validatingNo');
Route::post('form/validating/description', 'FormController@validatingDescription');

Route::get('universities', 'UniversityController@index');
Route::get('universities/{id}', 'UniversityController@show');
Route::post('university/store', 'UniversityController@store');
Route::post('university/update', 'UniversityController@update');
Route::post('university/destroy', 'UniversityController@destroy');
Route::post('university/validating', 'UniversityController@validating');

Route::get('departments', 'DepartmentController@index');
Route::get('departments/{id}', 'DepartmentController@show');
Route::post('department/store', 'DepartmentController@store');
Route::post('department/update', 'DepartmentController@update');
Route::post('department/destroy', 'DepartmentController@destroy');
Route::get('department/university/{id}', 'DepartmentController@university');
Route::post('department/validating', 'DepartmentController@validating');

Route::get('jobs', 'JobController@index');
Route::get('jobs/{id}', 'JobController@show');
Route::post('job/store', 'JobController@store');
Route::post('job/update', 'JobController@update');
Route::post('job/destroy', 'JobController@destroy');
Route::get('job/university/{id}', 'JobController@university');
Route::get('job/department/{id}', 'JobController@department');
Route::post('job/validating', 'JobController@validating');
Route::get('job/users/{id}', 'JobController@users');
Route::get('job/subs/{id}', 'JobController@subs');

Route::get('groupjobs', 'GroupJobController@index');
Route::get('groupjobs/{id}', 'GroupJobController@show');
Route::post('groupjob/store', 'GroupJobController@store');
Route::post('groupjob/update', 'GroupJobController@update');
Route::post('groupjob/destroy', 'GroupJobController@destroy');
Route::post('groupjob/validating/name', 'GroupJobController@validatingName');
Route::get('groupjob/users', 'GroupJobController@users');
Route::get('groupJob/jobs/{id}', 'GroupJobController@jobs');

Route::get('groupjobdetails/get/{id}', 'GroupJobDetailController@index');
Route::get('groupjobdetails/{id}', 'GroupJobDetailController@show');
Route::post('groupjobdetail/store', 'GroupJobDetailController@store');
Route::post('groupjobdetail/update', 'GroupJobDetailController@update');
Route::post('groupjobdetail/destroy', 'GroupJobDetailController@destroy');
Route::get('groupjobdetail/university/{group_job_id}/{university_id}', 'GroupJobDetailController@university');

Route::get('semesters', 'SemesterController@index');
Route::get('semesters/{id}', 'SemesterController@show');
Route::post('semester/store', 'SemesterController@store');
Route::post('semester/update', 'SemesterController@update');
Route::post('semester/destroy', 'SemesterController@destroy');
Route::post('semester/intersect', 'SemesterController@intersect');
Route::post('semester/included', 'SemesterController@included');


Route::get('works', 'WorkController@index');
Route::get('works/{id}', 'WorkController@show');
Route::post('work/store', 'WorkController@store');
Route::post('work/update', 'WorkController@update');
Route::post('work/destroy', 'WorkController@destroy');
Route::get('work/execute/{id}', 'WorkController@execute');
Route::post('work/eventToggle', 'WorkController@eventToggle');
Route::post('work/validating/name', 'WorkController@validatingName');
Route::get('work/startAllEvent', 'WorkController@startAllEvent');
Route::get('work/pauseAllEvent', 'WorkController@pauseAllEvent');
Route::get('work/executeAllWork', 'WorkController@executeAllWork');
Route::get('work/tasks/{id}', 'WorkController@tasks');
Route::get('work/users/{id}', 'WorkController@users');

Route::get('workForms/get/{id}', 'WorkFormController@index');
Route::get('workForms/{id}', 'WorkFormController@show');
Route::post('workForm/store', 'WorkFormController@store');
Route::post('workForm/update', 'WorkFormController@update');
Route::post('workForm/destroy', 'WorkFormController@destroy');

Route::get('tasks/user/{id}', 'TaskController@index');
Route::get('tasks/retrive/{userId}/{jobId}', 'TaskController@retrive');
Route::get('tasks/{userId}/{batchId}', 'TaskController@show');
Route::get('task/users/{id}', 'TaskController@users');
Route::post('task/update', 'TaskController@update');