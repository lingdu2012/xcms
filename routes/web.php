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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('user/show/{id}','UserController@show');
//前台网站系统可以自由开发

//后台管理系统
//登录页面
Route::any('/','SuperloginController@index');
Route::any('superlogin/index','SuperloginController@index');
//退出页面
Route::any('superlogin/out','SuperloginController@out');
//后台首页
Route::get('super/index','SuperController@index')->middleware("checksession");
//账号管理
Route::any('super/uset','SuperController@uset')->middleware("checksession");
//页面配置
Route::any('super/pset','SuperController@pset')->middleware("checksession");
//删除页面
Route::any('super/ajax_pdel','SuperController@ajax_pdel')->middleware("checksession");
//菜单配置
Route::any('super/mset','SuperController@mset')->middleware("checksession");
//动态页面配置
Route::any('super/apage','SuperController@apage')->middleware("checksession");
//动态列表中删除一条记录
Route::any('super/ajax_adel','SuperController@ajax_adel')->middleware("checksession");
//获取页面内容
Route::any('super/ajax_pinfo','SuperController@ajax_pinfo')->middleware("checksession");
//动态页面配置
Route::any('super/apsave','SuperController@apsave')->middleware("checksession");
//清理数据库
Route::any('super/clearDB','SuperController@clearDB')->middleware("checksession");
//删除数据表
Route::any('super/ajax_dbdel','SuperController@ajax_dbdel')->middleware("checksession");
