<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaKhaiThac extends Model {
    use HasFactory;
    protected $table = 'nha_khai_thac';
    protected $fillable = ['ten_nha_khai_thac', 'ma_nha_khai_thac', 'quoc_gia_id'];

    public function quocGia() {
        return $this->belongsTo(QuocGia::class, 'quoc_gia_id');
    }

    public function giaCuoc() {
        return $this->hasMany(GiaCuocQuocTe::class, 'nha_khai_thac_id');
    }
}
