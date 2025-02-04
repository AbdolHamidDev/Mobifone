<?php

namespace App\Http\Controllers;

use App\Models\QuocGia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuocGiaController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = QuocGia::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $row->id . '">Sửa</button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Xóa</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.dichvu_quocte.quocgia.index');
    }

    public function create() {
        return view('admin.dichvu_quocte.quocgia.create');
    }

    public function store(Request $request) {
        QuocGia::create($request->all());
        return response()->json(['message' => 'Thêm quốc gia thành công!']);
    }

    public function show($id) {
        return response()->json(QuocGia::findOrFail($id));
    }

    public function edit($id) {
        return response()->json(QuocGia::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $quocGia = QuocGia::findOrFail($id);
        $quocGia->update($request->all());
        return response()->json(['message' => 'Cập nhật quốc gia thành công!']);
    }

    public function destroy($id) {
        QuocGia::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa quốc gia thành công!']);
    }
}
