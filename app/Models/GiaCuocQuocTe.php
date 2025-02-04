<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaCuocQuocTe extends Model {
    use HasFactory;
    protected $table = 'gia_cuoc_quoc_te';
    protected $fillable = [
        'quoc_gia_id', 'nha_khai_thac_id', 'loai_thue_bao', 
        'cuoc_goi_trong_mang', 'cuoc_goi_ve_vn', 'cuoc_quoc_te',
        'cuoc_ve_tinh', 'cuoc_nhan_goi', 'cuoc_sms', 'cuoc_data'
    ];

    public function quocGia() {
        return $this->belongsTo(QuocGia::class, 'quoc_gia_id');
    }

    public function nhaKhaiThac() {
        return $this->belongsTo(NhaKhaiThac::class, 'nha_khai_thac_id');
    }
}
