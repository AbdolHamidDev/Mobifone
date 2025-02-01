<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoThueBao extends Model
{
    use HasFactory;

    protected $table = 'so_thue_bao';

    protected $fillable = [
        'so_thue_bao',
        'loai_thue_bao',
        'khu_vuc',
        'phi_hoa_mang',
        'trang_thai',
        'loai_so',
        'phi_giu_so', 
    ];


    public function goicuoc()
{
    return $this->belongsTo(Goicuoc::class, 'goicuoc_id');
}


public function orders()
{
    return $this->hasMany(Order::class, 'so_thue_bao_id');
}


public function isUsed()
{
    return $this->hasOne(Order::class, 'so_thue_bao_id')->exists();
}

    
}
