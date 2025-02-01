<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyChuyenDoiMang extends Model
{
    use HasFactory;

    // Định nghĩa bảng nếu tên không theo chuẩn của Laravel
    protected $table = 'dang_ky_chuyen_doi_mang';

    // Các trường có thể gán giá trị hàng loạt
    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'email',
        'tinh_thanh_pho',
        'quan_huyen',
        'xa_phuong',
        'dia_chi_lien_he',
        'hinh_thuc_xu_ly',
        'nguoi_gioi_thieu_ho_ten',
        'nguoi_gioi_thieu_so_dien_thoai',
        'nguoi_gioi_thieu_email',
        'nguoi_gioi_thieu_don_vi',
        'nguoi_gioi_thieu_don_vi_cap_phong',
        'da_lien_he',
        'ho_tro_thu_tuc', 
        'nhan_ket_qua',
    ];



    // Định nghĩa Accessor
    
    public function getNguoiGioiThieuDonViAttribute($value) {
        $donViMapping = [
            1 => 'Cơ quan TCT',
            2 => 'Ban QLHT 1',
            3 => 'Ban QLHT 2',
            4 => 'Ban QLHT 3',
            5 => 'Ban QLDAKT 1',
            6 => 'Ban QLDAKT 2',
            7 => 'CTKV 1',
            8 => 'CTKV 2',
            9 => 'CTKV 3',
            10 => 'CTKV 4',
            11 => 'CTKV 5',
            12 => 'CTKV 6',
            13 => 'CTKV 7',
            14 => 'CTKV 8',
            15 => 'CTKV 9',
            16 => 'Trung tâm VTQT',
            17 => 'Trung tâm MVAS',
            18 => 'Trung tâm CNTT',
            19 => 'Trung tâm NOC',
            20 => 'Trung tâm MLMB',
            21 => 'Trung tâm MLMT',
            22 => 'Trung tâm MLMN',
            23 => 'Trung tâm DK&SC TBVT',
            24 => 'Trung tâm TC&TK',
            25 => 'Trung tâm R&D',
            26 => 'Trung tâm TVTK',
            27 => 'Công ty MobiFone Global',
            28 => 'Công ty MobiFone Plus',
            29 => 'Công ty MobiFone Service',
        ];
        return $donViMapping[$value] ?? 'Không xác định';
    }

    public function getNguoiGioiThieuDonViCapPhongAttribute($value) 
      {
        $capPhongMapping = [
            1 => 'Khu vực 1 - Hà Nội',
            2 => 'Khu vực 2 - TP. Hồ Chí Minh',
            3 => 'Khu vực 3 - Đà Nẵng',
            4 => 'Khu vực 4 - Phú Thọ',
            5 => 'Khu vực 5 - Hải Phòng',
            6 => 'Khu vực 6 - Nghệ An',
            7 => 'Khu vực 7 - Đắk Lắk',
            8 => 'Khu vực 8 - Đồng Nai',
            9 => 'Khu vực 9 - TP. Cần Thơ',
            10 => 'Khu vực 10 - An Giang',
        ];
    
        return $capPhongMapping[$value] ?? 'Không xác định';
    }
   
    
    
}
