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
        try {
            $subscriptions = DB::table('package_registrations as pr')
                ->leftJoin('goicuocs as g', function($join) {
                    $join->on('pr.package_id', '=', 'g.id')
                         ->where('pr.type', '=', 'goicuoc');
                })
                ->select(
                    'pr.id',
                    'pr.phone_number',
                    'pr.created_at',
                    'g.ten_goicuoc',
                    'g.gia',
                    'g.thoi_gian',
                    DB::raw('DATEDIFF(DATE_ADD(pr.created_at, INTERVAL g.thoi_gian DAY), NOW()) as thoi_gian_con_lai')
                )
                ->orderBy('pr.created_at', 'desc')
                ->get();
    
            return response()->json(['data' => $subscriptions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi server: ' . $e->getMessage()], 500);
        }
    }
    


public function store(Request $request)
{
    // Validate dữ liệu
    $validated = $request->validate([
        'registration_id' => 'required|integer',  // id của đăng ký gói cước
        'phone_number' => 'nullable|string|max:20',  // Số điện thoại
        'package_name' => 'required|string|max:255', // Tên gói cước
        'package_price' => 'required|numeric|min:0', // Giá gói cước
        'type' => 'required|string|in:goicuoc,khac', // Loại gói cước
        'cancel_reason' => 'required|string|max:500', // Lý do hủy
        'cancel_by' => 'required|string|max:100' // Người hủy
    ]);

    try {
        // Chuyển đổi giá trị package_price nếu cần
        $packagePrice = floatval($validated['package_price']);  // Đảm bảo giá trị là số thực

        // Tạo bản ghi hủy trong bảng package_cancellations
        $cancellation = PackageCancellation::create([
            'registration_id' => $validated['registration_id'],  // Lưu ID đăng ký
            'phone_number' => $validated['phone_number'] ?? 'Không rõ', // Nếu không có số điện thoại thì ghi 'Không rõ'
            'package_name' => $validated['package_name'], // Tên gói cước
            'package_price' => $packagePrice, // Giá trị gói cước
            'type' => $validated['type'],  // Loại gói cước (goicuoc, khac)
            'cancel_reason' => $validated['cancel_reason'],  // Lý do hủy
            'cancel_by' => $validated['cancel_by'],  // Người hủy
            'cancelled_at' => now(), // Thời gian hủy
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hủy thành công'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi server: ' . $e->getMessage()
        ], 500);
    }
}
    

}
