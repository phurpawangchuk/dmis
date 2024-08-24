<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\DonorController;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CcountryController;

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
 Route::get('/phpinfo', function () {
      echo phpinfo();
 });
// Route::get('/', [HomeController::class, 'index']);
Route::get('welcome', [FrontController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/register', [FrontController::class, 'loginRegister'])->name('loginRegister');
Route::get('/donorregistration', [FrontController::class, 'donorregistration'])->name('donorregistration');
Route::post('/registration',[FrontController::class,'registration'])->name('registration.post');
Route::get('/forgotpassword', [FrontController::class, 'forgotpassword'])->name('donors.forgotpassword');
Route::post('/forgotpassword', [FrontController::class, 'forgotpassword'])->name('donors.forgotpassword');

// Route::get('studentForgot', [FrontController::class, 'studentForgotPage'])->name('student.forgot');
// Route::post('studentForgotPost', [FrontController::class, 'studentForgotPost'])->name('student.forgotpost');

Route::group(['prefix'=>"donor",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/index', [DonorController::class,'index'])->name('donors.index');
    Route::get('/index1', [DonorController::class,'index1'])->name('donors.index1');
    Route::get('/donate', [DonorController::class,'donate'])->name('donors.donateform');
    Route::post('/postDonate', [DonorController::class,'postDonate'])->name('donors.postDonate');
    Route::post('/nextstep', [DonorController::class,'nextstep'])->name('donors.nextstep');
    Route::get('/receipt/{id}', [DonorController::class,'receipt']);
    Route::get('/donorlist', [DonorController::class,'donorlist'])->name('donors.donorlist');
    Route::get('/send-greeting', [DonorController::class,'sendgreeting'])->name('donors.send-greeting');
    Route::get('/inactive-donorlist', [DonorController::class,'inactivedonorlist'])->name('donors.inactivedonorlist');
    Route::post('/search', 'DonorController@search')->name('donors.search');
    Route::get('/details/{id}', 'DonorController@details')->name('donors.donordetails');
    Route::get('/donordonateddetails/{id}', 'DonorController@donordonateddetails')->name('donors.donordonateddetails');


    Route::get('/festgreeting', [DonorController::class,'festgreeting'])->name('donors.festgreeting');
    Route::post('/send', [DonorController::class,'send'])->name('donors.send');
    Route::post('/sending', [DonorController::class,'sending'])->name('donors.sending');
    Route::get('/edit/{donor}', 'DonorController@edit')->name('donors.edit');
    Route::post('/update/{donor}', 'DonorController@update')->name('donors.update');
});

Route::group(['prefix'=>"admin",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {

    Route::get('/', 'DashboardController@index')->name('home');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController')->except(['show']);
    Route::get('/rma', [DonorController::class,'rma'])->name('donors.rma');
    Route::get('/qr', [DonorController::class,'qr'])->name('donors.qr');
    Route::get('/donationhistory', [DonorController::class,'donationhistory'])->name('donors.donationhistory');
    Route::get('/onlinepayment', [DonorController::class,'onlinepayment'])->name('donors.onlinepayment');
    Route::post('/noc', [DonorController::class,'birthdaynotifiaction']);
    Route::post('/nocup', [DonorController::class,'birthdaynotifiactionupdate']);
    Route::get('/birthdaywishespost/{user}', [DonorController::class,'birthdaywishes'])->name('donors.birthdaywishes');
});

Route::group(['prefix'=>"events",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'EventController@index')->name('events.index');
    Route::get('/create', 'EventController@create')->name('events.create');
    Route::post('/store', 'EventController@store')->name('events.store');
    Route::get('/edit/{event}', 'EventController@edit')->name('events.edit');
    Route::post('/update/{event}', 'EventController@update')->name('events.update');
    Route::delete('/destroy/{event}', 'EventController@destroy')->name('events.destroy');
});

Route::group(['prefix'=>"countries",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'CountryController@index')->name('countries.index');
    Route::get('/create', 'CountryController@create')->name('countries.create');
    Route::post('/store', 'CountryController@store')->name('countries.store');
    Route::get('/edit/{country}', 'CountryController@edit')->name('countries.edit');
    Route::post('/update/{country}', 'CountryController@update')->name('countries.update');
    Route::delete('/destroy/{country}', 'CountryController@destroy')->name('countries.destroy');
});

Route::group(['prefix'=>"calendars",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'CalendarController@index')->name('calendars.index');
    Route::get('/create', 'CalendarController@create')->name('calendars.create');
    Route::post('/store', 'CalendarController@store')->name('calendars.store');
    Route::get('/edit/{calendar}', 'CalendarController@edit')->name('calendars.edit');
    Route::post('/update/{calendar}', 'CalendarController@update')->name('calendars.update');
    Route::delete('/destroy/{calendar}', 'CalendarController@destroy')->name('calendars.destroy');
});
Route::group(['prefix'=>"projects",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'ProjectMasterController@index')->name('projects.index');
    Route::get('/create', 'ProjectMasterController@create')->name('projects.create');
    Route::post('/store', 'ProjectMasterController@store')->name('projects.store');
    Route::get('/edit/{project}', 'ProjectMasterController@edit')->name('projects.edit');
    Route::post('/update/{project}', 'ProjectMasterController@update')->name('projects.update');
    Route::delete('/destroy/{project}', 'ProjectMasterController@destroy')->name('projects.destroy');
});

