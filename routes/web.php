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
Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->back();
});


Auth::routes(['verify' => true]);



Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['auth', 'permission','verified']], function () {
    Route::get('/',[Con\HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resources([
        'users' => 'UserController',
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
        'vehicles' => 'VehicleController',
        'drivers' => 'DriverController',
        'maps' => 'MapController',
    ]);

    Route::get('profile', 'UserController@profile_index')->name('profile');

    Route::get('chat/{driver?}', 'DashboardController@chat')->name('chat.index');

});
