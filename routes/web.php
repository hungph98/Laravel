<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;

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
//JSON

Route::get('getJson','MyController@getJson');
//View

Route::get('myView','MyController@myView');
//Truyền dữ liệu trên View

Route::get('Time/{t}','MyController@Time');
//Dùng chung dữ liệu trên View

View::share('KhoaHoc','Laravel');
//Blade template
 Route::get('blade', function(){
 	return view('pages.laravel');
 });

 Route::get('BladeTemplate/{$str}','MyController@blade');	

 //DB Schema
 Route::get('database',function(){
 	// Schema::create('loaisanpham',function($table){
 	// 	$table->increments('id');
 	// 	$table->string('ten',200);
 	// });
 	Schema::create('TheLoai',function($table){
 		$table->increments('id');
 		$table->string('ten',200)->nullable;
 		$table->string('nhasanxuat')->default('nhasanxuat');
 	});

 	echo "Đã thực hiện lệnh tạo bảng";
 });
 //Chinh sủa bảng vơi Schema
 Route::get('lienketbang',function(){
 	Schema::create('sanpham',function($table){
 		$table->increments('id');
 		$table->string('ten');
 		$table->float('Gia');
 		$table->integer('soluong')->default(0);
 		$table->integer('id_loaisanpham')->unsigned();
 		$table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
 	});

 	echo "Đã tạo bảng sản phẩm";
 });

 Route::get('suabang',function(){
 	Schema::table('TheLoai',function($table){
 		$table->dropColumn('nhasanxuat');
 	});
 });

 Route::get('themcot',function(){
 	Schema::table('Theloai',function($table){
 		$table->string('Email');
 	});
 	echo "Đã thêm cột Email";
 });
 Route::get('doiten',function(){
 	Schema::rename('TheLoai', 'Nguoidung');
 	echo "Đã đổi tên bảng";
 });

 Route::get('xoabang',function(){
 	//Schema::drop('nguoidung');
 	Schema::dropIfExists('nguoidung');
 	echo "Đã xóa bảng";
 });