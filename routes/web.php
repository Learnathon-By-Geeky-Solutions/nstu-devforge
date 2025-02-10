<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Con;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);



Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['auth', 'permission','verified']], function () {
    Route::get('/',[Con\HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resources([
        'users' => 'UserController',
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
    ]);

    Route::get('profile', 'UserController@profile_index')->name('profile');

    Route::get('/map', 'DashboardController@map_index')->name('maps.index');

});
