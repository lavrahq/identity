<?php

/**
 * Load the Routes for the web category.
 */

// Auth
Route::group([
    'prefix'    => '/auth',
    'namespace' => 'Auth',
    'as'        => 'auth.',
], function () {
    require __DIR__.'/auth.php';
});

Route::get('/some-route', function () {
    return 'authd';
})
    ->middleware('auth');

Route::get('/{any?}', 'PortalController@index')
    ->where('any', '.*')
    ->name('portal');
