<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //
    protected $table = "sanpham"; //protected $table = "tên bảng bạn muốn liên kết"
    public $timestamps = false;

    public function loaisanpham(){
    	return $this->belongsTo('App\LoaiSanPham','id_loaisanpham','id');
    }
}
