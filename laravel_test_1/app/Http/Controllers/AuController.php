<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuController extends Controller
{
    //
    public function login(Request $request)
    {
    	$username = $request['username'];
    	$password = $request['password'];
    	if(Auth::attempt(['name'=>$username,'password'=>$password]))
    	{
    		return view('thanhcong',['user'=>Auth::user()]);
    	}else
    	{
    		return view('dangnhap',['error'=>'Đăng nhập thất bại']);
    	}
    }
}
