<?php

namespace App\Http\Controllers;

use App\Models\GoiVoipCuocPhi;
use App\Models\QuocGia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GoiVoipCuocPhiController extends Controller {
    // Hiển thị danh sách với DataTable
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = GoiVoipCuocPhi::with('quocGia')->select('goi_voip_cuoc_phi.*');
            return DataTables::of($data)
                ->addColumn('block_6s_dau', function ($row) {
                    return $row->block_6s_dau ? $row->block_6s_dau . ' VDN' : 'N/A';
                })
                ->addColumn('gia_moi_giay', function ($row) {
                    return $row->gia_moi_giay ? $row->gia_moi_giay . ' VDN' : 'N/A';
                })
                ->addColumn('gia_1_phut_dau', function ($row) {
                    return $row->gia_1_phut_dau ? $row->gia_1_phut_dau . ' VDN' : 'N/A';
                })
                ->addColumn('gia_1_phut_tiep_theo', function ($row) {
                    return $row->gia_1_phut_tiep_theo ? $row->gia_1_phut_tiep_theo . ' VDN' : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-warning btn-sm edit-btn" data-id="'.$row->id.'">Sửa</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">Xóa</button>
                    ';
                })
                ->editColumn('quoc_gia_id', function ($row) {
                    return $row->quocGia->ten_quoc_gia;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        $quocGias = QuocGia::all();
        return view('admin.dichvu_quocte.goi_voip.index', compact('quocGias'));
    }
    

    public function store(Request $request) {
        $data = $request->validate([
            'quoc_gia_id' => 'required|exists:quoc_gia,id',
            'nhom_cuoc' => 'required|string',
            'ma_vung' => 'nullable|string',
            'block_6s_dau' => 'nullable|integer',
            'gia_moi_giay' => 'nullable|integer',
            'gia_1_phut_dau' => 'nullable|integer',
            'gia_1_phut_tiep_theo' => 'nullable|integer'
        ]);
    
        GoiVoipCuocPhi::create($data);
        return response()->json(['message' => 'Thêm mới thành công!']);
    }
    
    public function update(Request $request, $id) {
        $cuocPhi = GoiVoipCuocPhi::findOrFail($id);
    
        $data = $request->validate([
            'quoc_gia_id' => 'required|exists:quoc_gia,id',
            'nhom_cuoc' => 'required|string',
            'ma_vung' => 'nullable|string',
            'block_6s_dau' => 'nullable|integer',
            'gia_moi_giay' => 'nullable|integer',
            'gia_1_phut_dau' => 'nullable|integer',
            'gia_1_phut_tiep_theo' => 'nullable|integer'
        ]);
    
        $cuocPhi->update($data);
        return response()->json(['message' => 'Cập nhật thành công!']);
    }
    

    // Lấy dữ liệu cước phí để sửa
    public function edit($id) {
        $cuocPhi = GoiVoipCuocPhi::findOrFail($id);
        return response()->json($cuocPhi);
    }

    

    // Xóa cước phí
    public function destroy($id) {
        $cuocPhi = GoiVoipCuocPhi::findOrFail($id);
        $cuocPhi->delete();
        return response()->json(['message' => 'Đã xóa cước phí']);
    }

    // Khu vực API
    public function getCountries()
    {
        $quocGia = QuocGia::select('id', 'ten_quoc_gia', 'ma_quoc_gia')->get();
        return response()->json($quocGia);
    }

    public function getRatesByCountry(Request $request)
    {
        $maQuocGia = $request->query('ma_quoc_gia');

        $quocGia = QuocGia::where('ma_quoc_gia', $maQuocGia)->first();

        if (!$quocGia) {
            return response()->json(['error' => 'Mã quốc gia không tồn tại trong cơ sở dữ liệu'], 404);
        }

        // Lấy dữ liệu của cả IDD và VoIP 131
        $rates = GoiVoipCuocPhi::where('quoc_gia_id', $quocGia->id)
            ->select(
                'goi_voip_cuoc_phi.*',
                'quoc_gia.ten_quoc_gia',
                'quoc_gia.ma_quoc_gia'
            )
            ->join('quoc_gia', 'goi_voip_cuoc_phi.quoc_gia_id', '=', 'quoc_gia.id')
            ->get();

        return response()->json($rates);
    }


    public function dashboard()
    {
        // Tổng số quốc gia
        $totalCountries = GoiVoipCuocPhi::distinct('quoc_gia_id')->count('quoc_gia_id');

        // Tổng số nhóm cước
        $totalGroups = GoiVoipCuocPhi::distinct('nhom_cuoc')->count('nhom_cuoc');

        // Tổng số gói cước
        $totalPackages = GoiVoipCuocPhi::count();

        // Thống kê quốc gia
        $countryStats = GoiVoipCuocPhi::selectRaw('quoc_gia_id, COUNT(*) as total')
            ->groupBy('quoc_gia_id')
            ->get();
        $countryLabels = $countryStats->pluck('quoc_gia_id');
        $countryData = $countryStats->pluck('total');

        // Thống kê nhóm cước
        $groupStats = GoiVoipCuocPhi::selectRaw('nhom_cuoc, COUNT(*) as total')
            ->groupBy('nhom_cuoc')
            ->get();
        $groupLabels = $groupStats->pluck('nhom_cuoc');
        $groupData = $groupStats->pluck('total');

        return response()->json([
            'totalCountries' => $totalCountries,
            'totalGroups' => $totalGroups,
            'totalPackages' => $totalPackages,
            'countryLabels' => $countryLabels,
            'countryData' => $countryData,
            'groupLabels' => $groupLabels,
            'groupData' => $groupData,
        ]);
    }





    public function dashboard1()
    {
        // Tổng số mã vùng
        $totalRegions = GoiVoipCuocPhi::distinct('ma_vung')->count('ma_vung');

        // Trung bình Block 6s đầu
        $avgBlock6s = GoiVoipCuocPhi::avg('block_6s_dau');

        // Trung bình giá mỗi giây
        $avgPricePerSecond = GoiVoipCuocPhi::avg('gia_moi_giay');

        // Trung bình giá 1 phút đầu
        $avgPriceFirstMinute = GoiVoipCuocPhi::avg('gia_1_phut_dau');

        // Thống kê Block 6s đầu theo mã vùng
        $block6sStats = GoiVoipCuocPhi::selectRaw('ma_vung, AVG(block_6s_dau) as avg_block_6s')
            ->groupBy('ma_vung')
            ->get();
        $regionLabels = $block6sStats->pluck('ma_vung');
        $block6sData = $block6sStats->pluck('avg_block_6s');

        // Thống kê giá mỗi giây theo mã vùng
        $pricePerSecondStats = GoiVoipCuocPhi::selectRaw('ma_vung, AVG(gia_moi_giay) as avg_price_per_second')
            ->groupBy('ma_vung')
            ->get();
        $pricePerSecondData = $pricePerSecondStats->pluck('avg_price_per_second');

        return response()->json([
            'totalRegions' => $totalRegions,
            'avgBlock6s' => round($avgBlock6s, 2),
            'avgPricePerSecond' => round($avgPricePerSecond, 2),
            'avgPriceFirstMinute' => round($avgPriceFirstMinute, 2),
            'regionLabels' => $regionLabels,
            'block6sData' => $block6sData,
            'pricePerSecondData' => $pricePerSecondData,
        ]);
    }
}
