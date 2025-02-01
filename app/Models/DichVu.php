<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    
    use HasFactory;
    protected $table = 'dichvus';
    
    protected $fillable = ['ten_dich_vu', 'anh', 'noi_dung', 'loai_dich_vu'];


    public function dichvuChitiet()
    {
        return $this->hasOne(DichvuChitiet::class, 'dichvu_id');
    }
}
