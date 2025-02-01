<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $table = 'cv';

    protected $fillable = [
        'họ_và_tên',
        'cv_hồ_sơ',
        'trình_độ',
        'email',
        'số_điện_thoại',
        'trường_học',
        'ngành_nghề',
        'biết_thông_tin_từ_đâu',
        'tóm_tắt_kinh_nghiệm',
        'đã_xem',
        'đã_duyệt',
    ];
}
