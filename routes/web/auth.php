<?php
use Illuminate\Support\Facades\Auth;

Route::get('/logout', function () {
    Auth::logout();

    return redirect()
        ->route('portal');
});

Route::group([
    'prefix' => 'login',
    'as'     => 'login.',
], function () {
    Route::get('/', [
        'uses' => 'LoginController@index',
        'as'   => 'index',
    ]);

    Route::post('/', [
        'uses' => 'LoginController@email',
    ]);

    Route::get('/password', [
        'uses' => 'LoginController@password',
        'as' => 'password'
    ]);

    Route::post('/password', [
        'uses' => 'LoginController@withPassword',
    ]);
});

Route::group([
    'prefix' => 'register',
    'as'     => 'register.',
], function () {
    Route::get('/', [
        'uses' => 'RegisterController@index',
        'as'   => 'index',
    ]);

    Route::post('/', [
        'uses' => 'RegisterController@finish',
    ]);

    Route::get('/password', [
        'uses' => 'RegisterController@password',
        'as'   => 'password',
    ]);

    Route::post('/password', [
        'uses' => 'RegisterController@setPassword',
    ]);
});
