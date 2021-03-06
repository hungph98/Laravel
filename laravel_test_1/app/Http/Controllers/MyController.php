<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MyController extends Controller
{
    public function XinChao($value='')
    {
    	echo "Xin chào các bạn";
    }
    public function khoahoc($ten)
    {
    	echo "Khóa học đó là : ". $ten;

    }
    public function GetURL(Request $request)
    {
    	//return $request->path();
    	//return $request->url();
    	// if($request->isMethod('post'))
    	// 	echo "Phương thức post";
    	// else
    	// 	echo "Không phải phương thức post";
    	if ($request->is('My*')) {
    		echo "Có My";
    	}else
    		echo "Không có My";
    }
    public function postForm(Request $request)
    {
    	echo "Tên của bạn là :";
    	echo $request->HoTen;
    }
    public function setCookie()
    {
    	$response = new Response();
    	$response->withCookie('Khoahoc','Laravel - Hoang Hung',1);
    	return $response;
    }
    public function getCookie(Request $request)
    {
    	return $request->cookie('Khoahoc');
    }
    public function postFile(Request $request)
    {
    	if($request->hasFile('myFile'))
    	{
    		$file = $request->file('myFile');
    		if($file->getClientOriginaExtension('myFile') == "JPG"){
    			$filename = $file->getClientOriginalName('myFile');
    			$file->move('img',$filename);
    			echo "Đã lưu file ". $filename;
    		}else{
    			echo "Không được phép upload file ";
    		}
    	}else{
    		echo "Chua co File";
    	}
    }
    public function getJson()
    {
    	$array = array('Laravel','PHP','ASP.net','Html');
    	return response()->json($array);
    }
    public function myView()
    {
    	return view('myView');
    }
    public function Time($t)
    {
    	return view('myView',['t'=>$t]);
    }
    public function blade($str)
    {
        $KhoaHoc = "Laravel - Khoa Pham";
        if ($str == "Laravel") {
            return view('pages.laravel',['KhoaHoc'=>$KhoaHoc]);
        }elseif ($str == "php" ) {
            return view('pages.php',['KhoaHoc'=>$KhoaHoc]);
        }
    }
}
