<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiDataDetail extends Model
{
    protected $table = 'goidata_details';

    use HasFactory;

    protected $fillable = [
        'goidata_id',
        'key',
        'value',
    ];

    public function goidata()
    {
        return $this->belongsTo(GoiData::class, 'goidata_id');
    }
}
