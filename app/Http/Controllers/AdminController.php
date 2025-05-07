<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\GoiCuoc;
use App\Models\PackageRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function getHome()
    {
        // 1️⃣ Tổng hợp dữ liệu thống kê
        $totalOrders = Order::count();
        $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $newCustomers = Order::distinct('customer_name')->whereDate('created_at', Carbon::today())->count();
        $packagesSold = Order::count();

        // 2️⃣ Doanh thu theo tháng
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = "Tháng " . $i;
            $data[] = $monthlyRevenue->where('month', $i)->first()->revenue ?? 0;
        }

        // 3️⃣ Tỷ lệ gói cước được đăng ký nhiều nhất
        $packageData = Order::selectRaw('goi_cuoc_id, COUNT(*) as count')
            ->groupBy('goi_cuoc_id')
            ->pluck('count')
            ->toArray();

        $packageLabels = GoiCuoc::whereIn('id', array_keys($packageData))->pluck('ten_goicuoc')->toArray();

        // 4️⃣ Danh sách đơn hàng gần đây
        $recentOrders = Order::latest()->limit(5)->get();

        // 5️⃣ Trạng thái đơn hàng (Biểu đồ Doughnut)
        $statusData = Order::selectRaw('trang_thai, COUNT(*) as count')
            ->groupBy('trang_thai')
            ->pluck('count')
            ->toArray();

        $statusLabels = Order::selectRaw('trang_thai')
            ->groupBy('trang_thai')
            ->pluck('trang_thai')
            ->toArray();

         // Lấy danh sách người dùng đang đăng nhập qua OTP từ session
         $otpUsers = Cache::get('otp_users', []);

           // Lấy danh sách đăng ký gói cước & gói data
    $packageRegistrations = PackageRegistration::with(['goicuoc', 'goiData'])
    ->latest()
    ->limit(10) // Hiển thị 10 bản ghi mới nhất
    ->get();

    
    

        return view('admin.home', compact(
            'totalOrders', 'todayRevenue', 'newCustomers', 'packagesSold',
            'labels', 'data', 'packageLabels', 'packageData',
            'recentOrders', 'statusLabels', 'statusData','otpUsers','packageRegistrations'
        ));
    }

    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;   
    }
  

    public function index()
    {
        $users = User::with('roles')->get();  // Lấy danh sách người dùng kèm theo vai trò
        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
{
    $user = User::with('roles')->findOrFail($id);  // Lấy người dùng kèm vai trò
    $roles = Role::all();  // Lấy tất cả vai trò
    return view('admin.user.edit', compact('user', 'roles'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role_id' => 'required|array',
        'role_id.*' => 'exists:roles,id', // Kiểm tra từng role_id có tồn tại không
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Thêm vai trò vào bảng role_user
    $user->roles()->sync($request->role_id);  // Đồng bộ các vai trò

    return redirect()->route('users.index')->with('success', 'Tạo người dùng thành công');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role_id' => 'required|array',
        'role_id.*' => 'exists:roles,id',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Cập nhật các vai trò
    $user->roles()->sync($request->role_id);  // Đồng bộ các vai trò mới

    return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công');
}



    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();  // Gỡ mối quan hệ trong bảng role_user
        $user->delete();  // Xóa người dùng
    
        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công');
    }
    


public function getIndex()
{
    return view('admin.welcome');
}

}
