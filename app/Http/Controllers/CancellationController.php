<?php

namespace App\Http\Controllers;

use App\Models\PackageCancellation;
use App\Models\PackageRegistration;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CancellationController extends Controller
{
    /**
     * Hiển thị giao diện lịch sử hủy.
     */
    public function index()
    {
        return view('admin.huygoi.index');
    }

    /**
     * API DataTables: Lấy danh sách lịch sử hủy gói cước.
     */
    public function apiIndex(Request $request)
    {
        try {
            $query = PackageCancellation::latest();
    
            // Bộ lọc theo loại gói
            if ($request->has('type') && $request->type !== 'all') {
                $query->where('type', $request->type);
            }
    
            // Trả dữ liệu cho DataTable
            return DataTables::of($query)
                ->addColumn('type_label', function ($record) {
                    return $record->type === 'goicuoc' ? 'Gói Cước' : 'Gói Data';
                })
                ->addColumn('actions', function ($record) {
                    return '<a href="#" class="btn btn-sm btn-primary">Xem</a>';
                })
                ->rawColumns(['actions'])
                ->toJson();
        } catch (\Exception $e) {
            Log::error('🚨 [apiIndex] Lỗi khi lấy lịch sử hủy gói:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Lỗi server, không thể lấy dữ liệu.'], 500);
        }
    }


    public function apiSubscriptions()
    {
        $subscriptions = DB::table('goicuocs')
            ->select(
                'id',
                'ten_goicuoc',
                'gia',
                'created_at',
                'thoi_gian',
                DB::raw('DATEDIFF(DATE_ADD(created_at, INTERVAL thoi_gian DAY), NOW()) AS thoi_gian_con_lai')
            )
            ->get();
    
        return response()->json(['data' => $subscriptions]);
    }
    
    
 
    


    public function store(Request $request)
    {
        // Ép kiểu package_price về số
        $packagePrice = floatval($request->input('package_price'));
    
        if (!is_numeric($packagePrice)) {
            Log::error('🚨 Lỗi: package_price không phải là số', ['package_price' => $packagePrice]);
            return response()->json(['message' => 'Giá gói cước phải là số'], 400);
        }
    
        // Log để kiểm tra
        Log::info('🟡 Dữ liệu nhận từ request:', $request->all());
    
        // Lưu dữ liệu
        $result = DB::insert("
            INSERT INTO package_cancellations 
            (registration_id, phone_number, package_name, package_price, type, cancel_reason, cancel_by, cancelled_at, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())
        ", [
            $request->input('registration_id'),
            $request->input('phone_number') ?? 'Không rõ',
            $request->input('package_name') ?? 'Không rõ',
            $packagePrice,  // Đảm bảo là số
            $request->input('type') ?? 'goicuoc',
            $request->input('cancel_reason') ?? 'Không rõ',
            $request->input('cancel_by') ?? 'Khách hàng',
        ]);
    
        return response()->json(['message' => $result ? 'Hủy thành công' : 'Hủy thất bại'], $result ? 200 : 500);
    }
    
 
    

}
