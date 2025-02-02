<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'so_thue_bao_id',
        'goi_cuoc_id',
        'sim_type',
        'customer_name',
        'phone',
        'email',
        'province',
        'district',
        'ward',
        'address',
        'delivery_method',
        'payment_method',
        'activation_fee',
        'package_price',
        'shipping_fee',
        'total_amount',
        'trang_thai',
        'da_nhan_hang',
        'qr_code',
        'order_code',
    ];

    // Quan hệ với bảng goicuocs
    public function goiCuoc()
    {
        return $this->belongsTo(GoiCuoc::class, 'goi_cuoc_id');
    }

    // Quan hệ với bảng so_thue_bao
    public function soThueBao()
    {
        return $this->belongsTo(SoThueBao::class, 'so_thue_bao_id');
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            if (empty($order->order_code)) {
                $order->order_code = 'ORD-' . Str::upper(Str::random(8));
            }
        });
    }
}
