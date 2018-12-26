<?php
use Illuminate\Http\Request;

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('refresh', 'Api\AuthController@refresh');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\AuthController@logout');
});