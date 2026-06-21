<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GoicuocDetail extends Model
{
    use HasFactory;

    protected $fillable = ['goicuoc_id', 'key', 'value'];

    // Liên kết với Goicuoc
    public function goicuoc()
    {
        return $this->belongsTo(GoiCuoc::class, 'goicuoc_id', 'id');
    }
}
