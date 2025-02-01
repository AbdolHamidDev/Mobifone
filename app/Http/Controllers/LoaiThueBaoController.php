<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionType;
use App\Models\LoaiThueBao;

class LoaiThueBaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($subscriptionTypeId)
    {
        $subscriptionType = SubscriptionType::with(['loaithuebao' => function ($query) use ($subscriptionTypeId) {
            $query->where('subscription_type_id', $subscriptionTypeId);
        }])->findOrFail($subscriptionTypeId);
        

        return view('admin.dichvu_didong.loaithuebao_chitiet.index', compact('subscriptionType'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $subscriptionTypeId)
    {
        $request->validate([
            'benefits' => 'required|string',
            'pricing' => 'required|string',
            'instructions' => 'required|string',
        ]);
    
        LoaiThueBao::create([
            'subscription_type_id' => $subscriptionTypeId,
            'benefits' => $request->benefits,
            'pricing' => $request->pricing,
            'instructions' => $request->instructions,
        ]);
    
        return redirect()->route('loaithuebao.index', $subscriptionTypeId)->with('success', 'Chi tiết loại thuê bao đã được thêm.');
    }
    

    /**
     * Display the specified resource.
     */
   
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subscriptionTypeId, $id)
{
    $detail = LoaiThueBao::findOrFail($id);
    return response()->json($detail);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $subscriptionTypeId, $id)
{
    $request->validate([
        'benefits' => 'required|string',
        'pricing' => 'required|string',
        'instructions' => 'required|string',
    ]);

    $loaithuebao = LoaiThueBao::findOrFail($id);
    $loaithuebao->update($request->all());

    return redirect()->route('loaithuebao.index', $subscriptionTypeId)->with('success', 'Chi tiết loại thuê bao đã được cập nhật.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subscriptionTypeId, $id)
    {
        $loaithuebao = LoaiThueBao::findOrFail($id);
        $loaithuebao->delete();
    
        return redirect()->route('loaithuebao.index', $subscriptionTypeId)->with('success', 'Chi tiết loại thuê bao đã được xóa.');
    }

    public function details($subscriptionTypeId)
    {
        $subscriptionType = SubscriptionType::with('loaithuebao')->findOrFail($subscriptionTypeId);
    
        // Lấy danh sách các thuê bao khác (ngoại trừ thuê bao hiện tại)
        $otherSubscriptionTypes = SubscriptionType::where('id', '!=', $subscriptionTypeId)
            ->take(2) // Lấy 5 thuê bao khác
            ->get();
    
        return view('frontend.dichvudidong.loaithuebao_chitiet', compact('subscriptionType', 'otherSubscriptionTypes'));
    }
    
    
    
}
