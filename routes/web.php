<?php

use Illuminate\Support\Facades\Route;

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
Route::get('Route',function(){
	echo "Xin chào các bạn";

});
Route::get('Route/{info}',function($info){
	echo "Thông tin của bạn là : ". $info;

});
Route::get('Day/{ngay}',function($ngay){
	echo "Hôm nay là : ".$ngay;
})->where(['ngay' =>'[a-zA-Z]+']);
//Dinh Danh

Route::get('Route1',['as'=>'My route 1',function(){
	echo "xin chào các bạn";
}]);	

Route::get('Route2',function(){
	echo "Đây là Route2";
})->name('MyRoute2');

Route::get('GoiTen',function(){
	return redirect()-> route('MyRoute2');
});

//Route Group

Route::group(['prefix'=>'MyGroup'],function(){
	Route::get('User1',function(){
		echo "Đây là user1";
	});
	Route::get('User2',function(){
		echo "Đây là user2";
	});
	Route::get('User3',function(){
		echo "Đây là user3";
	});
});

//Goi Controller
Route::get('GoiController','MyController@XinChao');
Route::get('Thamso/{Ten}','MyController@KhoaHoc');
//Lam viec voi URL

Route::get('MyRequest','MyController@GetURL');

//Gưi nhận dữ liệu vs requet
Route::get('getForm',function(){
	return view('postForm');
});
Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);	
//Cookie
Route::get('setCookie','MyController@setCookie');
Route::get('getCookie','MyController@getCookie');
//uploafFile

Route::get('uploadFile',function(){
	return view('postFile');
});
Route::post('postFile',['as'=>'postFile','uses'=>'MyController@postFile']);