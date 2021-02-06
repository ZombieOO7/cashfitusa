<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** Login */
Route::post('/login', 'API\LoginController@login');

/** Logout */
Route::post('/logout', 'API\LoginController@logout');

/** Register */
Route::post('/register', 'API\RegisterController@register');

/** Forget Password */
Route::post('/forget_password', 'API\ResetPasswordController@forgotPassword');

/** Positions List */
Route::post('/positions_list','API\MasterController@positionsList');

/** Companies List */
Route::post('/companies_list','API\MasterController@companiesList');

/** Auth API Group */
Route::group(['middleware' => ['auth:api']], function() {

    /** Add New Job */
    Route::post('/add_job', 'API\JobController@add');

    /** Job Details*/
    Route::post('/job_details', 'API\JobController@detail');

    /** All Job List*/
    Route::post('/all_jobs', 'API\JobController@allJobs');

    /** Job Status Wise*/
    Route::post('/job_by_status', 'API\JobController@jobByStatus');

    /** Contact Us */
    Route::post('/contact_us', 'API\UserController@contactUs');

    /** Support */
    Route::post('/support', 'API\UserController@support');

    /** Profile Detail */
    Route::post('/profile_detail', 'API\UserController@profileDetail');

    /** Update Profile */
    Route::post('/update_profile', 'API\UserController@updateProfile');

    /** CMS Pages */
    Route::post('/cms', 'API\CMSController@detail');

    /** Filter By Priority */
    Route::post('/filter_by_priority', 'API\JobController@filterByPriority');

    /** Machines List */
    Route::post('/machines_list','API\MasterController@machinesList');

    /** Locations List */
    Route::post('/locations_list','API\MasterController@locationsList');

    /** Problems List */
    Route::post('/problems_list','API\MasterController@problemsList');

    /** FAQs List */
    Route::post('/faqs_list','API\MasterController@faqsList');

    /** Engnieers List */
    Route::post('/engineers_list','API\MasterController@engineersList');

    /** Decline Job */
    Route::post('/decline_job', 'API\JobController@declineJob');

    /** Start Job */
    Route::post('/start_job', 'API\JobController@startJob');

    /** End Job */
    Route::post('/end_job', 'API\JobController@endJob');

    /** Edit Job */
    Route::post('/edit_job', 'API\JobController@edit');

    /** Accept Job */
    Route::post('/accept_job', 'API\JobController@acceptJob');

    /** Notifications List */
    Route::post('/notification_list','API\MasterController@notificationList');

    /** Change Password */
    Route::post('/change_password', 'API\UserController@changePassword');

});