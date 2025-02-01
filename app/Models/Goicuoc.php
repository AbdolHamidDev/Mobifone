<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goicuoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_goicuoc', 'gia', 'thoi_gian', 'dung_luong', 'don_vi_dung_luong', 'status', 'loai_goicuoc'
    ];


     // Liên kết với GoicuocDetail
     public function details()
{
    return $this->hasMany(GoicuocDetail::class, 'goicuoc_id', 'id');
}

public function orders()
{
    return $this->hasMany(Order::class, 'goi_cuoc_id');
}

}
