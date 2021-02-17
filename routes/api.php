<?php

use App\Role;
use App\User;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // Authentication routes (public)
    Route::post('/login', 'Auth\AuthController@login')->name('login.api');
    // User routes
    Route::get('users/get/{user}', 'UserController@show');
    Route::get('users/get/{user}/withroles', 'UserController@showWithRoles');
    // Survey routes
    Route::get('surveys', 'SurveyController@index');
    Route::get('surveys/get/{survey}', 'SurveyController@show');
    // Information Routes
    Route::get('information', 'InformationController@index');
    Route::get('information/get/{information}', 'InformationController@show');
    // OpenQuestion Routes
    Route::get('open_questions/from-survey/{surveyID}', 'OpenQuestionController@showFromSurvey');
    Route::get('open_questions/quick-survey', 'OpenQuestionController@showQuickSurvey');
    // MultiplechoiceQuestion Routes
    Route::get('multi_questions/from-survey/{surveyID}', 'MultiplechoiceQuestionController@showFromSurvey');
    Route::get('multi_questions/quick-survey', 'MultiplechoiceQuestionController@showQuickSurvey');
    // MultipleChoiceItem Routes
    Route::get('multi_items/from-question/{questionID}', 'MultiplechoiceItemController@showFromQuestion');
    // Answer routes
    Route::post('answers', 'AnswerController@store');

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        // Logging out
        Route::post('/logout', 'Auth\AuthController@logout')->name('logout.api');
        // Changing password
        Route::post('change-password', 'Auth\ResetPasswordController@resetPassword');
        // User routes
        Route::get('users', 'UserController@index');
        Route::put('users/{user}', 'UserController@update');
        // Routes available for authenticated users with role trash
        Route::middleware('api.trash')->group(function () {
            // Bin routes
            Route::get('bins', 'BinController@index');
            // Zone Routes
            Route::get('zones', 'ZoneController@index');
            Route::get('zones/withbins', 'ZoneController@indexWithBins');
            Route::get('zones/get/{zone}', 'ZoneController@show');
            Route::get('zones/get/{zone}/withbins', 'ZoneController@showWithBins');
            Route::post('zones', 'ZoneController@store');
            Route::put('zones/{zone}', 'ZoneController@update');
            Route::put('zones/bins/{zone}', 'ZoneController@updateZoneBins');
            Route::delete('zones/{zone}', 'ZoneController@delete');
            // Bininfo routes
            Route::get('bininfo', 'BinInfoController@index');
            Route::get('bininfo/byzone/{zone}', 'BinInfoController@indexByZone');
            Route::get('bininfo/nozone', 'BinInfoController@indexNoZone');
            Route::get('bininfo/get/{binInfo}', 'BinInfoController@show');
            Route::post('bininfo/update', 'BinInfoController@loadNewBins');
            Route::put('bininfo/update/coords/{binInfo}', 'BinInfoController@updateBinCoordinates');
            Route::put('bininfo/{binInfo}', 'BinInfoController@update');
            Route::put('bininfo/zone/{binInfo}', 'BinInfoController@updateZone');
            Route::delete('bininfo/{binInfo}', 'BinInfoController@delete');
        });

        // Routes available for authenticated users with role trash
        Route::middleware('api.participation')->group(function () {
            // Surveys Routes
            Route::get('surveys/withuser', 'SurveyController@indexWithUser');
            Route::get('surveys/get/{survey}/complete', 'SurveyController@showComplete');
            Route::post('surveys/complete', 'SurveyController@storeComplete');
            Route::put('surveys/complete/{survey}', 'SurveyController@updateComplete');
            Route::delete('surveys/{survey}', 'SurveyController@delete');

            // Answers Routes
            Route::get('answers', 'AnswerController@index');
            Route::get('answers/get/{answer}', 'AnswerController@show');
            Route::delete('answers/{answer}', 'AnswerController@delete');
        });

        // Routes available for authenticated users with role trash
        Route::middleware('api.communication')->group(function () {
            // Information Routes
            Route::get('information/withuser', 'InformationController@indexUser');
            Route::post('information', 'InformationController@store');
            Route::put('information/{information}', 'InformationController@update');
            Route::delete('information/{information}', 'InformationController@delete');
        });

        // Routes available for authenticated users with role trash
        Route::middleware('api.admin')->group(function () {
            // Roles Routes
            Route::get('roles', 'RoleController@index');
            Route::get('roles/get/{role}', 'RoleController@show');
            // Users Routes
            Route::get('users/withroles', 'UserController@indexWithRoles');
            Route::post('users', 'UserController@store');
            Route::post('users/withroles', 'UserController@storeWithRoles');
            Route::put('users/withroles/{user}', 'UserController@updateWithRoles');
            Route::delete('users/{user}', 'UserController@delete');
            // UserRoles Routes
            Route::get('userroles', 'UserRoleController@index');
            Route::get('userroles/get/{userRole}', 'UserRoleController@show');
            Route::post('userroles', 'UserRoleController@store');
            Route::put('userroles/{userRole}', 'UserRoleController@update');
            Route::delete('userroles/{userRole}', 'UserRoleController@delete');
        });
    });
});





