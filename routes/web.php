<?php

Route::prefix("admin")->group(function() {
    Route::get('/', 'Admin\DashboardController@index');

    /* Authentication */
    Route::get('/login', 'Admin\LoginController@showLoginForm');
    Route::post('/login', 'Admin\LoginController@login');
    Route::post('/logout', 'Admin\LoginController@logout');

    Route::post('/users/{user}/savePoints', 'Admin\UsersController@savePoints');
    Route::resource('/users', 'Admin\UsersController');

    Route::get('/change-password', 'Admin\AdminsController@showChangePasswordForm');
    Route::post('/change-password', 'Admin\AdminsController@changePassword');

    Route::resource('/admins', 'Admin\AdminsController');
    Route::get('/activity', 'Admin\AdminsController@activityLog');
    Route::get('/activity/{activity}/restore', 'Admin\AdminsController@restoreActivity');

    Route::get("reviews", 'Admin\ReviewsController@index');

    Route::resource('/questions', 'Admin\QuestionsController');
    Route::resource('/texts', 'Admin\TextsController')->except("show");
    Route::resource('/characters', 'Admin\CharactersController');
    Route::resource('/quizzes', 'Admin\QuizzesController');
});

Route::get('password/reset/{token}', 'User\API\ResetPasswordController@showResetForm');
Route::post('password/reset', 'User\API\ResetPasswordController@reset');
Route::get('/support', 'User\SupportController@index');