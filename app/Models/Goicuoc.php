<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoiCuoc extends Model
{
    protected $fillable = [
        'ten_goicuoc',
        'gia',
        'thoi_gian',
        'dung_luong',
        'don_vi_dung_luong',
        'status',
        'loai_goicuoc',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(GoicuocDetail::class, 'goicuoc_id');
    }
}