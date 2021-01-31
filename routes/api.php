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
    Route::post('roles', 'RoleController@store');
    Route::put('roles/{role}', 'RoleController@update');
    Route::delete('roles/{role}', 'RoleController@delete');

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
    Route::post('surveys', 'SurveyController@store');
    Route::post('surveys/complete', 'SurveyController@storeComplete');
    Route::put('surveys/{survey}', 'SurveyController@update');
    Route::put('surveys/complete/{survey}', 'SurveyController@updateComplete');
    Route::delete('surveys/{survey}', 'SurveyController@delete');

    // OpenQuestions Routes
    Route::get('open_questions', 'OpenQuestionController@index');
    Route::get('open_questions/{openQuestion}', 'OpenQuestionController@show');
    Route::get('open_questions/from-survey/{surveyID}', 'OpenQuestionController@showFromSurvey');
    Route::post('open_questions', 'OpenQuestionController@store');
    Route::put('open_questions/{openQuestion}', 'OpenQuestionController@update');
    Route::delete('open_questions/{openQuestion}', 'OpenQuestionController@delete');

    // MultiplechoiceQuestions Routes
    Route::get('multi_questions', 'MultiplechoiceQuestionController@index');
    Route::get('multi_questions/{multiplechoiceQuestion}', 'MultiplechoiceQuestionController@show');
    Route::get('multi_questions/from-survey/{surveyID}', 'MultiplechoiceQuestionController@showFromSurvey');
    Route::post('multi_questions', 'MultiplechoiceQuestionController@store');
    Route::put('multi_questions/{multiplechoiceQuestion}', 'MultiplechoiceQuestionController@update');
    Route::delete('multi_questions/{multiplechoiceQuestion}', 'MultiplechoiceQuestionController@delete');

    // MultipleChoiceItems Routes
    Route::get('multi_items', 'MultiplechoiceItemController@index');
    Route::get('multi_items/{multiplechoiceItem}', 'MultiplechoiceItemController@show');
    Route::get('multi_items/from-question/{questionID}', 'MultiplechoiceItemController@showFromQuestion');
    Route::post('multi_items', 'MultiplechoiceItemController@store');
    Route::put('multi_items/{multiplechoiceItem}', 'MultiplechoiceItemController@update');
    Route::delete('multi_items/{multiplechoiceItem}', 'MultiplechoiceItemController@delete');

    // Answers Routes
    Route::get('answers', 'AnswerController@index');
    Route::get('answers/{answer}', 'App\Http\Controllers\AnswerController@show');
    Route::post('answers', 'App\Http\Controllers\AnswerController@store');
    Route::put('answers/{answer}', 'AnswerController@update');
    Route::delete('answers/{answer}', 'AnswerController@delete');
});





