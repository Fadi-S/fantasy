<?php

Route::group(['middleware' => \App\Http\Middleware\VerifyAPITokenExpiration::class], function () {

    Route::get('/test', function() {
        return response(['message' => "Connected successfully"]);
    });

    Route::get('/quizzes', 'User\API\QuizzesController@index');
    Route::post('/quizzes/{quiz}/save', 'User\API\QuizzesController@saveCharactersToUser');
    Route::post('/quizzes/{quiz}/captain', 'User\API\QuizzesController@saveCaptainToUser');
    Route::post('/quizzes/{quiz}/questions', 'User\API\QuizzesController@saveQuestions');
    Route::get('/quizzes/{quiz}/texts', 'User\API\QuizzesController@getTexts');
    Route::get('/characters', 'User\API\QuizzesController@getAllCharacters');

    Route::get('/quizzes/{quiz}/questions', 'User\API\QuizzesController@getQuizQuestions');
    Route::get('/quizzes/{quiz}/solved/questions', 'User\API\QuizzesController@getSolvedQuizQuestions');

    Route::post('/changePassword', 'User\API\Auth\LoginController@changePassword');

    Route::post('/changePicture', 'User\API\ApplicationController@changePicture');

    Route::post('/logout', 'User\API\LoginController@logout');
});

Route::post("/login", 'User\API\Auth\LoginController@login');
Route::post("/register", 'User\API\Auth\RegisterController@register');
Route::post('/refresh', 'User\API\Auth\LoginController@refresh');

Route::post('password/email', 'User\API\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'User\API\Auth\ResetPasswordController@reset');

Route::post('review', 'User\API\ApplicationController@saveReview');