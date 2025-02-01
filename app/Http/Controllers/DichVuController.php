<?php

namespace App\Http\Controllers;

use App\Models\DichVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DichVuController extends Controller
{
    public function index()
    {
        $dichvus = DichVu::all();
        return view('admin.dichvu_didong.dichvu.index', compact('dichvus'));
    }

    public function create()
    {
        return view('dichvus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_dich_vu' => 'required|string|max:255',
            'anh' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'noi_dung' => 'required|string|max:255',
            'loai_dich_vu' => 'required|string|max:255',
        ]);

        $filePath = null;
        if ($request->hasFile('anh')) {
            $filePath = $request->file('anh')->store('uploads', 'public');
        }

        DichVu::create([
            'ten_dich_vu' => $request->ten_dich_vu,
            'anh' => $filePath,
            'noi_dung' => $request->noi_dung,
            'loai_dich_vu' => $request->loai_dich_vu,
        ]);

        return redirect()->route('dichvus.index')->with('success', 'Dịch vụ được thêm thành công!');
    }




    public function edit(DichVu $dichvu)
    {
        return view('dichvus.edit', compact('dichvu'));
    }

    public function update(Request $request, DichVu $dichvu)
    {
        $request->validate([
            'ten_dich_vu' => 'required|string|max:255',
            'anh' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'noi_dung' => 'required|string|max:255',
            'loai_dich_vu' => 'required|string|max:255',
        ]);

        if ($request->hasFile('anh')) {
            $filePath = $request->file('anh')->store('uploads', 'public');
            $dichvu->update([
                'anh' => $filePath,
            ]);
        }

        $dichvu->update($request->except('anh'));

        return redirect()->route('dichvus.index')->with('success', 'Dịch vụ được cập nhật thành công!');
    }

    public function destroy(DichVu $dichvu)
    {
        $dichvu->delete();
        return redirect()->route('dichvus.index')->with('success', 'Dịch vụ đã bị xóa!');
    }




    public function show()
    {
        // Lấy danh sách loại dịch vụ duy nhất
        $loaiDichVus = DB::table('dichvus')->select('loai_dich_vu')->distinct()->pluck('loai_dich_vu');
        
        // Lấy tất cả dịch vụ
        $dichvus = DB::table('dichvus')->get();
    
        return view('frontend.dichvudidong.dichvu', compact('loaiDichVus', 'dichvus'));
    }
    
}
