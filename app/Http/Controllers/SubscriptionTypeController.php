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
    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    $subscriptionType = SubscriptionType::create($data);

    // Đảm bảo partial view nhận đúng biến $subscriptionType
    $html = view('admin.dichvu_didong.loaithuebao.row', compact('subscriptionType'))->render();

    return response()->json(['html' => $html]);
}


public function edit(SubscriptionType $subscriptionType)
{
    return response()->json($subscriptionType);
}

public function update(Request $request, SubscriptionType $subscriptionType)
{
    $data = $request->all();

    if ($request->hasFile('image')) {
        if ($subscriptionType->image) {
            Storage::disk('public')->delete($subscriptionType->image);
        }
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    $subscriptionType->update($data);

    // Trả về HTML hợp lệ
    $html = view('admin.dichvu_didong.loaithuebao.row', compact('subscriptionType'))->render();

    return response()->json(['html' => $html]);
}


    public function destroy(SubscriptionType $subscriptionType)
    {
        if ($subscriptionType->image) {
            Storage::disk('public')->delete($subscriptionType->image);
        }

        $subscriptionType->delete();

        return redirect()->route('subscription-types.index')->with('success', 'Loại thuê bao đã được xóa.');
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
