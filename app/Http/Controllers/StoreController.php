<?php

// app/Http/Controllers/StoreController.php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Hiển thị danh sách cửa hàng
    public function index()
    {
        $stores = Store::all();
        return view('admin.timkiem_cuahang.index', compact('stores'));
    }

    // Hiển thị form tạo mới cửa hàng
    public function create()
    {
        return view('admin.timkiem_cuahang.create');
    }

    // Lưu cửa hàng mới
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
    
        // Lấy giá trị từ request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $name = $request->input('name');
        $address = $request->input('address');
    
        // Tạo cửa hàng mới
        Store::create([
            'name' => $name,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    
        // Quay lại trang danh sách cửa hàng với thông báo thành công
        return redirect()->route('store.index')->with('success', 'Cửa hàng đã được thêm thành công!');
    }
    
    // Hiển thị form chỉnh sửa cửa hàng
    public function edit(Store $store)
    {
        return view('admin.timkiem_cuahang.edit', compact('store'));
    }

    // Cập nhật cửa hàng
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $store->update($request->all());
        return redirect()->route('store.index')->with('success', 'Cửa hàng đã được cập nhật!');
    }

    // Xóa cửa hàng
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('store.index')->with('success', 'Cửa hàng đã được xóa!');
    }

    // Tìm kiếm cửa hàng
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ người dùng
        $query = $request->input('query');
        
        // Tìm kiếm cửa hàng theo tên hoặc địa chỉ
        $stores = Store::where('name', 'LIKE', "%$query%")
                        ->orWhere('address', 'LIKE', "%$query%")
                        ->get(['name', 'address', 'latitude', 'longitude']);
        
        // Trả về view và truyền dữ liệu cửa hàng vào
        return view('frontend.hotro.timkiem_cuahang', compact('stores'));
    }
}

