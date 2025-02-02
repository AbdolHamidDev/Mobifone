<?php

namespace App\Http\Controllers;

use App\Models\Goicuoc;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\SoThueBao;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session; 


class SoThueBaoController extends Controller
{
    public function index()
    {
        $soThueBaos = SoThueBao::with('orders')->get(); // Nạp quan hệ nếu cần thiết
    
        return view('admin.dichvu_didong.sothuebao.index', compact('soThueBaos'));
    }
    


    public function store(Request $request)
{
    $request->validate([
        'so_thue_bao' => 'required|unique:so_thue_bao|max:20',
        'loai_thue_bao' => 'required',
        'khu_vuc' => 'required',
        'loai_so' => 'required',
        'phi_giu_so' => 'required|numeric',
        'phi_hoa_mang' => 'required|numeric',
    ]);

    SoThueBao::create($request->all());

    return redirect()->route('so-thue-bao.index')->with('success', 'Thêm số thuê bao thành công!');
}



public function update(Request $request, $id)
{
    $request->validate([
        'so_thue_bao' => 'required|max:20|unique:so_thue_bao,so_thue_bao,' . $id,
        'loai_thue_bao' => 'required',
        'khu_vuc' => 'required',
        'loai_so' => 'required',
        'phi_giu_so' => 'required|numeric',
        'phi_hoa_mang' => 'required|numeric',
    ]);

    $soThueBao = SoThueBao::findOrFail($id);
    $soThueBao->update($request->all());

    return redirect()->route('so-thue-bao.index')->with('success', 'Cập nhật số thuê bao thành công!');
}



public function show($id)
{
    // Lấy tất cả số thuê bao từ CSDL
    $soThueBao = SoThueBao::findOrFail($id);

    // Truyền dữ liệu qua view
    return view('frontend.dichvudidong.sothuebao', compact('soThueBao'));
}



public function loc(Request $request)
{
    $query = SoThueBao::query();

    // Lọc theo đầu số
    if ($request->has('dau_so') && !empty($request->dau_so)) {
        $query->where('so_thue_bao', 'like', $request->dau_so . '%');
    }

    // Lọc theo loại thuê bao
    if ($request->has('loai_thue_bao') && !empty($request->loai_thue_bao)) {
        $query->where('loai_thue_bao', $request->loai_thue_bao);
    }

    // Lấy danh sách số thuê bao
    $soThueBao = $query->paginate(8)->appends($request->query());

    // Trả về view nhỏ (partial) nếu là request AJAX
    if ($request->ajax()) {
        return response()->json([
            'html' => view('frontend.dichvudidong.table_sothuebao', compact('soThueBao'))->render(),
        ]);
    }

    // Trả về view đầy đủ khi không phải AJAX
    return view('frontend.dichvudidong.sothuebao', compact('soThueBao'));
}

public function showChiTietSoThueBao(Request $request, $id)
{
    $tempId = $request->input('temp_id') ?? 'temp_order_' . uniqid();

    // Dữ liệu cần lưu vào Cache
    $soThueBao = SoThueBao::with('goicuoc')->findOrFail($id);


    $dataToCache = [
       'so_thue_bao_id' => $soThueBao->id,
        'loai_thue_bao' => $soThueBao->loai_thue_bao,
        'phi_hoa_mang' => $soThueBao->phi_hoa_mang,
        'phi_giu_so' => $soThueBao->phi_giu_so,
        'khu_vuc' => $soThueBao->khu_vuc,
        'goi_cuoc_id' => $soThueBao->goicuoc->id ?? null,
        'gia_goi_cuoc' => $soThueBao->goicuoc->gia ?? 0,
        'ten_goi_cuoc' => $soThueBao->goicuoc->ten_goicuoc ?? null,
        'loai_so' => $soThueBao->so_thue_bao
    ];

    // Lưu Cache
    Cache::put($tempId, $dataToCache, now()->addMinutes(15));

    // Lấy thông tin từ cơ sở dữ liệu (nếu cần)
    $thueBao = SoThueBao::with('goicuoc')->findOrFail($dataToCache['so_thue_bao_id']);
    $goiCuoc = Goicuoc::with(['details' => function ($query) {
        $query->limit(1);
    }])
    ->where('status', 'active')
    ->where('thoi_gian', 30)
    ->take(3)
    ->get();

    // Lấy giá gói cước (nếu có)
    $giaGoiCuoc = $thueBao->goicuoc->gia ?? '0';

    // Trả về view, truyền toàn bộ dữ liệu
    return view('frontend.dichvudidong.sothuebao_chitiet', compact('thueBao', 'goiCuoc', 'giaGoiCuoc', 'tempId', 'dataToCache'));
}


public function search(Request $request)
{
    if ($request->ajax()) {
        $searchTerm = $request->input('searchTerm');

        $soThueBao = SoThueBao::where('so_thue_bao', 'like', "%{$searchTerm}%")
                              ->orWhere('loai_thue_bao', 'like', "%{$searchTerm}%")
                              ->paginate(10);

        return response()->json([
            'html' => view('frontend.dichvudidong.table_sothuebao', compact('soThueBao'))->render()
        ]);
    }
}




}
