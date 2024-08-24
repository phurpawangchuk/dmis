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
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [HomeController::class, 'index']);
Route::get('welcome', [FrontController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/register', [FrontController::class, 'loginRegister'])->name('loginRegister');
Route::get('/donorregistration', [FrontController::class, 'donorregistration'])->name('donorregistration');
Route::post('/registration',[FrontController::class,'registration'])->name('registration.post');

Route::post('/studentLogin', [AuthController::class, 'sLogin'])->name('sLogin');
// Route::get('/login', [FrontController::class, 'goLogin'])->name('login');
Route::get('/scholarshipDetails/{id}', [FrontController::class, 'scholarshipDetails'])->name('scholarshipDetails');
Route::get('/loginRegister', [FrontController::class, 'loginRegister'])->name('loginRegister');

Route::get('/studentRegistration', [FrontController::class, 'studentRegistration'])->name('studentRegistration');
Route::get('/allScholarships', [FrontController::class, 'allScholarships'])->name('allScholarships');
Route::post('/studentLogin', [AuthController::class, 'sLogin'])->name('sLogin');

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('profile-image-out/{profile}', [ComponentController::class, 'displayProfileImage'])->name('profile.image-out');
Route::get('studentForgot', [FrontController::class, 'studentForgotPage'])->name('student.forgot');
Route::post('studentForgotPost', [FrontController::class, 'studentForgotPost'])->name('student.forgotpost');
Route::get('/result-details/{id}',[FrontController::class,'resultDetails'])->name('resultDetails');
Route::get('partners', [FrontController::class, 'partners'])->name('partners');
Route::post('/studentDashboard/payments', [AuthController::class, 'sLogins'])->name('sLogins');
Route::post('/studentDashboard/otp', [AuthController::class, 'otp'])->name('otp');

Route::group(['prefix'=>"donor",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/index', [DonorController::class,'index'])->name('donors.index');
    
    Route::get('/donate', [DonorController::class,'donate'])->name('donors.donateform');
    // Route::post('/step-one', [DonorController::class,'postDonate'])->name('donors.create.step.one.post');
    Route::post('/nextstep', [DonorController::class,'nextstep'])->name('donors.nextstep');
   
});

Route::group(['prefix'=>"admin",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController')->except(['show']);
    // Route::get('/index', [DonorController::class,'index'])->name('donors.index');
    // Route::resource('/posts', 'PostController');
    // Route::get('/sendmail', [MailController::class, 'sendmail']);
    // Route::get('/approve', 'PostController@approve')->name('posts.approve');
    // Route::get('/getGewogList','PostController@gewogList');
    // Route::get('/citizen', 'ApiController@citizenDetails')->name('api.citizen');
    // Route::get('/step-one', [DonorController::class,'createStepOne'])->name('donors.create.step.one');
    
    
    // Route::post('/step-one', [DonorController::class,'postCreateStepOne'])->name('donors.create.step.one.post');
    // Route::get('/step-two', [DonorController::class,'createStepTwo'])->name('donors.create.step.two');
    // Route::post('/step-two', [DonorController::class,'postCreateStepTwo'])->name('donors.create.step.two.post');
    // Route::get('/step-three', [DonorController::class,'createStepThree'])->name('donors.create.step.three');
    // Route::post('/step-three', [DonorController::class,'postCreateStepThree'])->name('donors.create.step.three.post');
    Route::get('/rma', [DonorController::class,'rma'])->name('donors.rma');
    Route::get('/qr', [DonorController::class,'qr'])->name('donors.qr');
    Route::get('/donationhistory', [DonorController::class,'donationhistory'])->name('donors.donationhistory');
    
    Route::get('/onlinepayment', [DonorController::class,'onlinepayment'])->name('donors.onlinepayment');

    // Route::get('/event', [DonorController::class,'event'])->name('donors.event');
    // Route::post('/store', [DonorController::class,'store'])->name('donors.store');
    // Route::get('/registereddonor', [DonorController::class,'registereddonor'])->name('donors.registereddonor');
    // Route::get('/offlinedonorindex', [DonorController::class,'offlinedonorindex'])->name('donors.offlinedonorindex');
    // Route::get('/offlinedonation', [DonorController::class,'offlinedonation'])->name('donors.offlinedonation');
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

Route::group(['prefix'=>"projects",'as' => 'dashboard.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {
    Route::get('/', 'ProjectMasterController@index')->name('projects.index');
    Route::get('/create', 'ProjectMasterController@create')->name('projects.create');
    Route::post('/store', 'ProjectMasterController@store')->name('projects.store');
    Route::get('/edit/{project}', 'ProjectMasterController@edit')->name('projects.edit');
    Route::post('/update/{project}', 'ProjectMasterController@update')->name('projects.update');
    Route::delete('/destroy/{project}', 'ProjectMasterController@destroy')->name('projects.destroy');
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

Route::prefix('sendmail')->group(function () {
    Route::get('/', [MailController::class, 'sendmail']);
});


