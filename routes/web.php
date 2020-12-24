<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//index welcome
Route::get('/', function () {
    return view('welcome');
});

//home
Route::get('/home', 'HomeController@index')->name('home');

//login
Route::get('login', function () {
    return view('login');
});

//register
Route::get('register', function () {
    return view('register');
});
Route::post('register','RegisterController@registerUser');

//logout
//Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//authenticate
Auth::routes();

//users
Route::get('users', 'UserController@index');
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user}/edit', 'UserController@edit');
Route::patch('users/{user}', 'UserController@update');
Route::delete('users/{user}', 'UserController@destroy');

//persons
Route::get('persons', 'PersonController@index');
Route::get('persons/create','PersonController@create');
Route::post('persons','PersonController@store');
Route::get('persons/{person}', 'PersonController@show');
Route::get('persons/{person}/edit', 'PersonController@edit');
Route::delete('persons/{person}', 'PersonController@destroy');
Route::patch('persons/{person}', 'PersonController@update');

//servers
Route::get('servers', 'ServerController@index');
Route::get('servers/create','ServerController@create');
Route::post('servers','ServerController@store');
Route::get('servers/{server}', 'ServerController@show');
Route::get('servers/{server}/edit', 'ServerController@edit');
Route::delete('servers/{server}', 'ServerController@destroy');
Route::patch('servers/{server}', 'ServerController@update');

//server type
Route::get('servertype', 'ServertypeController@index');
Route::get('servertype/create','ServertypeController@create');
Route::post('servertype','ServertypeController@store');
Route::get('servertype/{servertype}', 'ServertypeController@show');
Route::get('servertype/{servertype}/edit', 'ServertypeController@edit');
Route::delete('servertype/{servertype}', 'ServertypeController@destroy');
Route::patch('servertype/{servertype}', 'ServertypeController@update');

//server otap
Route::get('serverotap', 'ServerotapController@index');
Route::get('serverotap/create','ServerotapController@create');
Route::post('serverotap','ServerotapController@store');
Route::get('serverotap/{serverotap}', 'ServerotapController@show');
Route::get('serverotap/{serverotap}/edit', 'ServerotapController@edit');
Route::delete('serverotap/{serverotap}', 'ServerotapController@destroy');
Route::patch('serverotap/{serverotap}', 'ServerotapController@update');

//server status
Route::get('serverstatus', 'ServerStatusController@index');
Route::get('serverstatus/create','ServerStatusController@create');
Route::post('serverstatus','ServerStatusController@store');
Route::get('serverstatus/{serverstatus}', 'ServerStatusController@show');
Route::get('serverstatus/{serverstatus}/edit', 'ServerStatusController@edit');
Route::delete('serverstatus/{serverstatus}', 'ServerStatusController@destroy');
Route::patch('serverstatus/{serverstatus}', 'ServerStatusController@update');

//server service
Route::get('serverservice', 'ServerServiceController@index');
Route::get('serverservice/create','ServerServiceController@create');
Route::post('serverservice','ServerServiceController@store');
Route::get('serverservice/{serverservice}', 'ServerServiceController@show');
Route::get('serverservice/{serverservice}/edit', 'ServerServiceController@edit');
Route::delete('serverservice/{serverservice}', 'ServerServiceController@destroy');
Route::patch('serverservice/{serverservice}', 'ServerServiceController@update');

//server operating system
Route::get('serveros', 'ServerOSController@index');
Route::get('serveros/create','ServerOSController@create');
Route::post('serveros','ServerOSController@store');
Route::get('serveros/{serveros}', 'ServerOSController@show');
Route::get('serveros/{serveros}/edit', 'ServerOSController@edit');
Route::delete('serveros/{serveros}', 'ServerOSController@destroy');
Route::patch('serveros/{serveros}', 'ServerOSController@update');

//servers en apps koppel
Route::get('serverapps', 'ServerAppController@index');
Route::get('serverapps/create','ServerAppController@create');
Route::post('serverapps','ServerAppController@store');
Route::get('serverapps/{serverapps}', 'ServerAppController@show');
Route::get('serverapps/{serverapps}/edit', 'ServerAppController@edit');
Route::delete('serverapps/{serverapps}', 'ServerAppController@destroy');
Route::patch('serverapps/{serverapps}', 'ServerAppController@update');

//apps
Route::get('apps', 'AppsController@index');
Route::get('apps/create','AppsController@create');
Route::post('apps','AppsController@store');
Route::get('apps/{apps}', 'AppsController@show');
Route::get('apps/{apps}/edit', 'AppsController@edit');
Route::delete('apps/{apps}', 'AppsController@destroy');
Route::patch('apps/{apps}', 'AppsController@update');

