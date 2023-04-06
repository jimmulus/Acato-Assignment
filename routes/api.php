<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Version 1 API
Route::prefix('v1')->group(function () {
    // all birds routes
    Route::prefix('vogels')->group(function () {
        Route::get('info', 'BirdController@infoVue');
        Route::get('data', 'BirdController@dataVue');
        Route::post('report', 'BirdController@mailBirdRreport');
    });

    // Authentication
    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('refresh', 'AuthController@refresh');

        // Protected
        Route::group(['middleware' => 'auth:api'], function () {
            // User level
            Route::get('user', 'AuthController@user');
            Route::get('admin', 'AuthController@admin');

            // Users
            Route::get('users', 'UserController@index')->middleware('isAdmin');
            Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');

            // Logout
            Route::post('logout', 'AuthController@logout');
        });
    });
});
