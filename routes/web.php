<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ModelOfPhoneController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AjaxController;
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

Route::get('home', function () {
    return view('welcome');
});
//Route Register
Route::get('register_form',function(){
    return view('pages.register');
})->name('register_form');
//Route with AuthController
Route::controller(AuthController::class)->group(function(){
    Route::get('logout','methodLogOut')->name('logout');
    Route::get('login','createLogin')->name('login_form');
    Route::post('method_login','methodLogin')->name('method_login');
});
//Route Prefix Admin and middleware loginMiddleware
Route::prefix('admin')->middleware('loginMiddleware')->group(function(){
    Route::get("home",function(){
        return view('admin.layouts.index');
    })->name('home');
    //Route prefix brands and BrandController
    Route::prefix('brands')->controller(BrandController::class)->group(function(){
        Route::match(['get','post'],'add_brand','add_brand')->name('add_brand');
        // Route::get('add_brand','create');
        // Route::post('add_brand','store')->name('add_brand');
        Route::get('list_brand','show')->name('list_brand');
        Route::get('delete_brand/{id}','destroy');
        Route::match(['get','post'],'edit_brand/{id?}','edit_brand')->name('edit_brand');
    });
    //Route prefix models and ModelController
    Route::prefix('models')->controller(ModelOfPhoneController::class)->group(function(){
        Route::match(['get','post'],'add_model','add_model')->name('add_model');
        Route::get('list_model','show')->name('list_model');
        Route::get('delete_model/{id}','destroy')->name('delete_model');
        Route::match(['get','post'],'edit_model/{id?}','edit_model')->name('edit_model');
    });
    //Route prefix devices and DeviceController
    Route::prefix('devices')->controller(DeviceController::class)->group(function(){
        Route::match(['get','post'],'add_device','add_device')->name('add_device');
        Route::get('list_device','show')->name('list_device');
        Route::get('delete_device/{id}','destroy')->name('delete_device');
        Route::match(['get','post'],'edit_device/{id?}','edit_device')->name('edit_device');
    });
    //Route prefix users and UserController
    Route::prefix('users')->controller(UserController::class)->group(function(){
        Route::match(['get','post'],'add_user','add_user')->name('add_user');
        Route::get('list_user','show')->name('list_user');
        Route::get('delete_user/{id}','destroy')->name('delete_user');
        Route::match(['get','post'],'edit_user/{id?}','edit_user')->name('edit_user');
        Route::get('change_password','create_change_password')->name('change_password');        
        Route::post('method_change_password','change_password')->name('method_change_password');
        Route::get('user_profile','create_user_profile')->name('user_profile');
        Route::post('method_change_profile_user','change_profile_user')->name('method_change_profile_user');
        Route::post('method_register','register')->name('method_register');
    });
    //Route prefix ajax and AjaxController
    Route::prefix('ajax')->controller(AjaxController::class)->group(function(){
        Route::get('brand/{id}','getModelByBrandId');
    });
    
    
    
});
