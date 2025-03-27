<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscriptionTypes = SubscriptionType::all();
        return view('admin.dichvu_didong.loaithuebao.index', compact('subscriptionTypes'));
    }



    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:subscription_types,name',
        'title' => 'required|string|max:255',
        'subscription_category' => 'required|string',
        'is_approved' => 'boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('subscription_types', 'public');
    }

    try {
        $subscriptionType = SubscriptionType::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công!',
            'data' => $subscriptionType
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi: ' . $e->getMessage()
        ], 500);
    }
}

public function edit(SubscriptionType $subscriptionType)
{
    return response()->json($subscriptionType);
}

public function update(Request $request, $id)
{
    $subscriptionType = SubscriptionType::find($id);

    if (!$subscriptionType) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy loại thuê bao'], 404);
    }

    $validated = $request->validate([
        'name' => 'sometimes|string|max:255|unique:subscription_types,name,'.$subscriptionType->id,
        'title' => 'sometimes|string|max:255',
        'subscription_category' => 'sometimes|string',
        'is_approved' => 'sometimes|boolean',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        $updateData = array_filter($validated, fn($value) => $value !== null);

        if ($request->hasFile('image')) {
            if ($subscriptionType->image) {
                Storage::disk('public')->delete($subscriptionType->image);
            }
            $updateData['image'] = $request->file('image')->store('subscription_types', 'public');
        }

        $subscriptionType->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công!',
            'data' => $subscriptionType
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi: ' . $e->getMessage()
        ], 500);
    }
}


public function destroy(SubscriptionType $subscriptionType)
{
    try {
        if ($subscriptionType->image) {
            Storage::disk('public')->delete($subscriptionType->image);
        }

        $subscriptionType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Loại thuê bao đã được xóa thành công!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Xóa không thành công: ' . $e->getMessage()
        ], 500);
    }
}



    public function show($category = null)
    {
        // Lấy tất cả các subscription_category
        $categories = SubscriptionType::select('subscription_category')
            ->distinct()
            ->pluck('subscription_category');

        // Lấy danh mục đầu tiên mặc định hoặc danh mục được chọn
        $selectedCategory = $category ?? $categories->first();

        // Lấy danh sách các subscription_types thuộc danh mục đã chọn
        $items = SubscriptionType::where('subscription_category', $selectedCategory)->get();

        return view('frontend.dichvudidong.loaithuebao', compact('categories', 'selectedCategory', 'items'));
    }


    
}
