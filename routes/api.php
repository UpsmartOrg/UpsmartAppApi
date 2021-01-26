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
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');

    // Authenticated routes
    Route::middleware('auth:api')->group(function () {
        //Logging out
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');

        //Routes met authentication komen uiteindelijk hier
    });

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
    Route::put('users/{user}', 'UserController@update')->middleware('api.admin');
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
    Route::get('surveys/{survey}', 'SurveyController@show');
    Route::get('surveys/complete/{survey}', 'SurveyController@showComplete');
    Route::post('surveys', 'SurveyController@store');
    Route::put('surveys/{survey}', 'SurveyController@update');
    Route::delete('surveys/{survey}', 'SurveyController@delete');

    // OpenQuestions Routes
    Route::get('open_questions', 'OpenQuestionController@index');
    Route::get('open_questions/{openQuestion}', 'OpenQuestionController@show');
    Route::post('open_questions', 'OpenQuestionController@store');
    Route::put('open_questions/{openQuestion}', 'OpenQuestionController@update');
    Route::delete('open_questions/{openQuestion}', 'OpenQuestionController@delete');

    // MultiplechoiceQuestions Routes
    Route::get('multi_questions', 'MultipleChoiceQuestionController@index');
    Route::get('multi_questions/{multiplechoiceQuestion}', 'MultipleChoiceQuestionController@show');
    Route::post('multi_questions', 'MultipleChoiceQuestionController@store');
    Route::put('multi_questions/{multiplechoiceQuestion}', 'MultipleChoiceQuestionController@update');
    Route::delete('multi_questions/{multiplechoiceQuestion}', 'MultipleChoiceQuestionController@delete');

    // MultipleChoiceItems Routes
    Route::get('multi_items', 'MultipleChoiceItemController@index');
    Route::get('multi_items/{multiplechoiceItem}', 'MultipleChoiceItemController@show');
    Route::post('multi_items', 'MultipleChoiceItemController@store');
    Route::put('multi_items/{multiplechoiceItem}', 'MultipleChoiceItemController@update');
    Route::delete('multi_items/{multiplechoiceItem}', 'MultipleChoiceItemController@delete');

    // ConductedSurveys Routes
    Route::get('conducted_surveys', 'ConductedSurveyController@index');
    Route::get('conducted_surveys/{conductedSurvey}', 'ConductedSurveyController@show');
    Route::post('conducted_surveys', 'ConductedSurveyController@store');
    Route::put('conducted_surveys/{conductedSurvey}', 'ConductedSurveyController@update');
    Route::delete('conducted_surveys/{conductedSurvey}', 'ConductedSurveyController@delete');

    // Answers Routes
    Route::get('answers', 'AnswerController@index');
    Route::get('answers/{answer}', 'AnswerController@show');
    Route::post('answers', 'AnswerController@store');
    Route::put('answers/{answer}', 'AnswerController@update');
    Route::delete('answers/{answer}', 'AnswerController@delete');
});





