<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'image',
        'is_approved',
        'subscription_category',
    ];

    public function loaithuebao()
    {
        return $this->hasMany(LoaiThueBao::class, 'subscription_type_id', 'id');
    }
    
    

}
