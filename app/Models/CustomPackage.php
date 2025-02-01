<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'ma_goi_cuoc',
        'thoai_noi_mang',
        'thoai_ngoai_mang',
        'dung_luong',
        'gia_tien',
    ];
}
