<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here you'll see the API routes that VueJS consults.
|
*/

Route::group(['as' => 'api.'], function () {

    Route::post('auth/register', 'UserController@register')->name('auth.register');
    Route::post('auth/login', 'UserController@login')->name('auth.login');
    Route::get('auth/check', 'UserController@check')->name('auth.register');

    Route::group(['middleware' => 'jwt.auth', 'as' => 'user.'], function () {
        Route::resource('posts', 'PostsController');
        Route::resource('comments', 'CommentsController');

        Route::get('my-posts', 'PostsController@myPosts')->name('posts.my_post');
    });

});
