<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 * Welcome Page Route.
 */
Route::get('/', [
    'uses' => 'HomeController@getWelcomePage',
    'as'   => 'page.welcome'
]);

/*
 * Authentication Route.
 */
Auth::routes();

Route::get('/home', 'HomeController@index');

/*
 * Verify User Account Route.
 */
Route::get('verify-user-account/{verificationToken}', [
    'uses' => 'AccountVerificationController@getVerifiedToken',
    'as'   => 'actions.verify-user-account'
]);

/*
 * Project's routes
 */
Route::resource('projects', 'ProjectController');
