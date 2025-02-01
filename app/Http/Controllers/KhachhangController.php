<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageRegistration;
use Yajra\DataTables\DataTables;

class KhachhangController extends Controller
{
    // Phần gói cước
    public function index()
    {
        // Lấy danh sách đăng ký gói cước (chỉ type = 'goicuoc')
        $subscriptions = PackageRegistration::with('goicuoc')
            ->where('type', 'goicuoc') // Lọc theo type
            ->latest()
            ->paginate(10);
    
        return view('admin.khachhang_dangky.goicuoc.index', compact('subscriptions'));
    }
    

    public function apiSubscriptions(Request $request)
    {
        // Lấy danh sách đăng ký gói cước (chỉ type = 'goicuoc')
        $subscriptions = PackageRegistration::with('goicuoc')
            ->where('type', 'goicuoc') // Lọc theo type
            ->select('package_registrations.*');
    
        return DataTables::of($subscriptions)
            ->addColumn('ten_goicuoc', function ($subscription) {
                return $subscription->goicuoc->ten_goicuoc ?? 'N/A';
            })
            ->addColumn('gia', function ($subscription) {
                return number_format($subscription->goicuoc->gia ?? 0, 0, ',', '.') . ' VNĐ';
            })
            ->addColumn('created_at', function ($subscription) {
                return $subscription->created_at->format('d/m/Y H:i');
            })
            ->make(true);
    }
    

    // Phần gói data
    public function data()
    {
        // Lấy danh sách đăng ký gói data
        $subscriptions2 = PackageRegistration::with('goidata')->latest()->paginate(10);

        return view('admin.khachhang_dangky.goidata.index', compact('subscriptions2'));
    }

    public function apiSubscriptions2(Request $request)
    {
        $subscriptions = PackageRegistration::with('goiData')
            ->where('type', 'goidata') // Chỉ lấy các bản ghi có type là goidata
            ->select('package_registrations.*');
    
        return DataTables::of($subscriptions)
            ->addColumn('ten_data', function ($subscription) {
                return $subscription->goiData->ten_data ?? 'N/A';
            })
            ->addColumn('gia', function ($subscription) {
                return number_format($subscription->goiData->gia ?? 0, 0, ',', '.') . ' VNĐ';
            })
            ->addColumn('created_at', function ($subscription) {
                return $subscription->created_at->format('d/m/Y H:i');
            })
            ->make(true);
    }
    
    
}
