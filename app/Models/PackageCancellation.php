<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCancellation extends Model
{
    use HasFactory;

    // Khai báo bảng liên kết
    protected $table = 'package_cancellations';

    protected $fillable = [
        'registration_id',
        'phone_number',
        'package_name',
        'package_price',
        'type',
        'cancel_reason',
        'cancel_by',
        'cancelled_at',
    ];
    

    // Quan hệ với bảng PackageRegistration
    public function registration()
    {
        return $this->belongsTo(PackageRegistration::class, 'registration_id');
    }
}