//app status
Route::get('appstatus', 'AppstatusController@index');
Route::get('appstatus/create','AppstatusController@create');
Route::post('appstatus','AppstatusController@store');
Route::get('appstatus/{appstatus}', 'AppstatusController@show');
Route::get('appstatus/{appstatus}/edit', 'AppstatusController@edit');
Route::delete('appstatus/{appstatus}', 'AppstatusController@destroy');
Route::patch('appstatus/{appstatus}', 'AppstatusController@update');

//app to app dependencies
Route::get('appdependencies', 'AppdependencyController@index');
Route::get('appdependencies/create','AppdependencyController@create');
Route::post('appdependencies','AppdependencyController@store');
Route::get('appdependencies/{appdependencies}', 'AppdependencyController@show');
Route::get('appdependencies/{appdependencies}/edit', 'AppdependencyController@edit');
Route::delete('appdependencies/{appdependencies}', 'AppdependencyController@destroy');
Route::patch('appdependencies/{appdependencies}', 'AppdependencyController@update');

//app owner
Route::get('appowner', 'AppOwnerController@index');
Route::get('appowner/create','AppOwnerController@create');
Route::post('appowner','AppOwnerController@store');
Route::get('appowner/{appowner}', 'AppOwnerController@show');
Route::get('appowner/{appowner}/edit', 'AppOwnerController@edit');
Route::delete('appowner/{appowner}', 'AppOwnerController@destroy');
Route::patch('appowner/{appowner}', 'AppOwnerController@update');

//app tech admin
Route::get('apptechadmin', 'AppTechAdminController@index');
Route::get('apptechadmin/create','AppTechAdminController@create');
Route::post('apptechadmin','AppTechAdminController@store');
Route::get('apptechadmin/{apptechadmin}', 'AppTechAdminController@show');
Route::get('apptechadmin/{apptechadmin}/edit', 'AppTechAdminController@edit');
Route::delete('apptechadmin/{apptechadmin}', 'AppTechAdminController@destroy');
Route::patch('apptechadmin/{apptechadmin}', 'AppTechAdminController@update');

//app functional admin
Route::get('appfunctionaladmin', 'AppFunctionalAdminController@index');
Route::get('appfunctionaladmin/create','AppFunctionalAdminController@create');
Route::post('appfunctionaladmin','AppFunctionalAdminController@store');
Route::get('appfunctionaladmin/{appfunctionaladmin}', 'AppFunctionalAdminController@show');
Route::get('appfunctionaladmin/{appfunctionaladmin}/edit', 'AppFunctionalAdminController@edit');
Route::delete('appfunctionaladmin/{appfunctionaladmin}', 'AppFunctionalAdminController@destroy');
Route::patch('appfunctionaladmin/{appfunctionaladmin}', 'AppFunctionalAdminController@update');

//app supplier
Route::get('suppliers', 'SupplierController@index');
Route::get('suppliers/create','SupplierController@create');
Route::post('suppliers','SupplierController@store');
Route::get('suppliers/{suppliers}', 'SupplierController@show');
Route::get('suppliers/{suppliers}/edit', 'SupplierController@edit');
Route::delete('suppliers/{suppliers}', 'SupplierController@destroy');
Route::patch('suppliers/{suppliers}', 'SupplierController@update');

//database dependency
Route::get('databases', 'DbController@index');
Route::get('databases/create','DbController@create');
Route::post('databases','DbController@store');
Route::get('databases/{databases}', 'DbController@show');
Route::get('databases/{databases}/edit', 'DbController@edit');
Route::delete('databases/{databases}', 'DbController@destroy');
Route::patch('databases/{databases}', 'DbController@update');

//framework dependency
Route::get('frameworks', 'FrameworkController@index');
Route::get('frameworks/create','FrameworkController@create');
Route::post('frameworks','FrameworkController@store');
Route::get('frameworks/{frameworks}', 'FrameworkController@show');
Route::get('frameworks/{frameworks}/edit', 'FrameworkController@edit');
Route::delete('frameworks/{frameworks}', 'FrameworkController@destroy');
Route::patch('frameworks/{frameworks}', 'FrameworkController@update');

//language dependency
Route::get('languages', 'LanguageController@index');
Route::get('languages/create','LanguageController@create');
Route::post('languages','LanguageController@store');
Route::get('languages/{languages}', 'LanguageController@show');
Route::get('languages/{languages}/edit', 'LanguageController@edit');
Route::delete('languages/{languages}', 'LanguageController@destroy');
Route::patch('languages/{languages}', 'LanguageController@update');

