<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('basic-get', function(){
    return '基本路由：get';
});

Route::post('basic-post', function(){
    return '基本路由：post';
});

Route::match(['get', 'post'], 'multi', function(){
    return '多请求路由： match';
});

Route::any('multi1', function(){
    return '多请求路由：any， 响应所有类型的请求';
});

Route::get('user-id/{id}', function($id){
    return '路由参数: '. $id.', 请求参数必选';
});

Route::get('user-name/{name?}', function($name='feihu1996'){
    return '路由参数: '. $name.', 请求参数可选';
});

Route::get('user-nickname/{nickname?}', function($nickname='feihu1996'){
    return '路由参数: '. $nickname.', 请求参数正则匹配';
})->where('nickname', '[A-Za-z]+');

Route::get('user-id-name/{id}/{name?}', function($id, $name='feihu1996'){
    return '路由参数: '."$id, ". $name.', 请求参数正则匹配, 多个请求参数';
})->where(['name'=>'[A-Za-z]+', 'id'=>'[0-9]+']);

Route::get('user/center', ['as'=>'user-center', function(){
    return "路由别名：".route('user-center');
}]);

Route::group(['prefix'=>'life'], function(){
    Route::get('eat', function(){
        return '路由群组：/life/eat';
    });
    Route::get('drink', function(){
        return '路由群组：/life/drink';
    });        
});

Route::get('view', function(){
    // 在路由中输出视图
    return view('welcome');
});

// 路由关联控制器，控制器输出视图
// Route::get('test/info', 'TestController@info');
// Route::get('test/info', ['uses' => 'TestController@info']);
// Route::any('test/info', [
    // 'uses' => 'TestController@info',
    // 'as' => 'test-info'  // 为路由起别名
// ]);
// Route::get('test/info/{id}', 'TestController@info');  // 请求参数绑定
// Route::get(
//     'test/info/{id}', 
//     'TestController@info'
// )->where('id', '[0-9]+');  // 请求参数正则匹配

// 数据库操作之DB facade
Route::get('test-db-facade', ['uses' => 'StudentController@test_db_facade']);

// 数据库操作之查询构造器
Route::get('test-query-builder', ['uses' => 'StudentController@test_query_builder']);

// 数据库操作之Eloquent ORM
Route::get('test_eloquent_orm', ['uses' => 'StudentController@test_eloquent_orm']);

// Blade模板引擎
Route::get('test_blade_engine', ['uses' => 'StudentController@test_blade_engine']);
