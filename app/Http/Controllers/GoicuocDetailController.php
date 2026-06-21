<?php

namespace App\Http\Controllers;

use App\Models\GoiCuoc;
use App\Models\GoicuocDetail;
use Illuminate\Http\Request;

class GoicuocDetailController extends Controller
{
    public function index()
{
    // Lấy danh sách chi tiết gói cước và phân trang
    $details = GoicuocDetail::select('id', 'goicuoc_id', 'key', 'value')->paginate(15);


    // Trả về view bình thường nếu không phải AJAX
    return view('admin.goicuoc_chitiet.danhsach', compact('details'));
}

    
    
    

    public function create()
{
    $goicuocs = GoiCuoc::all(); // Lấy danh sách gói cước
    return view('admin.goicuoc_chitiet.them', compact('goicuocs'));
}


    // Lưu chi tiết mới
    public function store(Request $request)
{
    $request->validate([
        'goicuoc_id' => 'required|exists:goicuocs,id',
        'details' => 'required|string',
    ]);

    $details = $request->input('details');
    $detailLines = explode("\n", $details); // Tách các dòng thông tin

    foreach ($detailLines as $line) {
        // Xử lý từng dòng để lưu vào bảng chi tiết, tách thành key-value
        $parts = explode(":", $line);
        if (count($parts) == 2) {
            GoicuocDetail::create([
                'goicuoc_id' => $request->goicuoc_id,
                'key' => trim($parts[0]),
                'value' => trim($parts[1]),
            ]);
        }
    }

    return response()->json(['success' => true, 'message' => 'Chi tiết đã được thêm thành công!']);
}



    // Form chỉnh sửa
    public function edit($id)
    {
        $detail = GoicuocDetail::findOrFail($id);
        return view('admin.goicuoc_chitiet.sua', compact('detail'));
    }

    // Cập nhật chi tiết
    public function update(Request $request, $detailId)
{
    // Xác thực dữ liệu nhập vào
    $request->validate([
        'goicuoc_id' => 'required|exists:goicuocs,id',
        'key' => 'required|string|max:255', // Key không được rỗng và phải là chuỗi
        'value' => 'nullable|string|max:255', // Value có thể trống, nếu có thì phải là chuỗi
    ], [
        'goicuoc_id.required' => 'ID Gói Cước là bắt buộc.',
        'goicuoc_id.exists' => 'Gói Cước không tồn tại.',
        'key.required' => 'Key là bắt buộc.',
        'value.string' => 'Value phải là chuỗi.',
        'key.max' => 'Key không được vượt quá 255 ký tự.',
        'value.max' => 'Value không được vượt quá 255 ký tự.',
    ]);

    // Cập nhật chi tiết gói cước
    $detail = GoicuocDetail::findOrFail($detailId);

    // Nếu không có giá trị cho value, gán chuỗi rỗng
    $value = $request->input('value', '');

    $detail->update([
        'goicuoc_id' => $request->goicuoc_id,
        'key' => $request->key,
        'value' => $value,  // Cập nhật value, có thể trống
    ]);

    return redirect()->route('goicuocs_detail.index')->with('success', 'Cập nhật chi tiết gói cước thành công');
}

    // Xóa chi tiết
    public function destroy($id)
    {
        $detail = GoicuocDetail::findOrFail($id);
        $detail->delete();
        return redirect()->route('goicuocs_detail.index')->with('success', 'Xóa thành công.');
    }


    public function show($goicuoc_id)
    {
        // Lấy thông tin gói cước chính
        $goi = GoiCuoc::findOrFail($goicuoc_id);
    
        // Lấy các chi tiết gói cước liên quan
        $goicuocDetails = GoicuocDetail::where('goicuoc_id', $goicuoc_id)->get();
    
        // Lấy các gói cước tương tự (ngoại trừ gói cước hiện tại)
        $relatedGoicuocs = GoiCuoc::where('id', '!=', $goicuoc_id)->take(4)->get();
    
        // Trả dữ liệu ra view
        return view('frontend.dichvudidong.goicuoc_chitiet', compact('goi', 'goicuocDetails', 'relatedGoicuocs'));
    }
    
    
    public function showDetails($id)
    {
        // Lấy thông tin gói cước
        $goicuocs = GoiCuoc::all(); // Danh sách gói cước cho modal
        $details = GoicuocDetail::where('goicuoc_id', $id)->paginate(10); // Chi tiết gói cước
    
        return view('admin.goicuoc_chitiet.danhsach', compact('details', 'id', 'goicuocs'));
    }
    
    
    
}
