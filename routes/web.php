<?php

use App\Http\Controllers\PartnerController;

use App\Http\Controllers\MemberController;

use App\Http\Controllers\VolunteerController;

use App\Http\Controllers\DonorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
})->name('main'); 

//Auth::routes();

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('home', [HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()){

        if(Auth::user()->role == 'partner')
        {
            return redirect()->route('partner#index');
        }
        else if(Auth::user()->role == 'volunteer')
        {
            return redirect()->route('volunteer#index');
        }
        else if(Auth::user()->role == 'member')
        {
            return redirect()->route('member#index');
        }
        else if(Auth::user()->role == 'donor')
        {
            return redirect()->route('initiate.payment');
        }
    }
})->name('dashboard');

//Partner
Route::group(['prefix' => 'partner'], function(){
    Route::get('/', [PartnerController::class, 'index'])->name('partner#index'); //partner dashboard // view meal
    Route::get('/details/{id}', [PartnerController::class, 'detailsMeal'])->name('partner#detailsMeal'); //partner dashboard // view meal
    Route::get('addMeal', [PartnerController::class, 'addMeal'])->name('partner#addMeal'); //partner create meal
    Route::post('createMeal', [PartnerController::class, 'createMeal'])->name('partner#createMeal'); //creating Meal
    Route::get('editMeal/{id}', [PartnerController::class, 'editMeal'])->name('partner#editMeal'); //edit Meal
    Route::post('updateMeal/{id}', [PartnerController::class, 'updateMeal'])->name('partner#updateMeal'); //update Meal
    Route::get('deleteMeal/{id}', [PartnerController::class, 'deleteMeal'])->name('partner#deleteMeal'); // delete Meal
    Route::get('updatePartner', [PartnerController::class, 'editPartner'])->name('partner#update'); //edit Meal
});

//Volunteer
Route::group(['prefix' => 'volunteer'], function(){
    Route::get('/', [VolunteerController::class, 'index'])->name('volunteer#index'); //volunteer dashboard
    Route::get('volunteerDetails/{id}', [VolunteerController::class, 'volunteerDetails'])->name('volunteer#volunteerDetails'); // volunteer Details
    Route::post('volunteerMember', [VolunteerController::class, 'volunteerMember'])->name('volunteer#volunteerMember'); //volunteer chosen member
    Route::get('deleteOrder/{id}', [VolunteerController::class, 'deleteOrder'])->name('volunteer#deleteOrder'); // delete Meal
});

Route::group(['prefix' => 'member'], function(){

    Route::get('/', [MemberController::class, 'index'])->name('member#index'); //volunteer dashboard
    Route::get('memberDetails/{id}', [MemberController::class, 'memberDetails'])->name('member#memberDetails'); // volunteer Details
    // Route::post('volunteerMember', [VolunteerController::class, 'volunteerMember'])->name('volunteer#volunteerMember'); //volunteer chosen member
    Route::get('addOrder', [MemberController::class, 'addOrder'])->name('member#addOrder'); //partner create meal
    Route::post('createOrder', [MemberController::class, 'createOrder'])->name('member#createOrder'); //creating Meal
});

// Route::get('/initiate','App\Http\Controllers\PaytmController@initiate')->name('initiate.payment');
// Route::post('/payment','App\Http\Controllers\PaytmController@pay')->name('make.payment');
// Route::post('/payment/status', 'App\Http\Controllers\PaytmController@paymentCallback')->name('status');

Route::group(['prefix' => 'donor'], function(){

    Route::get('/initiate', [DonorController::class, 'initiate'])->name('initiate.payment'); //volunteer dashboard
    Route::post('/payment', [DonorController::class, 'pay'])->name('make.payment'); // volunteer Details
    // Route::post('volunteerMember', [VolunteerController::class, 'volunteerMember'])->name('volunteer#volunteerMember'); //volunteer chosen member
    Route::post('/payment/status', [DonorController::class, 'paymentCallback'])->name('status'); //partner create meal
    // Route::post('createOrder', [DonorController::class, 'createOrder'])->name('status'); //creating Meal
});