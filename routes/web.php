<?php
Route::get('test',function(){
	return view('test');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/patients','PatientController');

Route::get('register/confirm/{token}','Auth\RegisterController@confirmEmail');

Route::resource('clinics','ClinicController');

Route::get('check',[
	'as'=>'check',
	'uses'=>'ClinicController@check'
	]);

Route::get('newuser',[
	'as'=>'newuser',
	'uses'=>'ClinicController@newUser'
	]);

Route::get('clinicinput',[
	'as'=>'clinicinput',
	'uses'=>'ClinicController@clinicInput'
	]);

Route::post('cliniccheck',[
	'as'=>'cliniccheck',
	'uses'=>'ClinicController@cliniccheck'
	]);

Route::post('clin',[
	'as'=>'clin',
	'uses'=>'ClinicController@clin'
	]);

Route::get('showclinic/{id}',[
	'as'=>'showclinic',
	'uses'=>'ClinicController@showClinic'
	]);

Route::get('profile',[
	'as'=>'profile',
	'uses'=>'UserController@profile'
	]);

Route::post('profile','UserController@updateAvatar');

Route::resource('tokens','TokenController');

Route::resource('passkeys','PasskeyController');

Route::resource('clinictokens','ClinictokenController');

Route::resource('dashboard','DashboardController');

Route::resource('visits','VisitController',['except'=>['create','store','edit']]);

Route::post('visits/edit/{id}',[
	'as'=>'visits.edit',
	'uses'=>'VisitController@edit'
	]);

Route::get('visits/create/{id}',[
	'as'=>'visits.create',
	'uses'=>'VisitController@visitcreate'
	]);


Route::post('visits/store',[
	'as'=>'visits.store',
	'uses'=>'VisitController@visitstore'
	]);

Route::post('visits/storeloc',[
	'as'=>'visits.storelocal',
	'uses'=>'VisitController@visitsstorelocal'
	]);

Route::resource('reports','ReportController',['except'=>['create','show']]);

Route::get('reports/create/{id}',[
	'as'=>'reports.create',
	'uses'=>'ReportController@create'
	]);

Route::post('reports/show',[
	'as'=>'reports.show',
	'uses'=>'ReportController@show'
	]);

Route::post('image/do-upload',[
	'as'=>'images.upload',
	'uses'=>'ReportController@doImageUpload'
	]);

Route::post('patients/showVisits',[
	'as'=>'patients.visits',
	'uses'=>'PatientController@showVisits'
	]);

// Route::post('patients/createconsult',[
// 	'as'=>'patients.createconsult',
// 	'uses'=>'PatientController@createconsult'
// 	]);
Route::get('patients/createconsult/{id}',[
	'as'=>'patients.createconsult',
	'uses'=>'PatientController@createconsult'
	]);

Route::get('videocall/initiate',[
	'as'=>'videocall.initiate',
	'uses'=>'VideoController@initiateVideoCall'
	]);

Route::get('printvisit/{id}',[
	'as'=>'print.visits',
	'uses'=>'PrintController@printVisit'
	]);

Route::resource('print','PrintController');

Route::resource('medicines','MedicineController',['except'=>'index']);

Route::get('medicines.index/{id}',[
	'as'=>'medicines.index',
	'uses'=>'MedicineController@index'
	]);

Route::resource('pathologies','PathologyController');

Route::resource('templates','TemplateController');

Route::get('showcc',[
	'as'=>'templates.showcc',
	'uses'=>'TemplateController@showcc'
	]);

Route::get('showef',[
	'as'=>'templates.showef',
	'uses'=>'TemplateController@showef'
	]);

Route::post('storecc',[
	'as'=>'templates.storecc',
	'uses'=>'TemplateController@storecc'
	]);

Route::post('storeef',[
	'as'=>'templates.storeef',
	'uses'=>'TemplateController@storeef'
	]);

Route::resource('tests','TestController');




