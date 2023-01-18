<?php

// Register
Route::post('register', 'Api\\AuthController@register');
// Login
Route::post('login', 'Api\\AuthController@login');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');
});
