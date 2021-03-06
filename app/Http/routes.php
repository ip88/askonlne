<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web']], function () {
    Route::auth();


    Route::get('/', function () { //dd(\Auth::id());
        if (\Auth::id()==null)
            return redirect(\URL::action('Auth\AuthController@showLoginForm'));
        elseif (\Auth::id()==1)
            return redirect(\URL::action('AdminController@getIndex'));
        else
            return redirect(\URL::action('UserController@getIndex'));
    });

    Route::controllers([
        'admin' => 'AdminController',
        'user' => 'UserController',
        '' => 'Auth\AuthController',
    ]);
});

//Route::auth();

//
