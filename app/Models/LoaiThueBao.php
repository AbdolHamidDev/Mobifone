<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiThueBao extends Model
{
    use HasFactory;

    protected $table = 'loaithuebao';

    protected $fillable = [
        'subscription_type_id',
        'benefits',
        'pricing',
        'instructions',
    ];

    public function subscriptionType()
{
    return $this->belongsTo(SubscriptionType::class);
}
    
}
