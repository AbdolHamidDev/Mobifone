<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goidata extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_data', 'gia', 'thoi_gian', 'dung_luong', 'don_vi_dung_luong', 'status', 'loai_data'
    ];


    public function details()
    {
        return $this->hasMany(GoiDataDetail::class, 'goidata_id');
    }


    public function registrations()
{
    return $this->hasMany(PackageRegistration::class, 'package_id', 'id');
}


}
