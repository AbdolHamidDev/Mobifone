<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiVoipCuocPhi extends Model {
    use HasFactory;

    protected $table = 'goi_voip_cuoc_phi';

    protected $fillable = [
        'quoc_gia_id',
        'nhom_cuoc',
        'ma_vung',
        'block_6s_dau',
        'gia_moi_giay',
        'gia_1_phut_dau',
        'gia_1_phut_tiep_theo'
    ];

    // Liên kết với bảng quoc_gia
    public function quocGia() {
        return $this->belongsTo(QuocGia::class, 'quoc_gia_id');
    }
}
