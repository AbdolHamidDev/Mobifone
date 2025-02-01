<?php

namespace App\Http\Controllers;

use App\Models\GoiData;
use App\Models\GoiDataDetail;
use Illuminate\Http\Request;

class GoiDataDetailController extends Controller
{
    public function index()
{
    // Lấy danh sách chi tiết gói cước và phân trang
    $details = GoiDataDetail::select('id', 'goidata_id', 'key', 'value')->paginate(15);


    // Trả về view bình thường nếu không phải AJAX
    return view('admin.goidatas.details', compact('details'));
}

    
    


    // Lưu chi tiết mới
    public function store(Request $request)
{
    $request->validate([
        'goidata_id' => 'required|exists:goidatas,id',
        'details' => 'required|string',
    ]);

    $details = $request->input('details');
    $detailLines = explode("\n", $details); // Tách các dòng thông tin

    foreach ($detailLines as $line) {
        // Xử lý từng dòng để lưu vào bảng chi tiết, tách thành key-value
        $parts = explode(":", $line);
        if (count($parts) == 2) {
            goidataDetail::create([
                'goidata_id' => $request->goidata_id,
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
        $detail = goidataDetail::findOrFail($id);
        return view('admin.goidata_chitiet.sua', compact('detail'));
    }

    // Cập nhật chi tiết
    public function update(Request $request, $detailId)
{
    // Xác thực dữ liệu nhập vào
    $request->validate([
        'goidata_id' => 'required|exists:goidatas,id',
        'key' => 'required|string|max:255', // Key không được rỗng và phải là chuỗi
        'value' => 'nullable|string|max:255', // Value có thể trống, nếu có thì phải là chuỗi
    ], [
        'goidata_id.required' => 'ID Gói Cước là bắt buộc.',
        'goidata_id.exists' => 'Gói Cước không tồn tại.',
        'key.required' => 'Key là bắt buộc.',
        'value.string' => 'Value phải là chuỗi.',
        'key.max' => 'Key không được vượt quá 255 ký tự.',
        'value.max' => 'Value không được vượt quá 255 ký tự.',
    ]);

    // Cập nhật chi tiết gói cước
    $detail = goidataDetail::findOrFail($detailId);

    // Nếu không có giá trị cho value, gán chuỗi rỗng
    $value = $request->input('value', '');

    $detail->update([
        'goidata_id' => $request->goidata_id,
        'key' => $request->key,
        'value' => $value,  // Cập nhật value, có thể trống
    ]);

    return redirect()->route('goidatas_detail.index')->with('success', 'Cập nhật chi tiết gói cước thành công');
}

    // Xóa chi tiết
    public function destroy($id)
    {
        $detail = goidataDetail::findOrFail($id);
        $detail->delete();
        return redirect()->route('goidatas_detail.index')->with('success', 'Xóa thành công.');
    }


    public function show($goidata_id)
    {
        // Lấy thông tin gói cước chính
        $goi = GoiData::findOrFail($goidata_id);
    
        // Lấy các chi tiết gói cước liên quan
        $goidataDetails = GoiDataDetail::where('goidata_id', $goidata_id)->get();
    
        // Lấy các gói cước tương tự (ngoại trừ gói cước hiện tại)
        $relatedgoidatas = goidata::where('id', '!=', $goidata_id)->take(4)->get();
    
        // Trả dữ liệu ra view
        return view('frontend.dichvudidong.goidata_chitiet', compact('goi', 'goidataDetails', 'relatedgoidatas'));
    }
    
    
    public function showDetails($id)
    {
        // Lấy thông tin gói cước
        $goidatas = GoiData::all(); // Danh sách gói cước cho modal
        $details = GoiDataDetail::where('goidata_id', $id)->paginate(10); // Chi tiết gói cước
    
        return view('admin.goidatas.details', compact('details', 'id', 'goidatas'));
    }
    
    
    
}
