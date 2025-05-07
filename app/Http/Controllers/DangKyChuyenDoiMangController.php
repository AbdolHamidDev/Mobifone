<?php

namespace App\Http\Controllers;

use App\Models\DangKyChuyenDoiMang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DangKyChuyenDoiMangController extends Controller
{
    // Hiển thị danh sách đăng ký chuyển đổi mạng
    public function index()
    {
        // Lấy dữ liệu từ cache hoặc thực hiện logic và lưu lại
        $data = Cache::remember('dangKyChuyenMangIndex', 3600, function () {
            return [
                'dangKys' => DangKyChuyenDoiMang::all(),
                'provinceMap' => $this->fetchData('https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1'),
                'districtMap' => $this->fetchData('https://vn-public-apis.fpo.vn/districts/getAll?limit=-1'),
                'wardMap' => $this->fetchData('https://vn-public-apis.fpo.vn/wards/getAll?limit=-1'),
            ];
        });

        return view('admin.chuyenmang.index', $data);
    }

    // Lưu thông tin đăng ký chuyển đổi mạng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'email' => 'nullable|email',
            'tinh_thanh_pho' => 'required|string|max:255',
            'quan_huyen' => 'required|string|max:255',
            'xa_phuong' => 'required|string|max:255',
            'dia_chi_lien_he' => 'required|string|max:255',
            'hinh_thuc_xu_ly' => 'required|in:tai_dia_chi_dang_ky,den_cua_hang',
            'nguoi_gioi_thieu_ho_ten' => 'nullable|string|max:255',
            'nguoi_gioi_thu_so_dien_thoai' => 'nullable|string|max:15',
            'nguoi_gioi_thieu_email' => 'nullable|email',
            'nguoi_gioi_thieu_don_vi' => 'nullable|string|max:255',
            'nguoi_gioi_thieu_don_vi_cap_phong' => 'nullable|string|max:255',
        ]);

        $validated['da_lien_he'] = false;
        $validated['ho_tro_thu_tuc'] = false;
        $validated['nhan_ket_qua'] = false;

        DangKyChuyenDoiMang::create($validated);

        Cache::forget('dangKyChuyenMangIndex');

        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }

    // Toggle trạng thái
    public function toggleStatus($id, $field)
    {
        $dangKy = DangKyChuyenDoiMang::findOrFail($id);
        $dangKy->$field = !$dangKy->$field;
        $dangKy->save();

        Cache::forget('dangKyChuyenMangIndex');

        return response()->json([
            'success' => true,
            $field => $dangKy->$field,
        ]);
    }

    public function toggleLienHe($id)
    {
        return $this->toggleStatus($id, 'da_lien_he');
    }

    public function toggleHoTroThuTuc($id)
    {
        return $this->toggleStatus($id, 'ho_tro_thu_tuc');
    }

    public function toggleNhanKetQua($id)
    {
        return $this->toggleStatus($id, 'nhan_ket_qua');
    }

   

    // Helper function để lấy dữ liệu từ API
    private function fetchData($url)
    {
        return collect(Http::withoutVerifying()->get($url)->json('data.data', []))->pluck('name', 'code')->toArray();
    }
}
