<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuyenDung extends Model
{
    protected $table = 'tuyendung'; // Đặt tên bảng
    protected $fillable = ['vi_tri', 'mo_ta', 'yeu_cau', 'luong', 'thoi_gian_ung_tuyen'];
}

