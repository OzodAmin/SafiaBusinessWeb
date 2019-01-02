<?php
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localize', 'localizationRedirect' ]
],
function()
{
	Route::get('/', 'HomeController@index');
	Route::get('getCatName','HomeController@getCatName');
    Route::get('product/{slug}', ['as'=> 'product.show', 'uses' => 'HomeController@showProduct']);
    Route::get('category/{catId}', ['as'=> 'category.show', 'uses' => 'HomeController@showCatPro']);

    Route::get('remove/{id}', ['as'=> 'product.remove', 'uses' => 'CartController@getRemoveItem']);
    Route::get('shopping-cart',['as'=> 'product.shoppingCart','uses' =>'CartController@showCart']);
    Route::get('add-to-cart','CartController@addToCart');

    Route::get('add-to-favorite','FavoriteController@addToFavorite');
    Route::get('remove-favorite','FavoriteController@removeFavorite');

    Auth::routes();
});

Route::group(['prefix' => 'backend','middleware' => ['role:admin']], function() {

	Route::get('/', 'Admin\Backend');
    Route::resource('roles','Admin\RoleController');
    Route::resource('users','Admin\UserController');
    Route::resource('cities', 'Admin\CityController');
    Route::resource('districts', 'Admin\DistrictController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('bases', 'Admin\BaseController');
    Route::resource('creams', 'Admin\CreamController');
    Route::resource('fillings', 'Admin\FillingController');
    Route::resource('decors', 'Admin\DecorController');
    Route::resource('covers', 'Admin\CoverController');
    Route::resource('sizes', 'Admin\SizeController');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('measures', 'Admin\MeasureController');

    Route::get('api/getDistricts','Admin\UserController@getDistricts');
    Route::get('users/reset/{id}','Admin\UserController@reset');

});