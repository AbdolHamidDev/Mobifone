<?php

namespace App\Http\Controllers;
use App\Models\TuyenDung;
use Illuminate\Http\Request;

class TuyenDungController extends Controller
{
    // Hiển thị danh sách công việc tuyển dụng
    public function index()
    {
        $tuyendungs = TuyenDung::all(); // Lấy tất cả công việc
        return view('admin.tuyendung.index', compact('tuyendungs'));
    }

    // Hiển thị form tạo công việc mới
    public function create()
    {
        return view('admin.tuyendung.create');
    }

    // Lưu công việc mới
    public function store(Request $request)
{
    $data = $request->all();

    // Kiểm tra xem checkbox "Tuyển gấp" có được chọn không
    if ($request->has('tuyen_gap') && $request->tuyen_gap == 'on') {
        $data['thoi_gian_ung_tuyen'] = '9999-12-31';  // Lưu giá trị đặc biệt cho tuyển gấp
    }

    Tuyendung::create($data);

    return redirect()->route('tuyendung.index')->with('success', 'Tạo công việc thành công');
}


    // Hiển thị form sửa công việc
    public function edit($id)
    {
        $tuyendung = TuyenDung::findOrFail($id);
        return view('admin.tuyendung.edit', compact('tuyendung'));
    }

    // Cập nhật thông tin công việc
    public function update(Request $request, $id)
{
    $request->validate([
        'vi_tri' => 'required|string|max:255',
        'mo_ta' => 'required|string',
        'yeu_cau' => 'required|string',
        'luong' => 'nullable|string',
        'thoi_gian_ung_tuyen' => 'required|date',
    ]);

    $tuyendung = TuyenDung::findOrFail($id);
    $data = $request->all();

    // Kiểm tra xem checkbox "Tuyển gấp" có được chọn không
    if ($request->has('tuyen_gap') && $request->tuyen_gap == 'on') {
        $data['thoi_gian_ung_tuyen'] = '9999-12-31'; // Gán giá trị đặc biệt cho "Tuyển gấp"
    }

    $tuyendung->update($data);

    return redirect()->route('tuyendung.index')->with('success', 'Công việc đã được cập nhật');
}


    // Xóa công việc
    public function destroy($id)
    {
        $tuyendung = TuyenDung::findOrFail($id);
        $tuyendung->delete();

        return redirect()->route('tuyendung.index')->with('success', 'Công việc đã được xóa');
    }


// Trang danh sách tuyển dụng
public function tuyendung()
{
    $tuyen_dungs = TuyenDung::all()->sortByDesc(function ($item) {
        return $item->thoi_gian_ung_tuyen === '9999-12-31' ? 1 : 0;
    });
    return view('frontend.gioithieu.tuyendung', compact('tuyen_dungs')); // Truyền dữ liệu vào view
}

public function tuyendung_chitiet($id)
{
    $tuyendung = Tuyendung::findOrFail($id);

    // Xử lý nội dung để thêm xuống dòng
    $tuyendung->mo_ta = str_replace("\n", "<br>", $tuyendung->mo_ta);

    $tuyendung->yeu_cau = str_replace("\n", "<br>", ($tuyendung->yeu_cau));
    return view('frontend.gioithieu.tuyendung_chitiet', compact('tuyendung'));
}

}