//library dependency of app
Route::get('libraries', 'LibraryController@index');
Route::get('libraries/create','LibraryController@create');
Route::post('libraries','LibraryController@store');
Route::get('libraries/{libraries}', 'LibraryController@show');
Route::get('libraries/{libraries}/edit', 'LibraryController@edit');
Route::delete('libraries/{libraries}', 'LibraryController@destroy');
Route::patch('libraries/{libraries}', 'LibraryController@update');

//library dependencies within library
Route::get('librarydependencies', 'LibraryDependencyController@index');
Route::get('librarydependencies/create','LibraryDependencyController@create');
Route::post('librarydependencies','LibraryDependencyController@store');
Route::get('librarydependencies/{librarydependencies}', 'LibraryDependencyController@show');
Route::get('librarydependencies/{librarydependencies}/edit', 'LibraryDependencyController@edit');
Route::delete('librarydependencies/{librarydependencies}', 'LibraryDependencyController@destroy');
Route::patch('librarydependencies/{librarydependencies}', 'LibraryDependencyController@update');

//search
Route::get('search', 'SearchController@index');
Route::patch('search/show', 'SearchController@show');

//server costs
Route::get('costs', 'CostController@index');
Route::get('costs/{costs}', 'CostController@show');
Route::delete('costs/{costs}', 'CostController@destroy');
//costs export
Route::get('costs.csv','CostController@export');

//hours expenditure
Route::get('hours', 'HourController@index');
Route::get('hours/archive', 'HourController@archive');
Route::get('hours/person', 'HourController@person');
Route::get('hours/create', 'HourController@create');
Route::get('hours/{hours}', 'HourController@show');
Route::get('hours/{hours}/edit', 'HourController@edit');
Route::delete('hours/{hours}', 'HourController@destroy');
Route::patch('hours/{hours}', 'HourController@update');

//calendar
Route::get('calendar', 'CalendarController@index');
Route::get('calendar/create','CalendarController@create');
Route::post('calendar','CalendarController@store');
Route::get('calendar/{calendar}', 'CalendarController@show');
Route::get('calendar/{calendar}/edit', 'CalendarController@edit');
Route::delete('calendar/{calendar}', 'CalendarController@destroy');
Route::patch('calendar/{calendar}', 'CalendarController@update');

//roadmaps
Route::get('roadmaps', 'RoadmapController@index');
Route::get('roadmaps/create','RoadmapController@create');
Route::post('roadmaps','RoadmapController@store');
Route::get('roadmaps/{roadmaps}', 'RoadmapController@show');
Route::get('roadmaps/{roadmaps}/edit', 'RoadmapController@edit');
Route::delete('roadmaps/{roadmaps}', 'RoadmapController@destroy');
Route::patch('roadmaps/{roadmaps}', 'RoadmapController@update');

//roadmap tasks and parts
Route::get('roadmaptasks', 'RoadmaptaskController@index');
Route::get('roadmaptasks/create','RoadmaptaskController@create');
Route::post('roadmaptasks','RoadmaptaskController@store');
Route::get('roadmaptasks/{roadmaptasks}', 'RoadmaptaskController@show');
Route::get('roadmaptasks/{roadmaptasks}/edit', 'RoadmaptaskController@edit');
Route::delete('roadmaptasks/{roadmaptasks}', 'RoadmaptaskController@destroy');
Route::patch('roadmaptasks/{roadmaptasks}', 'RoadmaptaskController@update');

//roadmap types
Route::get('roadmaptypes', 'RoadmaptypeController@index');
Route::get('roadmaptypes/create','RoadmaptypeController@create');
Route::post('roadmaptypes','RoadmaptypeController@store');
Route::get('roadmaptypes/{roadmaptypes}', 'RoadmaptypeController@show');
Route::get('roadmaptypes/{roadmaptypes}/edit', 'RoadmaptypeController@edit');
Route::delete('roadmaptypes/{roadmaptypes}', 'RoadmaptypeController@destroy');
Route::patch('roadmaptypes/{roadmaptypes}', 'RoadmaptypeController@update');

//privacy
Route::get('privacy', 'PrivacyController@index');
Route::post('privacy','PrivacyController@store');
Route::get('privacy/{privacy}', 'PrivacyController@show');
Route::get('privacy/{privacy}/edit', 'PrivacyController@edit');
Route::delete('privacy/{privacy}', 'PrivacyController@destroy');
Route::patch('privacy/{privacy}', 'PrivacyController@update');
//privacy export
Route::get('privacy.csv','PrivacyController@export');

//dynamic pdf
Route::get('dynamic_pdf', 'PDFController@index');
Route::get('dynamic_pdf/pdf', 'PDFController@PDF');