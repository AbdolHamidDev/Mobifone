<?php

namespace App\Http\Controllers;

use App\Models\GiaCuocQuocTe;
use App\Models\QuocGia;
use App\Models\NhaKhaiThac;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GiaCuocQuocTeController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = GiaCuocQuocTe::with(['quocGia', 'nhaKhaiThac'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('quoc_gia', function ($row) {
                    return $row->quocGia->ten_quoc_gia;
                })
                ->addColumn('nha_khai_thac', function ($row) {
                    return $row->nhaKhaiThac->ten_nha_khai_thac;
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $row->id . '">Sửa</button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Xóa</button>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.dichvu_quocte.cuocquocte.index');
    }

    public function getQuocGiaNhaKhaiThac() {
        return response()->json([
            'quoc_gia' => QuocGia::all(),
            'nha_khai_thac' => NhaKhaiThac::all()
        ]);
    }

    public function store(Request $request) {
        GiaCuocQuocTe::create($request->all());
        return response()->json(['message' => 'Thêm cước quốc tế thành công!']);
    }

    public function edit($id)
    {
        try {
            $cuocQuocTe = GiaCuocQuocTe::with(['quocGia', 'nhaKhaiThac'])->findOrFail($id);
            return response()->json($cuocQuocTe);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    

    public function update(Request $request, $id)
    {
        try {
            $cuocQuocTe = GiaCuocQuocTe::findOrFail($id);
            $cuocQuocTe->update($request->except('_token', '_method'));
            return response()->json(['message' => 'Cập nhật thành công!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    

    public function destroy($id) {
        GiaCuocQuocTe::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa cước quốc tế thành công!']);
    }



    public function getQuocGia()
{
    $quocGia = QuocGia::select('id', 'ten_quoc_gia', 'ma_quoc_gia')->get();
    return response()->json($quocGia);
}

public function getCuocQuocTe(Request $request)
{
    $query = GiaCuocQuocTe::with('nhaKhaiThac');

    if ($request->has('ma_quoc_gia')) {
        $quocGia = QuocGia::where('ma_quoc_gia', $request->ma_quoc_gia)->first();
        if ($quocGia) {
            $query->where('quoc_gia_id', $quocGia->id);
        }
    }

    if ($request->has('loai_thue_bao')) {
        $query->where('loai_thue_bao', $request->loai_thue_bao);
    }

    if ($request->has('ma_nha_khai_thac')) {
        $query->whereHas('nhaKhaiThac', function ($q) use ($request) {
            $q->where('ma_nha_khai_thac', $request->ma_nha_khai_thac);
        });
    }

    // Lấy danh sách kết quả từ database
    $giaCuoc = $query->get();

    // Chỉnh sửa dữ liệu trước khi trả về Vue
    $giaCuoc = $giaCuoc->map(function ($item) {
        return [
            'nha_khai_thac' => [
                'ten_nha_khai_thac' => $item->nhaKhaiThac->ten_nha_khai_thac ?? 'N/A',
                'ma_nha_khai_thac' => $item->nhaKhaiThac->ma_nha_khai_thac ?? 'N/A'
            ],
           'loai_thue_bao' => $this->chuanHoaLoaiThueBao($item->loai_thue_bao),
            'dau_so_thuc_hien_cuoc_goi' => $item->dau_so_thuc_hien_cuoc_goi ?? '+ / 00',
            'thuc_hien_cuoc_goi' => rand(0, 1) ? 'x' : '',
            'nhan_cuoc_goi' => rand(0, 1) ? 'x' : '',
            'dich_vu_sms' => rand(0, 1) ? 'x' : '',
            'data_3g' => rand(0, 1) ? 'x' : '',
            'data_4g' => rand(0, 1) ? 'x' : '',
            'data_5g' => rand(0, 1) ? 'x' : '',
            'cuoc_goi_trong_mang' => $item->cuoc_goi_trong_mang ?? 'N/A',
            'cuoc_goi_ve_vn' => $item->cuoc_goi_ve_vn ?? 'N/A',
            'cuoc_quoc_te' => $item->cuoc_quoc_te ?? 'N/A',
            'cuoc_ve_tinh' => $item->cuoc_ve_tinh ?? 'N/A',
            'cuoc_nhan_goi' => $item->cuoc_nhan_goi ?? 'N/A',
            'cuoc_sms' => $item->cuoc_sms ?? 'N/A',
            'cuoc_data' => $item->cuoc_data ?? 'N/A'
        ];
    });

    return response()->json($giaCuoc);
}


/**
 * Hàm sửa lỗi thiếu dấu tiếng Việt
 */
private function chuanHoaLoaiThueBao($loaiThueBao)
{
    $chuanHoa = [
        'Tra truoc' => 'Trả trước',
        'Tra sau' => 'Trả sau'
    ];
    return $chuanHoa[$loaiThueBao] ?? 'N/A';
}
    

}
