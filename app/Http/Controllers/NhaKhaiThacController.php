<?php

namespace App\Http\Controllers;

use App\Models\NhaKhaiThac;
use App\Models\QuocGia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NhaKhaiThacController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = NhaKhaiThac::with('quocGia')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('quoc_gia', function ($row) {
                    return $row->quocGia->ten_quoc_gia;
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $row->id . '">Sửa</button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Xóa</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.dichvu_quocte.nhakhaithac.index');
    }

    // Lấy danh sách quốc gia từ CSDL
    public function getQuocGia() {
        return response()->json(QuocGia::all());
    }

    // Hiển thị form tạo mới (Không cần thiết vì dùng modal)
    public function create() {
        return view('admin.dichvu_quocte.nhakhaithac.create');
    }

    // Lưu nhà khai thác mới
    public function store(Request $request) {
        NhaKhaiThac::create($request->all());
        return response()->json(['message' => 'Thêm nhà khai thác thành công!']);
    }

    // Lấy thông tin để sửa
    public function edit($id) {
        $nhaKhaiThac = NhaKhaiThac::findOrFail($id);
        return response()->json($nhaKhaiThac);
    }
    
    // Cập nhật dữ liệu nhà khai thác
    public function update(Request $request, $id) {
        $nhaKhaiThac = NhaKhaiThac::findOrFail($id);
        $nhaKhaiThac->update($request->all());
        return response()->json(['message' => 'Cập nhật nhà khai thác thành công!']);
    }

    // Xóa nhà khai thác
    public function destroy($id) {
        NhaKhaiThac::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa nhà khai thác thành công!']);
    }
}
