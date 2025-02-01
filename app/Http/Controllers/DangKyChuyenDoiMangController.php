<?php

namespace App\Http\Controllers;

use App\Models\DangKyChuyenDoiMang;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DangKyChuyenDoiMangController extends Controller
{
    // Hiển thị danh sách đăng ký chuyển đổi mạng


    
    public function index()
{
    // Lấy dữ liệu từ cache, nếu không có thì thực hiện logic và lưu lại
    $data = Cache::remember('dangKyChuyenMangIndex', 3600, function () {
        $client = new Client();

        // Tắt xác thực SSL và lấy dữ liệu từ các API
        $responseProvinces = $client->get('https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1', ['verify' => false]);
        $responseDistricts = $client->get('https://vn-public-apis.fpo.vn/districts/getAll?limit=-1', ['verify' => false]);
        $responseWards = $client->get('https://vn-public-apis.fpo.vn/wards/getAll?limit=-1', ['verify' => false]);

        // Chuyển dữ liệu trả về từ JSON thành mảng
        $provinces = json_decode($responseProvinces->getBody(), true)['data']['data'];
        $districts = json_decode($responseDistricts->getBody(), true)['data']['data'];
        $wards = json_decode($responseWards->getBody(), true)['data']['data'];

        // Tạo mảng ánh xạ
        $provinceMap = collect($provinces)->pluck('name', 'code')->toArray();
        $districtMap = collect($districts)->pluck('name', 'code')->toArray();
        $wardMap = collect($wards)->pluck('name', 'code')->toArray();

        // Lấy danh sách đăng ký
        $dangKys = DangKyChuyenDoiMang::all();

        // Trả về tất cả dữ liệu cần cache
        return compact('dangKys', 'provinceMap', 'districtMap', 'wardMap');
    });

    // Giải nén dữ liệu từ cache
    $dangKys = $data['dangKys'];
    $provinceMap = $data['provinceMap'];
    $districtMap = $data['districtMap'];
    $wardMap = $data['wardMap'];

    // Trả về view với dữ liệu
    return view('admin.chuyenmang.index', compact('dangKys', 'provinceMap', 'districtMap', 'wardMap'));
}

    
    

  

    // Lưu thông tin đăng ký chuyển đổi mạng mới
    public function store(Request $request)
{
    // Xác thực dữ liệu đầu vào
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
        'nguoi_gioi_thieu_so_dien_thoai' => 'nullable|string|max:15',
        'nguoi_gioi_thieu_email' => 'nullable|email',
        'nguoi_gioi_thieu_don_vi' => 'nullable|string|max:255',
        'nguoi_gioi_thieu_don_vi_cap_phong' => 'nullable|string|max:255',
    ]);

    // Kiểm tra và xử lý giá trị mặc định nếu cần
    if ($request->nguoi_gioi_thieu_don_vi == '-1') {
        $request->merge(['nguoi_gioi_thieu_don_vi' => null]);
    }

    if ($request->nguoi_gioi_thieu_don_vi_cap_phong == '-1') {
        $request->merge(['nguoi_gioi_thieu_don_vi_cap_phong' => null]);
    }

    // Thêm giá trị cho các trường da_lien_he và các trường logic khác
    $validated['da_lien_he'] = false;
    $validated['ho_tro_thu_tuc'] = false;
    $validated['nhan_ket_qua'] = false;

    // Lưu vào cơ sở dữ liệu
    DangKyChuyenDoiMang::create($validated);

    // Xóa cache liên quan
    Cache::forget('dangKyChuyenMangIndex'); // Key tương ứng với cache trong phương thức index

    // Trả về thông báo thành công
    return redirect()->back()->with('success', 'Đăng ký thành công!');
}


public function toggleLienHe($id)
{
    $dangKy = DangKyChuyenDoiMang::findOrFail($id);
    $dangKy->da_lien_he = !$dangKy->da_lien_he;
    $dangKy->save();

    // Xóa cache liên quan
    Cache::forget('dangKyChuyenMangIndex');

    return response()->json([
        'success' => true,
        'da_lien_he' => $dangKy->da_lien_he,
    ]);
}

public function toggleHoTroThuTuc($id)
{
    $dangKy = DangKyChuyenDoiMang::findOrFail($id);
    $dangKy->ho_tro_thu_tuc = !$dangKy->ho_tro_thu_tuc;
    $dangKy->save();

    // Xóa cache liên quan
    Cache::forget('dangKyChuyenMangIndex');

    return response()->json([
        'success' => true,
        'ho_tro_thu_tuc' => $dangKy->ho_tro_thu_tuc,
    ]);
}

public function toggleNhanKetQua($id)
{
    $dangKy = DangKyChuyenDoiMang::findOrFail($id);
    $dangKy->nhan_ket_qua = !$dangKy->nhan_ket_qua;
    $dangKy->save();

    // Xóa cache liên quan
    Cache::forget('dangKyChuyenMangIndex');

    return response()->json([
        'success' => true,
        'nhan_ket_qua' => $dangKy->nhan_ket_qua,
    ]);
}


public function search(Request $request)
{
    // Lấy thông tin tìm kiếm từ request
    $phone = $request->get('phone');
    $email = $request->get('email');

    // Lọc danh sách theo số điện thoại hoặc email
    $dangKys = DangKyChuyenDoiMang::query()
        ->when($phone, function($query, $phone) {
            return $query->where('so_dien_thoai', 'like', '%' . $phone . '%');
        })
        ->when($email, function($query, $email) {
            return $query->where('email', 'like', '%' . $email . '%');
        })
        ->get();

    // Lấy dữ liệu provinces, districts, wards từ bộ nhớ đệm (cache)
    $provinceMap = Cache::get('provinces');
    $districtMap = Cache::get('districts');
    $wardMap = Cache::get('wards');

    // Trả về kết quả tìm kiếm dưới dạng HTML cùng dữ liệu từ cache
    return view('admin.chuyenmang.table', compact('dangKys', 'provinceMap', 'districtMap', 'wardMap'))->render();
}




}
