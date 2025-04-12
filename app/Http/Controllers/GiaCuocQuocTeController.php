<?php

namespace App\Http\Controllers;

use App\Models\GiaCuocQuocTe;
use App\Models\QuocGia;
use App\Models\NhaKhaiThac;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


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
    

public function getDashboardData()
    {
        try {
            // Kiểm tra kết nối CSDL
            DB::connection()->getPdo();
            
            // Lấy ngày hiện tại và tháng trước
            $currentDate = Carbon::now()->subMonth(); // Lùi về tháng 3 thay vì tháng 4
            $lastMonthDate = Carbon::now()->subMonth();
            
            // 1. Tổng số quốc gia và nhà khai thác
            $totalCountries = DB::table('quoc_gia')->count();
            $totalOperators = DB::table('nha_khai_thac')->count();
            
            // 2. Tính % thay đổi số quốc gia có cước
            $currentCountryCount = DB::table('gia_cuoc_quoc_te')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->distinct('quoc_gia_id')
                ->count('quoc_gia_id');
                
            $lastMonthCountryCount = DB::table('gia_cuoc_quoc_te')
                ->whereYear('created_at', $lastMonthDate->year)
                ->whereMonth('created_at', $lastMonthDate->month)
                ->distinct('quoc_gia_id')
                ->count('quoc_gia_id');
                
            $countryChangePercent = $this->calculateChangePercent($currentCountryCount, $lastMonthCountryCount);
            
            // 3. Tính % thay đổi số nhà khai thác
            $currentOperatorCount = DB::table('gia_cuoc_quoc_te')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->distinct('nha_khai_thac_id')
                ->count('nha_khai_thac_id');
                
            $lastMonthOperatorCount = DB::table('gia_cuoc_quoc_te')
                ->whereYear('created_at', $lastMonthDate->year)
                ->whereMonth('created_at', $lastMonthDate->month)
                ->distinct('nha_khai_thac_id')
                ->count('nha_khai_thac_id');
                
            $operatorChangePercent = $this->calculateChangePercent($currentOperatorCount, $lastMonthOperatorCount);
            
            // 4. Lấy giá trị trung bình các loại cước (tháng hiện tại)
            $currentMonthRates = DB::table('gia_cuoc_quoc_te')
                ->select([
                    DB::raw('AVG(cuoc_goi_ve_vn) as avg_call_rate'),
                    DB::raw('AVG(cuoc_data) as avg_data_rate'),
                    DB::raw('AVG(cuoc_sms) as avg_sms_rate'),
                    DB::raw('AVG(cuoc_nhan_goi) as avg_receive_rate')
                ])
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->first();
                
            // 5. Lấy giá trị trung bình tháng trước để tính % thay đổi
            $lastMonthRates = DB::table('gia_cuoc_quoc_te')
                ->select([
                    DB::raw('AVG(cuoc_goi_ve_vn) as avg_call_rate'),
                    DB::raw('AVG(cuoc_data) as avg_data_rate')
                ])
                ->whereYear('created_at', $lastMonthDate->year)
                ->whereMonth('created_at', $lastMonthDate->month)
                ->first();
                
            $callRateChangePercent = $this->calculateChangePercent(
                $currentMonthRates->avg_call_rate, 
                $lastMonthRates->avg_call_rate ?? 0
            );
            
            $dataRateChangePercent = $this->calculateChangePercent(
                $currentMonthRates->avg_data_rate, 
                $lastMonthRates->avg_data_rate ?? 0
            );
            
            // 6. Dữ liệu biểu đồ theo quốc gia (tháng hiện tại)
            $chartData = DB::table('gia_cuoc_quoc_te as g')
                ->join('quoc_gia as q', 'g.quoc_gia_id', '=', 'q.id')
                ->select([
                    'q.ten_quoc_gia as country',
                    DB::raw('AVG(g.cuoc_goi_ve_vn) as avg_call_rate'),
                    DB::raw('AVG(g.cuoc_data) as avg_data_rate'),
                    DB::raw('AVG(g.cuoc_sms) as avg_sms_rate')
                ])
                ->whereYear('g.created_at', $currentDate->year)
                ->whereMonth('g.created_at', $currentDate->month)
                ->groupBy('q.ten_quoc_gia')
                ->orderBy('avg_call_rate', 'desc')
                ->limit(10)
                ->get();
            
            // 7. Phân bố loại thuê bao (tháng hiện tại)
            $subscriptionTypes = DB::table('gia_cuoc_quoc_te')
                ->select([
                    'loai_thue_bao',
                    DB::raw('COUNT(*) as count')
                ])
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->groupBy('loai_thue_bao')
                ->pluck('count', 'loai_thue_bao');
            
            // 8. Top 10 quốc gia có cước cao nhất (tháng hiện tại)
            $topCountries = DB::table('gia_cuoc_quoc_te as g')
                ->join('quoc_gia as q', 'g.quoc_gia_id', '=', 'q.id')
                ->select([
                    'q.ten_quoc_gia as country',
                    DB::raw('MAX(g.cuoc_goi_ve_vn) as call_rate'),
                    DB::raw('MAX(g.cuoc_data) as data_rate'),
                    DB::raw('MAX(g.cuoc_sms) as sms_rate'),
                    DB::raw('MAX(g.cuoc_nhan_goi) as receive_rate'),
                    DB::raw('(MAX(g.cuoc_goi_ve_vn) + MAX(g.cuoc_data) + MAX(g.cuoc_sms)) as total')
                ])
                ->whereYear('g.created_at', $currentDate->year)
                ->whereMonth('g.created_at', $currentDate->month)
                ->groupBy('q.ten_quoc_gia')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get();
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'summary' => [
                        'total_countries' => $totalCountries,
                        'total_operators' => $totalOperators,
                        'country_change' => $countryChangePercent,
                        'operator_change' => $operatorChangePercent,
                        'call_rate_change' => $callRateChangePercent,
                        'data_rate_change' => $dataRateChangePercent
                    ],
                    'average_rates' => [
                        'call' => round($currentMonthRates->avg_call_rate),
                        'data' => round($currentMonthRates->avg_data_rate),
                        'sms' => round($currentMonthRates->avg_sms_rate),
                        'receive' => round($currentMonthRates->avg_receive_rate)
                    ],
                    'chart_data' => [
                        'countries' => $chartData->pluck('country'),
                        'call_rates' => $chartData->pluck('avg_call_rate'),
                        'data_rates' => $chartData->pluck('avg_data_rate'),
                        'sms_rates' => $chartData->pluck('avg_sms_rate'),
                        'subscription_types' => [
                            'prepaid' => $subscriptionTypes['Trả trước'] ?? 0,
                            'postpaid' => $subscriptionTypes['Trả sau'] ?? 0
                        ]
                    ],
                    'top_countries' => $topCountries
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Dashboard Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function getTopCountries(Request $request)
    {
        try {
            $type = $request->query('type', 'all');
            $currentDate = Carbon::now();
            
            $query = DB::table('gia_cuoc_quoc_te as g')
                ->join('quoc_gia as q', 'g.quoc_gia_id', '=', 'q.id')
                ->select([
                    'q.ten_quoc_gia as country',
                    DB::raw('MAX(g.cuoc_goi_ve_vn) as call_rate'),
                    DB::raw('MAX(g.cuoc_data) as data_rate'),
                    DB::raw('MAX(g.cuoc_sms) as sms_rate'),
                    DB::raw('MAX(g.cuoc_nhan_goi) as receive_rate'),
                    DB::raw('(MAX(g.cuoc_goi_ve_vn) + MAX(g.cuoc_data) + MAX(g.cuoc_sms)) as total')
                ])
                ->whereYear('g.created_at', $currentDate->year)
                ->whereMonth('g.created_at', $currentDate->month)
                ->groupBy('q.ten_quoc_gia');
            
            switch ($type) {
                case 'call':
                    $query->orderBy('call_rate', 'desc');
                    break;
                case 'data':
                    $query->orderBy('data_rate', 'desc');
                    break;
                case 'sms':
                    $query->orderBy('sms_rate', 'desc');
                    break;
                case 'receive':
                    $query->orderBy('receive_rate', 'desc');
                    break;
                default:
                    $query->orderBy('total', 'desc');
            }
            
            $results = $query->limit(10)->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $results,
                'type' => $type
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
    
    /**
     * Tính toán phần trăm thay đổi
     */
    private function calculateChangePercent($currentValue, $previousValue)
    {
        if ($previousValue == 0) {
            return 0;
        }
        
        return round(($currentValue - $previousValue) / $previousValue * 100, 2);
    }
}
