<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', 'IndexController@index');
Route::get('/currencies/{coinname}', 'IndexController@currencies');

Route::get('topup', 'IndexController@topup');
Route::get('topdown', 'IndexController@topdown');



Route::get('devi', 'IndexController@indexdev');

Route::get('user/createmember/{mahoa}',
    ['as' => 'user.createmember', 'uses' => 'UserController@createmember']);
Route::post('user/storemember',
    ['as' => 'user.storemember', 'uses' => 'UserController@storemember']);
Route::get('user/storemember', 'UserController@storemember');

Route::get('admcp', 'Auth\AuthController@getLogin');
// Route::get('/', 'Auth\AuthController@getLogin');

Route::group(['middleware' => 'auth'],function () {

    Route::get('home', 'HomeController@index');
   // Route::resource('config', 'ConfigController');
    Route::resource('log', 'LogController');

   Route::get('stockinfo/{stock}/edit','MemberController@editstock'); 

   Route::get('stockinfo/add','MemberController@addstock'); 
   
   Route::post('stockinfo/store',
    ['as' => 'member.storestock', 'member' => 'MemberController@storestock']);

   Route::get('stockinfo/{stockid}/acstatus','MemberController@acstatus'); 

   Route::get('stockinfo/destroy/{id}',
        ['as' => 'stockinfo.destroy', 'stockinfo' => 'MemberController@destroystock']);

    Route::get('member/dashboard',
        ['as' => 'member.dashboard', 'uses' => 'MemberController@dashboard']);

    Route::get('member/active',
        ['as' => 'member.active', 'uses' => 'MemberController@active']);

    Route::get('member/lock',
        ['as' => 'member.lock', 'uses' => 'MemberController@lock']);
   
    Route::get('member/signup',
        ['as' => 'member.signup', 'uses' => 'MemberController@signup']);

    Route::get('member/show/{id}',
        ['as' => 'member.show', 'uses' => 'MemberController@show']);
    //Cuonghm
    Route::get('member/profile/{action}',
        ['as' => 'member.profile', 'uses' => 'MemberController@profile']);
    Route::post('member/update',
        ['as' => 'member.update', 'uses' => 'MemberController@update']);

    Route::post('member/changeloginpass',
        ['as' => 'member.changeloginpass', 'uses' => 'MemberController@changeloginpass']);


    Route::resource('log', 'LogController');
    Route::get('user/{user}/edit2',['as' => 'user.edit2', 'uses' => 'UserController@edit2']);
    Route::get('user/member',['as' => 'user.member', 'uses' => 'UserController@member']);
    Route::get('user/report',['as' => 'user.report', 'uses' => 'UserController@report']);
    Route::resource('user', 'UserController');
});


// Authentication routes...
Route::get('auth/login',
    ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/username', 'Auth\PasswordController@getUsername');
Route::post('password/username', 'Auth\PasswordController@postUsername');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('ajax/ajaxGetMessages', ['as' => 'ajax.ajaxGetMessages', 'uses' => 'MessageController@ajaxGetMessages']);

