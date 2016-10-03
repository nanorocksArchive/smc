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


Route::group(['middleware'=>['web']],function($app){

        $app->post('/singup',[
            'uses'=>'UserController@postSingUp',
            'as'=>'singup'
        ]);

        $app->post('/signin',[
            'uses'=>'UserController@postSingIn',
            'as'=>'signin'
        ]);

        $app->get('/', function () {
            return view('welcome');
        });


        $app->get('/dashboard',[
            'uses'=>'PostController@getDashboard',
            'as'=>'dashboard',
        ])->middleware('auth');

        $app->get('/login', function () {
            return redirect('/');
        });

        $app->post('/createpost',[
            'uses'=>'PostController@postCreatePost',
            'as'=>'post_create'
        ]);

        $app->get('/post-delete/{post_id}',[
            'uses'=>'PostController@getDeletePost',
            'as'=>'post.delete'
        ]);

        $app->get('/logout',[
            'uses'=>'UserController@getLogout',
            'as'=>'post.logout'
        ]);

        $app->post('/edit',[
            'uses'=>'PostController@postEditPost',
            'as'=>'edit'
        ]);

        $app->get('/account',[
        'uses'=>'UserController@getAccountUser',
        'as'=>'account.get'
         ]);

        $app->post('/account/store',[
            'uses'=>'UserController@postAccountUser',
            'as'=>'account.save'
        ]);

        $app->get('/userimg/{filename}',[
            'uses'=>'UserController@getUserImage',
            'as'=>'account.image'
        ]);

        $app->post('/like',[
            'uses'=>'UserController@postUserLike',
            'as'=>'like'
        ]);

});
