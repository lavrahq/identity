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

Route::get('/', 'HomeController@home')
    ->middleware('auth');

Route::group([
    'prefix' => '/click',
    'namespace' => 'Click',
    'as' => 'click.'
], function () {
    Route::group([
        'prefix' => '/verify',
        'as' => 'verify.'
    ], function () {
        Route::get('/email/{address}', [
            'uses' => 'VerificationController@email',
            'as' => 'email'
        ]);
    });
});

Route::group([
    'prefix' => '/auth',
    'namespace' => 'Auth',
    'as' => 'auth.'
], function () {

    Route::group([
        'prefix' => '/setup',
        'as' => 'setup.'
    ], function () {
        Route::get('/', [
            'uses' => 'SetupController@index',
            'as' => 'index'
        ]);

        Route::post('/', [
            'uses' => 'SetupController@initial'
        ]);

        Route::get('/password', [
            'uses' => 'SetupController@password',
            'as' => 'password'
        ]);

        Route::post('/password', [
            'uses' => 'SetupController@setPassword'
        ]);
    });

    Route::group([
        'prefix' => '/login',
        'as' => 'login.'
    ], function () {
        Route::get('/', [
            'uses' => 'LoginController@index',
            'as' => 'index'
        ]);

        Route::post('/', [
            'uses' => 'LoginController@email',
        ]);

        Route::get('/verification_link', [
            'uses' => 'LoginController@verificationLink',
            'as' => 'verification_link'
        ]);
    });
});
