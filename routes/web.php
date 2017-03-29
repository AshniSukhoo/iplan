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
    'as'   => 'page.welcome',
]);

/*
 * Privacy  policies page
 */
Route::get('privacy-policies', 'PoliciesController@index')->name('policies');

/*
 * Authentication Route.
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Verify User Account Route.
 */
Route::get('verify-user-account/{verificationToken}', [
    'uses' => 'AccountVerificationController@getVerifiedToken',
    'as'   => 'actions.verify-user-account',
]);

/*
 * Project's routes
 */
Route::resource('projects', 'ProjectController');

/*
 * Route to get project assigned to members
 */
Route::get('assigned-projects', 'ProjectController@getAssignedProject')->name('assignedProject');

/*
 * work items' route
 */
Route::resource('projects/{project_id}/work-items', 'WorkItemController');

/*
 * route to search for parent work item
 * controller work item
 */
Route::get('search-parent-work-item/{project}', 'WorkItemController@autoCompleteWorkItemsSearch')
     ->name('searchParentWorkItem');

/*
 * Members of Project.
 */
Route::resource('projects/{project}/members', 'ProjectMembersController', [
    'only' => [
        'index',
        'store',
        'destroy',
    ],
]);

/*
 * Route to search for members of projects.
 */
Route::get('search-user-of-project/{project}', 'ProjectMembersController@searchMembers')->name('searchUserForProject');

/*
 * Route to search for non member of project.
 */
Route::get('search-non-member-of-project/{project}', 'ProjectMembersController@searchNonMembers')
     ->name('searchNonUserForProject');

/*
 * Route for user profile
 */
Route::resource('profile', 'UserProfileController', [
    'only'       => ['show', 'edit', 'update'],
    'parameters' => ['profile' => 'user'],
]);

/*
 * Show all my notifications.
 */
Route::get('notifications', 'NotificationController@index')->middleware('auth')->name('notifications');