Route::group(['prefix'=>"fundutils",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'FundUtilController@index')->name('fundutils.index');
    Route::get('/create', 'FundUtilController@create')->name('fundutils.create');
    Route::post('/store', 'FundUtilController@store')->name('fundutils.store');
    Route::get('/edit/{id}', 'FundUtilController@edit')->name('fundutils.edit');
    Route::post('/update/{id}', 'FundUtilController@update')->name('fundutils.update');
    Route::delete('/destroy/{id}', 'FundUtilController@destroy')->name('fundutils.destroy');
});


Route::group(['prefix'=>"util",'as' => 'admin.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/dispatchnumber', 'UtilController@dispatchnumber')->name('util.dispatchnumber');
    Route::get('/getStaffList', 'UtilController@getStaffList');
    Route::get('/getDepartments', 'UtilController@getDepartments');
    Route::get('/getDivisions', 'UtilController@getDivisions');

});

Route::group(['prefix'=>"users",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/create', 'UserController@create')->name('users.create');
    Route::post('/store', 'UserController@store')->name('users.store');
    Route::get('/show/{user}', 'UserController@show')->name('users.show');
    Route::get('/edit/{user}', 'UserController@edit')->name('users.edit');
    Route::get('/profile/{user}', 'UserController@profile')->name('users.profile');
    Route::post('/update/{user}', 'UserController@update')->name('users.update');
    Route::get('/view/{user}', 'UserController@view')->name('users.view');
    Route::get('/approve', 'UserController@approve')->name('users.approve');
    Route::delete('/destroy/{user}', 'UserController@destroy')->name('users.destroy');
    Route::post('/updatestaff', 'UserController@updatestaff')->name('users.updatestaff');
    Route::post('/updatehead', 'UserController@updatehead')->name('users.updatehead');
    Route::put('/updateprofile/{user}', 'UserController@updateprofile')->name('users.updateprofile');
    Route::get('/changepwd', 'UserController@changepwd')->name('users.changepwd');
    Route::post('/changepwd', 'UserController@changepwd')->name('users.changepwd');
});

Route::group(['prefix'=>"sliders",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'SliderController@index')->name('sliders.index');
    Route::get('/create', 'SliderController@create')->name('sliders.create');
    Route::post('/store', 'SliderController@store')->name('sliders.store');
    Route::get('/edit/{slider}', 'SliderController@edit')->name('sliders.edit');
    Route::post('/update/{slider}', 'SliderController@update')->name('sliders.update');
    Route::put('/updateprofile/{slider}', 'SliderController@updateprofile')->name('sliders.updateprofile');
    Route::delete('/destroy/{slider}', 'SliderController@destroy')->name('sliders.destroy');
});

Route::prefix('sendmail')->group(function () {
    Route::get('/', [MailController::class, 'sendmail']);
    Route::get('/admin-notification', [MailController::class, 'notification']);
});


