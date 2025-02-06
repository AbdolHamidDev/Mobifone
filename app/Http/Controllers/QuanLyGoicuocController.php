<?php

namespace App\Http\Controllers;

use App\Models\Goicuoc;
use Illuminate\Http\Request;
use App\Models\PackageRegistration;
use Yajra\DataTables\Facades\DataTables;

class QuanLyGoicuocController extends Controller
{
    
    public function api(Request $request)
{
    $goicuocs = GoiCuoc::select(['id', 'ten_goicuoc', 'gia', 'thoi_gian', 'dung_luong', 'don_vi_dung_luong', 'loai_goicuoc', 'status', 'created_at']);

    return DataTables::of($goicuocs)
        ->addColumn('actions', function ($row) {
            return '
                <div class="d-flex justify-content-center align-items-center">
                    <a href="' . route('goicuocs.edit', $row->id) . '" 
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
                        action="' . route('goicuocs.destroy', $row->id) . '" 
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
        return view('admin.goicuocs.danhsach');
    }


    

 

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_goicuoc' => 'required|string|max:255',
            'gia' => 'required|numeric|min:0',
            'thoi_gian' => 'required|integer|min:1',
            'dung_luong' => 'required|numeric|min:0',
            'don_vi_dung_luong' => 'required|in:MB,GB,phut_goi_quoc_te,phut_thoai_quoc_te_huong_han_quoc',
            'loai_goicuoc' => 'required|string|max:255',
        ]);

        GoiCuoc::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được thêm thành công.',
        ]);
    }
    

    // Chỉnh sửa gói cước
    public function edit(Goicuoc $goicuoc)
    {
        return view('admin.goicuocs.sua', compact('goicuoc'));
    }



    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ten_goicuoc' => 'required|string|max:255',
            'gia' => 'required|numeric|min:0',
            'thoi_gian' => 'required|integer|min:1',
            'dung_luong' => 'required|numeric|min:0',
            'don_vi_dung_luong' => 'required|in:MB,GB,phut_goi_quoc_te,phut_thoai_quoc_te_huong_han_quoc',
            'loai_goicuoc' => 'required|string|max:255',
        ]);
    
        $goicuoc = GoiCuoc::findOrFail($id);
        $goicuoc->update($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được cập nhật thành công.',
        ]);
    }

    // Xóa gói cước
    public function destroy($id)
    {
        $goicuoc = GoiCuoc::findOrFail($id);
        $goicuoc->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Gói cước đã được xóa thành công.',
        ]);
    }
    



    // trạng thái gói cước (ngừng bán và đang bán)
    public function changeStatus(Request $request, $id)
    {
        $goicuoc = GoiCuoc::findOrFail($id);
    
        // Lấy trạng thái mới từ request
        $newStatus = $request->input('status', 'inactive');
    
        // Cập nhật trạng thái
        $goicuoc->update(['status' => $newStatus]);
    
        return response()->json([
            'success' => true,
            'message' => 'Trạng thái gói cước đã được cập nhật thành công.',
        ]);
    }
    
    


public function show()
{
    // Lọc gói cước nổi bật có trạng thái 'active'
    $goiCuocNoiBat = Goicuoc::where('status', 'active')
        ->where('loai_goicuoc', 'chuyen_vung_quoc_te')
        ->take(5)
        ->get();

    // Lấy tất cả gói cước và kiểm tra trạng thái
    $goiCuocs = Goicuoc::all()->filter(function ($goi) {
        return $goi->status === 'active'; // Lọc chỉ gói cước 'active'
    });

    return view('frontend.dichvudidong.goicuoc', compact('goiCuocNoiBat', 'goiCuocs'));
}


public function register(Request $request)
{
    try {
        $validated = $request->validate([
            'phoneNumber' => 'required|digits:10',
            'package_id' => 'required|exists:goicuocs,id',
        ]);

        // Lưu thông tin đăng ký
        PackageRegistration::create([
            'phone_number' => $validated['phoneNumber'],
            'package_id' => $validated['package_id'],
        ]);

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Bạn đã đăng ký thành công gói cước!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Vui lòng nhập đúng số điện thoại.'
        ]);
    }
}





}
