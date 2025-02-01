<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'so_thue_bao_id',
        'goi_cuoc_id',
    ];
}
