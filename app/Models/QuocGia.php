<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model {
    use HasFactory;
    protected $table = 'quoc_gia'; 
    protected $fillable = ['ten_quoc_gia', 'ma_quoc_gia', 'co_quoc_gia'];

    public function nhaKhaiThac() {
        return $this->hasMany(NhaKhaiThac::class, 'quoc_gia_id');
    }
}
