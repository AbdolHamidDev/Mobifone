<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageRegistration extends Model
{
    // Đảm bảo bảng chính xác
    protected $table = 'package_registrations'; // Tên bảng trong cơ sở dữ liệu

    // Các cột được phép điền dữ liệu
    protected $fillable = [
        'phone_number',
        'package_id',
        'type',
        'created_at',
    ];
    public function goicuoc()
    {
        return $this->belongsTo(GoiCuoc::class, 'package_id');
    }

    public function goiData()
    {
        return $this->belongsTo(GoiData::class, 'package_id');
    }

    public function package()
    {
        if ($this->type === 'goicuoc') {
            return $this->belongsTo(GoiCuoc::class, 'package_id');
        } elseif ($this->type === 'goidata') {
            return $this->belongsTo(GoiData::class, 'package_id');
        }
        return null;
    }


}
