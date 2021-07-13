<?php

Route::prefix('admin')->group(function() {
    Route::get('/', 'Admin\DashboardController@index');

    /* Authentication */
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Admin\LoginController@login');
    Route::post('/logout', 'Admin\LoginController@logout')->name('logout');

    Route::post('/users/{user}/savePoints', 'Admin\UsersController@savePoints');
    Route::get('/users/calculate/{competition}', 'Admin\UsersController@calculatePointsForCompetition');
    Route::get('/users/calculate', 'Admin\UsersController@calculatePoints');
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
    Route::resource('/competitions', 'Admin\CompetitionsController');
    Route::resource('/groups', 'Admin\GroupsController');
});

Route::get('password/reset/{token}', 'User\API\Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'User\API\Auth\ResetPasswordController@reset');
Route::get('/support', 'User\SupportController@index');
