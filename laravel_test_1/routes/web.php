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
//middleware
Route::get('diem',function(){
	echo "Bạn đã có điểm";
})->middleware('MyMiddle')->name('diem');

Route::get('loi',function(){
	echo "Bạn chưa có điểm";
})->name('loi');

Route::get('nhapdiem',function(){
	return view('nhapdiem');
})->name('nhapdiem');
//Auth
Route::get('dangnhap',function(){
	return view('dangnhap');
});
Route::post('login','AuController@login')->name('login');
//session
Route::group(['middleware'=>['web']],function(){
	Route::get('session',function(){
		Session::put('KhoaHoc', 'Laravel');
		Session::put('Laptrinh', 'web');
		echo "Đã cài đặt Session thành công";
		echo "<br>";
		Session::flash('messe','hello');
		echo Session::get('messe');
		//Session::flush();
		//Session::forget('KhoaHoc');
		//echo Session::get('KhoaHoc');
		// if(Session::has('KhoaHoc'))
		// {
		// 	echo "Đã có Session";
		// }else{
		// 	echo "Session không tồn tại";
		// }
	});
	Route::get('Session/flash',function(){
		echo Session::get('messe');
	});
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
 //Query Builder
 Route::get('qb/get', function(){
 	$data = DB::table('users')->get();
 	//var_dump($data);
 	foreach ($data as $row) {
 		foreach ($row as $key => $value) {
 			echo $key.":".$value ."<br>";
 		}
 		echo "<hr>";
 	}
 });
 //select*from users where id = 2
 Route::get('qb/where', function(){
 	$data = DB::table('users')->where('id','=',2)->get();
 	//var_dump($data);
 	foreach ($data as $row) {
 		foreach ($row as $key => $value) {
 			echo $key.":".$value ."<br>";
 		}
 		echo "<hr>";
 	}
 });
 //select id , name, email ...
 Route::get('qb/select',function(){
 	$data = DB::table('users')->select(['id','name','email'])->where('id','=',2)->get();
 	foreach ($data as $row) 
 	{
 		foreach ($row as $key => $value) 
 		{
 			echo $key."=".$value."<br>";
 		}
 		echo"<hr>";
 	}
 });
//select name as hoten from ...
 Route::get('qb/raw',function(){
 	$data = DB::table('users')->select(DB::raw('id , name as hoten, email'))->where('id','=',2)->get();
 	foreach ($data as $row) 
 	{
 		foreach ($row as $key => $value) 
 		{
 			echo $key."=".$value."<br>";
 		}
 		echo"<hr>";
 	}
 });
 //Orderby
 Route::get('qb/orderby',function(){
 	$data = DB::table('users')->select(DB::raw('id , name as hoten, email'))->where('id','>','1')->orderby('id','desc')->skip(1)->take(5)->get();
 	foreach ($data as $row) 
 	{
 		foreach ($row as $key => $value) 
 		{
 			echo $key."=".$value."<br>";
 		}
 		echo"<hr>";
 	}
 });
//
Route::get('qb/update',function(){
	DB::table('users')->where('id',1)->update(['name'=>'Hung','email'=>'hungdz1998@gmail.com']);
	echo "Đã update";
});	
//
Route::get('qb/delete',function(){
	DB::table('users')->truncate();
	echo "Đã xóa";
});
//Truy vấn dữ liệu với Model
Route::get('model/save',function(){
	$user = new App\User();
	$user->name = 'Mai';
	$user->email = 'maimai@gmail.com';
	$user->password = 'Matkhau';
	$user->save();
	echo "đã thực hiện save()";
});

Route::get('model/query',function(){
	$user = App\User::find(4);
	echo $user->name;
});
//Truy vấn dữ liệu với Model
Route::get('model/sanpham/save{ten}',function($ten){
	$sanpham = new App\SanPham();

	$sanpham->ten = $ten;
	$sanpham->soluong = 100;
	$sanpham->save();

	echo "Đã thực hiện save";
});
//Trả dữ liệu về kiểu Json
Route::get('model/sanpham/all',function(){
	//$sanpham = App\User::all()->toJson();
	$sanpham = App\SanPham::all()->toArray();//Trả dữ liệu về kiểu array
	var_dump($sanpham);
});
//kết hơp model với query build
Route::get('model/sanpham/ten',function(){
	$sanpham = App\SanPham::where('ten','Latop')->get()->toArray();
	var_dump($sanpham);
});
//Xóa model
Route::get('model/sanpham/delete',function(){
	App\SanPham::destroy(4);
	echo "Đã xóa";
});
//Tạo thêm cột cho bảng san pham
Route::get('taocot',function(){
	Schema::table('sanpham',function($table){
		$table->integer('id_loaisanpham')->unsigned();
	});
});
//Liên kết dữ liệu trong model
Route::get('lienket',function(){
	$data = App\SanPham::find(2)->loaisanpham->toArray();
	var_dump($data);

});
Route::get('lienketloaisanpham',function(){
	$data = App\LoaiSanPham::find(1)->SanPham->toArray();
	var_dump($data);
});
//middleware
Route::get('diem',function(){
	echo "Bạn đã có điểm";
})->middleware('MyMiddle');
Route::get('loi',function(){
	echo "Bạn chưa có điểm";
})->name('loi');