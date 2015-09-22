<?php

use Kodeine\Acl\Models\Eloquent\Permission;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

Route::get('/test', function(){


});

Route::group(['middleware' =>['auth','acl']], function(){

    Route::get('/', 'DashboardController@index');


    Route::get('/setsite/{id}',function($id){
        Session::put('site', $id);
        Cookie::queue(Cookie::make('mango_currrent_site', $id, 43200));
        return Redirect::back();
    });

    Route::get('/dashboard','DashboardController@index');

    Route::get('/calendar/press/json','CalendarController@pressData');
    Route::get('/calendar/{id}/move','CalendarController@move');
    Route::get('/calendar/{id}/resize','CalendarController@resize');

    Route::group(['prefix'=>'admin', 'is'=>'super_admin'], function(){
        Route::get('roles/{id}/permissions','RolesController@permissions');
        Route::post('roles/{id}/permissions','RolesController@permissionsStore');
        Route::resource('roles','RolesController');
        Route::resource('permissions','PermissionsController');
        Route::resource('sites','SitesController');
    });


    Route::group(['prefix'=>'press'], function(){
        Route::get('calendar','CalendarController@press');
    });

    /* user routes */
    Route::get('/config/users/{id}/roles','UserController@roles');
    Route::post('/config/users/{id}/roles','UserController@rolesStore');
    Route::get('/config/users/{id}/permissions','UserController@permissions');
    Route::post('/config/users/{id}/permissions','UserController@permissionsStore');
    Route::get('/config/users/{id}/sites','UserController@sites');
    Route::post('/config/users/{id}/sites','UserController@sitesStore');
    Route::resource('/config/users', 'UserController');

});

Route::get('/chat/broadcast', function(){

    $payload['message']="This is a test message";
    $payload['room']="test";
    event(new \App\Events\ChatMessage($payload));
    return response('Message was sent');
});
Route::post('/chat/broadcast', function(Request $request){

    $payload['room']=$request->channel;
    $payload['message']=$request->message;

    event(new \App\Events\ChatMessage($payload));
    return response()->json(['message' => 'Message sent', 'payload'=> $payload]);
});

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::post('/auth/register', 'Auth\AuthController@postRegister');

Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');