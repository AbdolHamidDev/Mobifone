<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Đảm bảo các trường được phép gán giá trị
    protected $fillable = [
        'name',         // Tên vai trò
        'display_name', // Mô tả vai trò
    ];
    //
    public function users()
{
    return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
}

}
