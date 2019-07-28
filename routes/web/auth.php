<?php

Route::group([
    'prefix' => 'login',
    'as' => 'login.'
], function () {
    Route::get('/', [
        'uses' => 'LoginController@index',
        'as' => 'index'
    ]);

    Route::post('/', [
        'uses' => 'LoginController@email'
    ]);
});

Route::group([
    'prefix' => 'register',
    'as' => 'register.'
], function () {
    Route::get('/', [
        'uses' => 'RegisterController@index',
        'as' => 'index'
    ]);

    Route::post('/', [
        'uses' => 'RegisterController@finish'
    ]);

    Route::get('/password', [
        'uses' => 'RegisterController@password',
        'as' => 'password'
    ]);

    Route::post('/password', [
        'uses' => 'RegisterController@setPassword'
    ]);
});
