<?php

namespace App\Http\Controllers;

use App\Models\DichVu;
use Illuminate\Http\Request;
use App\Models\DichvuChitiet;

class DichvuChitietController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dichvu_id' => 'required|exists:dichvus,id',
            'doi_tuong_su_dung' => 'nullable|string',
            'tinh_nang_chinh' => 'nullable|string',
            'quy_dinh' => 'nullable|string',
            'tien_ich' => 'nullable|string',
        ]);

        DichvuChitiet::create($request->all());

        return redirect()->back()->with('success', 'Thêm chi tiết dịch vụ thành công!');
    }


    public function show($id)
    {
        // Lấy dịch vụ chính
        $dichvu = DichVu::find($id);
    
        // Lấy chi tiết dịch vụ
        $dichvuChitiets = DichvuChitiet::with('dichvu')->where('dichvu_id', $id)->paginate(10);
    
        // Lấy 2 dịch vụ khác ngẫu nhiên
        $dichvuKhac = DichVu::where('id', '!=', $id)->inRandomOrder()->limit(2)->get();
    
        return view('frontend.dichvudidong.dichvu_chitiet', [
            'dichvu' => $dichvu,
            'dichvuChitiets' => $dichvuChitiets,
            'dichvuKhac' => $dichvuKhac,
        ]);
    }
    

    public function update(Request $request, $id)
{
    $request->validate([
        'doi_tuong_su_dung' => 'nullable|string',
        'tinh_nang_chinh' => 'nullable|string',
        'quy_dinh' => 'nullable|string',
        'tien_ich' => 'nullable|string',
    ]);

    $dichvuChitiet = DichvuChitiet::findOrFail($id);
    $dichvuChitiet->update($request->all());

    return redirect()->back()->with('success', 'Cập nhật chi tiết dịch vụ thành công!');
}

    


}
