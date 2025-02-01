<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichvuChitiet extends Model
{
    use HasFactory;

    protected $table = 'dichvu_chitiet';

    protected $fillable = [
        'dichvu_id',
        'doi_tuong_su_dung',
        'tinh_nang_chinh',
        'quy_dinh',
        'tien_ich',
    ];

    // Quan hệ với Dichvus
    public function dichvu()
    {
        return $this->belongsTo(DichVu::class, 'dichvu_id');
    }
}
