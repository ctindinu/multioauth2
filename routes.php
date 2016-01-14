<?php



Route::group(['middleware' => ['web']], function () {
  Route::post('/generateAccessToken',  "\Viable\MultiOAuth2\Controllers\TokenController@generateToken");
});


