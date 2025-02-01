<?php

namespace App\Http\Controllers;

use App\Models\Goidata;
use Illuminate\Http\Request;
use App\Models\PackageRegistration;
use Yajra\DataTables\Facades\DataTables;

class QuanlyDataController extends Controller
{
    
    public function api(Request $request)
    {
        $Goidatas = Goidata::select(['id', 'ten_data', 'gia', 'thoi_gian', 'dung_luong', 'loai_data', 'status', 'created_at']);
    
        return DataTables::of($Goidatas)
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="' . route('Goidatas.edit', $row->id) . '" 
                            class="btn btn-outline-primary btn-sm d-flex align-items-center me-2" 
                            title="Chỉnh sửa">
                            <i class="fas fa-edit me-1"></i> Sửa
                        </a>
                        <button 
                            onclick="confirmDelete(' . $row->id . ')" 
                            class="btn btn-outline-danger btn-sm d-flex align-items-center" 
                            title="Xóa">
                            <i class="fas fa-trash-alt me-1"></i> Xóa
                        </button>
                        <form id="delete-form-' . $row->id . '" 
                            action="' . route('Goidatas.destroy', $row->id) . '" 
                            method="POST" 
                            style="display: none;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                        </form>
                    </div>
                ';
            })
            ->make(true);
    }
    
    
    
    // Danh sách gói cước
    public function index()
    {
        return view('admin.goidatas.danhsach');
    }


    

 

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_data' => 'required|string|max:255',
            'gia' => 'required|numeric|min:0',
            'thoi_gian' => 'required|integer|min:1',
            'dung_luong' => 'required|numeric|min:0',
            'don_vi_dung_luong' => 'required|string|in:MB,GB',
            'loai_data' => 'required|string|max:255',
        ]);

        Goidata::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được thêm thành công.',
        ]);
    }
    

    // Chỉnh sửa gói cước
    public function edit(Goidata $Goidata)
    {
        return view('admin.goidatas.sua', compact('Goidata'));
    }



    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ten_data' => 'required|string|max:255',
            'gia' => 'required|numeric|min:0',
            'thoi_gian' => 'required|integer|min:1',
            'dung_luong' => 'required|numeric|min:0',
            'don_vi_dung_luong' => 'required|string|in:MB,GB',
            'loai_data' => 'required|string|max:255',
        ]);
    
        $Goidata = Goidata::findOrFail($id);
        $Goidata->update($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được cập nhật thành công.',
        ]);
    }

    // Xóa gói cước
    public function destroy($id)
    {
        $Goidata = Goidata::findOrFail($id);
        $Goidata->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được xóa thành công.',
        ]);
    }
    



    // trạng thái gói cước (ngừng bán và đang bán)
    public function changeStatus(Request $request, $id)
    {
        $Goidata = Goidata::findOrFail($id);
    
        // Lấy trạng thái mới từ request
        $newStatus = $request->input('status', 'inactive');
    
        // Cập nhật trạng thái
        $Goidata->update(['status' => $newStatus]);
    
        return response()->json([
            'success' => true,
            'message' => 'Trạng thái gói cước đã được cập nhật thành công.',
        ]);
    }
    
    

    public function show()
    {
        // Lọc gói cước nổi bật có trạng thái 'active'
        $goidataNoiBat = Goidata::where('status', 'active')
            ->where('loai_data', 'mien_phi_mxh')
            ->take(5)
            ->get();
    
        // Lấy tất cả gói cước và kiểm tra trạng thái
        $goidatas = Goidata::all()->filter(function ($goi) {
            return $goi->status === 'active'; // Lọc chỉ gói cước 'active'
        });
    
        return view('frontend.dichvudidong.goidata', compact('goidataNoiBat', 'goidatas'));
    }


    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'phoneNumber' => 'required|digits:10',
                'package_id' => 'required|exists:goidatas,id', // Chỉ cho phép id của gói data
                'type' => 'required|in:goidata', // Chỉ cho phép loại goidata
            ]);
    
            PackageRegistration::create([
                'phone_number' => $validated['phoneNumber'],
                'package_id' => $validated['package_id'],
                'type' => $validated['type'], // Phải ghi rõ loại
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Đăng ký gói Data thành công!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage(),
            ]);
        }
    }
    

    



}
