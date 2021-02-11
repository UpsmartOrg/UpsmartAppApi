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

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        //Logging out
        Route::post('/logout', 'Auth\AuthController@logout')->name('logout.api');

        //Routes met authentication komen uiteindelijk hier
    });

    Route::post('change-password', 'Auth\ResetPasswordController@resetPassword');

    // Roles Routes

    Route::get('roles', 'RoleController@index');
    Route::get('roles/{role}', 'RoleController@show');

    // {object} i.p.v {id} zet ID automatisch om naar een object. Indien object niet bestaat -> 404
    // localhost:8000/api/users/1 -> returns user met ID 1, als hij niet bestaat returnt het 404

    // Users Routes
    Route::get('users', 'UserController@index');
    Route::get('users/withroles', 'UserController@indexWithRoles');
    Route::get('users/{user}', 'UserController@show');
    Route::get('users/withroles/{user}', 'UserController@showWithRoles');

    Route::post('users', 'UserController@store');
    Route::post('users/withroles', 'UserController@storeWithRoles');
    Route::put('users/{user}', 'UserController@update');
    Route::put('users/withroles/{user}', 'UserController@updateWithRoles');
    Route::delete('users/{user}', 'UserController@delete');

    // UserRoles Routes
    Route::get('userroles', 'UserRoleController@index');
    Route::get('userroles/{userRole}', 'UserRoleController@show');
    Route::post('userroles', 'UserRoleController@store');
    Route::put('userroles/{userRole}', 'UserRoleController@update');
    Route::delete('userroles/{userRole}', 'UserRoleController@delete');

    // Information Routes
    Route::get('information', 'InformationController@index');
    Route::get('information/withUser', 'InformationController@indexUser');
    Route::get('information/{information}', 'InformationController@show');
    Route::post('information', 'InformationController@store');
    Route::put('information/{information}', 'InformationController@update');
    Route::delete('information/{information}', 'InformationController@delete');

    // Surveys Routes
    Route::get('surveys', 'SurveyController@index');
    Route::get('surveys/withuser', 'SurveyController@indexWithUser');
    Route::get('surveys/{survey}', 'SurveyController@show');
    Route::get('surveys/complete/{survey}', 'SurveyController@showComplete');
    Route::post('surveys/complete', 'SurveyController@storeComplete');
    Route::put('surveys/complete/{survey}', 'SurveyController@updateComplete');
    Route::delete('surveys/{survey}', 'SurveyController@delete');

    // OpenQuestions Routes
    Route::get('open_questions/from-survey/{surveyID}', 'OpenQuestionController@showFromSurvey');
    Route::get('open_questions/quick-survey', 'OpenQuestionController@showQuickSurvey');

    // MultiplechoiceQuestions Routes
    Route::get('multi_questions/from-survey/{surveyID}', 'MultiplechoiceQuestionController@showFromSurvey');
    Route::get('multi_questions/quick-survey', 'MultiplechoiceQuestionController@showQuickSurvey');

    // MultipleChoiceItems Routes
    Route::get('multi_items/from-question/{questionID}', 'MultiplechoiceItemController@showFromQuestion');

    // Answers Routes
    Route::get('answers', 'AnswerController@index');
    Route::get('answers/{answer}', 'AnswerController@show');
    Route::post('answers', 'AnswerController@store');
    Route::delete('answers/{answer}', 'AnswerController@delete');

    // Bin Routes
    Route::get('bins', 'BinController@index');

    // Zone Routes
    Route::get('zones', 'ZoneController@index');
    Route::get('zones/withbins', 'ZoneController@indexWithBins');
    Route::get('zones/{zone}', 'ZoneController@show');
    Route::get('zones/withbins/{zone}', 'ZoneController@showWithBins');
    Route::post('zones', 'ZoneController@store');
    Route::put('zones/{zone}', 'ZoneController@update');
    Route::put('zones/bins/{zone}', 'ZoneController@updateZoneBins');
    Route::delete('zones/{zone}', 'ZoneController@delete');

    // Bininfo routes
    Route::get('bininfo', 'BinInfoController@index');
    Route::get('bininfo/byzone/{zone}', 'BinInfoController@indexByZone');
    Route::get('bininfo/nozone', 'BinInfoController@indexNoZone');
    Route::get('bininfo/{binInfo}', 'BinInfoController@show');
    Route::post('bininfo/update', 'BinInfoController@loadNewBins');
    Route::put('bininfo/{binInfo}', 'BinInfoController@update');
    Route::put('bininfo/zone/{binInfo}', 'BinInfoController@updateZone');
    Route::delete('bininfo/{binInfo}', 'BinInfoController@delete');
});





