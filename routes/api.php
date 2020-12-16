<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/access_token', 'CNX247\API\TwilioAccessTokenController@generateToken');
Route::get('/task-calendar', 'CNX247\API\TaskControllerAPI@getTaskCalendarData');
Route::post('/conversation/call', 'CNX247\Backend\TokenController@newCall');

/* Route::post('register', 'CNX247\API\AuthController@register');
Route::post('login', 'CNX247\API\AuthController@login'); */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'CNX247\API\AuthController@login');
    Route::post('register', 'CNX247\API\AuthController@register');
    Route::post('logout', 'CNX247\API\AuthController@logout');
    Route::post('refresh', 'CNX247\API\AuthController@refresh');
    Route::get('user-profile', 'CNX247\API\AuthController@userProfile');
    Route::get('IstokenValid', 'CNX247\API\AuthController@isValidToken');
});



Route::group(['middleware' => ['jwt.verify'], 'prefix'=>'auth' ], function() {
    Route::get('user', 'CNX247\API\AuthController@getAuthenticatedUser');
		Route::post('stream', 'CNX247\API\StreamController@index');
		Route::post('singlePost', 'CNX247\API\StreamController@StreamPost');
		Route::post('like', 'CNX247\API\StreamController@like');
		Route::post('comment', 'CNX247\API\StreamController@comment');
		Route::post('users', 'CNX247\API\usersController@users');
		Route::post('tenant', 'CNX247\API\usersController@getTenantDetails');


		Route::post('isloggedin', 'CNX247\API\usersController@isLoggedIn');

		Route::post('isloggedout', 'CNX247\API\usersController@isLoggedout');




		Route::post('savetoken', 'CNX247\API\usersController@saveUserDeviceToken');

		Route::post('newtask', 'CNX247\API\StreamController@storeTask');
		Route::post('newproject', 'CNX247\API\StreamController@storeProject');
		Route::post('newannouncement', 'CNX247\API\StreamController@storeAnnouncement');
		Route::post('newevent', 'CNX247\API\StreamController@storeEvent');
		Route::post('newreport', 'CNX247\API\StreamController@storeReport');


		Route::post('addpersons', 'CNX247\API\StreamController@addResponsiblePerson');
		Route::post('addparticipants', 'CNX247\API\StreamController@addParticipant');
		Route::post('addobservers', 'CNX247\API\StreamController@addObserver');

		Route::post('removeperson', 'CNX247\API\StreamController@removeResponsiblePerson');
		Route::post('removeparticipant', 'CNX247\API\StreamController@removeParticipant');
		Route::post('removeobserver', 'CNX247\API\StreamController@removeObserver');

		Route::post('markcomplete', 'CNX247\API\StreamController@markAsComplete');
		Route::post('markatrisk', 'CNX247\API\StreamController@markAsRisk');
		Route::post('markresolved', 'CNX247\API\StreamController@markAsResolved');
		Route::post('markclosed', 'CNX247\API\StreamController@markAsClosed');
		Route::post('markonhold', 'CNX247\API\StreamController@markAsHold');


		Route::post('submit', 'CNX247\API\StreamController@submitPost');
		Route::post('update', 'CNX247\API\StreamController@updatePost');
		Route::post('delete', 'CNX247\API\StreamController@deletePost');


		Route::post('streamsharefile', 'CNX247\API\StreamController@shareFile');
		Route::get('priorities', 'CNX247\API\StreamController@priorities');
		Route::post('chats', 'CNX247\API\StreamController@getmessages');


		Route::post('sndchat', 'CNX247\API\StreamController@sendChat');
		Route::post('updatechat', 'CNX247\API\StreamController@updateIsReadStatus');

		//Route::post('notify', 'CNX247\API\StreamController@pushtoToken');




		Route::post('drive', 'CNX247\API\DriveController@getDriveContents');

		Route::post('contents', 'CNX247\API\DriveController@getContents');

		Route::post('size', 'CNX247\API\DriveController@getSize');

		Route::post('newfolder', 'CNX247\API\DriveController@newFolder');

		Route::post('uploadtodrive', 'CNX247\API\DriveController@UploadFile');



		Route::post('sharefolder', 'CNX247\API\DriveController@shareFolder');

		Route::post('sharefile', 'CNX247\API\DriveController@shareFile');

		//Route::post('drivecapacity', 'CNX247\API\DriveController@getDriveSize');

		Route::post('deletefolder', 'CNX247\API\DriveController@deleteFolder');

		Route::post('deletefile', 'CNX247\API\DriveController@deleteAttachment');


		Route::post('approvedecline', 'CNX247\API\StreamController@verifyCode');






});

//Route::get('users', 'CNX247\API\usersController@users');
Route::post('upload', 'CNX247\API\StreamController@upload');
Route::post('projectupload', 'CNX247\API\StreamController@projectUpload');
Route::post('uploadreport', 'CNX247\API\StreamController@uploadReport');
//Route::post('uploadtodrive', 'CNX247\API\DriveController@UploadFile');


