<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomPackage;
use Yajra\DataTables\Facades\DataTables;


class CustomPackageController extends Controller
{

    public function apiCustomPackages(Request $request)
    {
        $customPackages = CustomPackage::select('custom_packages.*');

        return DataTables::of($customPackages)
            ->addColumn('thoai_noi_mang', function ($package) {
                return $package->thoai_noi_mang . ' phút';
            })
            ->addColumn('thoai_ngoai_mang', function ($package) {
                return $package->thoai_ngoai_mang . ' phút';
            })
            ->addColumn('dung_luong', function ($package) {
                return $package->dung_luong . ' GB';
            })
            ->addColumn('gia_tien', function ($package) {
                return number_format($package->gia_tien, 0, ',', '.') . ' VNĐ';
            })
            ->addColumn('created_at', function ($package) {
                return $package->created_at->format('d/m/Y H:i');
            })
            ->make(true);
    }

    public function index()
    {
        $packages = CustomPackage::orderBy('created_at', 'desc')->paginate(10); // Phân trang 10 bản ghi

        return view('admin.khachhang_dangky.tutao_goicuoc.index', compact('packages'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|regex:/^0[0-9]{9}$/',
            'thoai_noi_mang' => 'required|integer|min:0|max:60',
            'thoai_ngoai_mang' => 'required|integer|min:0|max:60',
            'dung_luong' => 'required|numeric|min:0.1|max:5',
        ]);

        // Tạo mã gói cước ngẫu nhiên
        $ma_goi_cuoc = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8)); // Ví dụ: ABCD1234

        // Tính giá gói cước
        $gia_tien = ($validated['thoai_noi_mang'] + $validated['thoai_ngoai_mang']) * 1000 + $validated['dung_luong'] * 10000;

        // Lưu vào database
        CustomPackage::create([
            'phone_number' => $validated['phone_number'],
            'ma_goi_cuoc' => $ma_goi_cuoc,
            'thoai_noi_mang' => $validated['thoai_noi_mang'],
            'thoai_ngoai_mang' => $validated['thoai_ngoai_mang'],
            'dung_luong' => $validated['dung_luong'],
            'gia_tien' => $gia_tien,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được tạo thành công!',
            'ma_goi_cuoc' => $ma_goi_cuoc,
            'gia_tien' => number_format($gia_tien, 0, ',', '.') . ' VNĐ',
        ]);
    }
}
