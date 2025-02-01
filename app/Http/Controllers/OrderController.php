<?php

namespace App\Http\Controllers;

use App\Models\Goicuoc;
use App\Models\Order;
use App\Models\SoThueBao;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    public function store(Request $request)
    {
        if ($request->has('temp_id')) {
            $tempId = $request->input('temp_id');
            $cachedData = Cache::get($tempId);

            if (!$cachedData) {
                return redirect()->back()->withErrors('Dữ liệu không hợp lệ hoặc đã hết hạn!');
            }

            // Merge dữ liệu từ cache vào request
            $request->merge([
                'so_thue_bao_id' => $cachedData['so_thue_bao_id'],
                'goi_cuoc_id' => $cachedData['goi_cuoc_id'],
                'sim_type' => $request->input('sim_type', 'SIM Vật lý'),
                'customer_name' => $request->input('customer_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'province' => $request->input('province_name'),
                'district' => $request->input('district_name'),
                'ward' => $request->input('ward_name'),
                'address' => $request->input('address'),
                'delivery_method' => $request->input('delivery_method'),
                'payment_method' => $request->input('payment_method'),
                'activation_fee' => $cachedData['activation_fee'] ?? 0,
                'package_price' => $cachedData['package_price'] ?? 0,
                'shipping_fee' => $request->input('shipping_fee', 0),
                'total_amount' => $cachedData['activation_fee'] + $cachedData['package_price'] + $request->input('shipping_fee', 0),
            ]);
        }

        // Xử lý eSIM: Bỏ qua thông tin địa chỉ và giao hàng nếu chọn eSIM
        $isEsim = $request->input('sim_type') === 'eSIM';

        
        // Validate dữ liệu
        $validated = $request->validate([
            'so_thue_bao_id' => 'required|exists:so_thue_bao,id',
            'goi_cuoc_id' => 'required|exists:goicuocs,id',
            'sim_type' => 'required|string|max:50',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'province' => $isEsim ? 'nullable' : 'required|string|max:255',
            'district' => $isEsim ? 'nullable' : 'required|string|max:255',
            'ward' => $isEsim ? 'nullable' : 'required|string|max:255',
            'address' => $isEsim ? 'nullable' : 'required|string|max:500',
            'delivery_method' => $isEsim ? 'nullable' : 'required|string|max:50',
            'payment_method' => 'required|string|max:50',
            'activation_fee' => 'required|numeric',
            'package_price' => 'required|numeric',
            'shipping_fee' => $isEsim ? 'nullable|numeric' : 'required|numeric',
            'total_amount' => 'required|numeric',
        ]);
// Nếu là eSIM, phí ship luôn = 0, nếu không thì lấy từ request
$shippingFee = $isEsim ? 0 : ($request->input('shipping_fee') ?? 25000); // Mặc định 25,000đ nếu không có giá trị
        // Tính tổng tiền
        $totalAmount = $validated['activation_fee'] + $validated['package_price'] + ($isEsim ? 0 : $validated['shipping_fee']);

        $qrCodePath = null;

        if ($isEsim && !empty($validated['email'])) {
            $qrCodeData = "eSIM Order for: {$validated['email']}";
        
            try {
                // ✅ Tạo QR Code dưới dạng SVG
                $renderer = new ImageRenderer(
                    new RendererStyle(300),
                    new SvgImageBackEnd() // Sử dụng SVG
                );
        
                $writer = new Writer($renderer);
                $qrCodeImage = $writer->writeString($qrCodeData); // Đây là chuỗi SVG
        
                // ✅ Lưu QR Code vào storage dưới dạng SVG
                $fileName = 'qrcodes/order_' . time() . '.svg';
                Storage::disk('public')->put($fileName, $qrCodeImage);
        
                // ✅ Lưu đường dẫn để lưu vào DB
                $qrCodePath = 'storage/' . $fileName;
        
            } catch (\Exception $e) {
                \Log::error('Lỗi tạo QR Code: ' . $e->getMessage());
            }
        }
        

        // Lưu đơn hàng vào cơ sở dữ liệu
        $orderData = array_merge($validated, [
            'shipping_fee' => $shippingFee, // ✅ Lưu đúng phí ship
            'total_amount' => $totalAmount,
            'qr_code' => $qrCodePath ?? 'NO_QR_CODE',
        ]);
        

        $order = Order::create($orderData);

        // Xóa Cache
        Cache::forget($tempId);

        // Đặt flash session để hiển thị trên trang success
        session()->flash('order_complete', true);
        session()->flash('order_code', $order->id);
        session()->flash('customer_name', $order->customer_name);
        session()->flash('total_amount', $order->total_amount);
        session()->flash('sim_type', $validated['sim_type']); // ✅ Lưu loại SIM vào session
        session()->flash('qr_code', asset($order->qr_code)); // ✅ Trả về URL ảnh QR Code

        // Gửi email xác nhận nếu có email
        $qrCodeUrl = !empty($order->qr_code) ? asset($order->qr_code) : null;

if (!empty($validated['email'])) {
    Mail::to($validated['email'])->send(new OrderConfirmationMail([
        'customer_name' => $order->customer_name,
        'order_code' => $order->id,
        'total_amount' => $totalAmount,
        'payment_method' => $order->payment_method,
        'qr_code' => $qrCodeUrl, // ✅ Gửi đường dẫn QR Code hoặc null nếu không có
    ]));
}


        // Chuyển hướng đến trang thành công
        return redirect()->route('frontend.orders.success');
    }





    public function step2(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'so_thue_bao_id' => 'required|exists:so_thue_bao,id',
            'goi_cuoc_id' => 'required|exists:goicuocs,id',
        ]);
    
        // Lấy thông tin số thuê bao và gói cước từ cơ sở dữ liệu
        $soThueBao = SoThueBao::findOrFail($validated['so_thue_bao_id']);
        $goiCuoc = Goicuoc::findOrFail($validated['goi_cuoc_id']);
    
        // Tạo temp_id và lưu tất cả thông tin vào cache
        $tempId = 'temp_order_' . uniqid(); // Tạo ID tạm thời
        $dataToCache = [
            'so_thue_bao_id' => $soThueBao->id,
            'goi_cuoc_id' => $goiCuoc->id,
            'loai_thue_bao' => $soThueBao->loai_thue_bao,
            'activation_fee' => $soThueBao->phi_hoa_mang, // Đổi key để đồng nhất
            'package_price' => $goiCuoc->gia,             // Đổi key để đồng nhất
            'phi_giu_so' => $soThueBao->phi_giu_so,
            'khu_vuc' => $soThueBao->khu_vuc,
            'loai_so' => $soThueBao->loai_so,
            'ten_goi_cuoc' => $goiCuoc->ten_goicuoc,
            'gia_goi_cuoc' => $goiCuoc->gia,
            'thoi_gian_goi_cuoc' => $goiCuoc->thoi_gian,
            'goi_cuoc_details' => $goiCuoc->details->toArray(), // Nếu gói cước có chi tiết
        ];
        
        
    
        // Lưu dữ liệu vào cache với thời gian hết hạn 15 phút
        Cache::put($tempId, $dataToCache, now()->addMinutes(15));
    
        // Chuyển hướng sang bước 2 với temp_id
        return redirect()->route('frontend.dichvudidong.step2.show', ['temp_id' => $tempId]);
    }
    
    
    


    public function showStep2(Request $request)
    {
        $tempId = $request->input('temp_id');
        $cachedData = Cache::get($tempId);
    
        if (!$cachedData) {
            return redirect()->route('frontend.dichvudidong.step2.show')->withErrors('Dữ liệu không hợp lệ hoặc đã hết hạn!');
        }
    
        $soThueBao = SoThueBao::find($cachedData['so_thue_bao_id']);
        $goiCuoc = Goicuoc::find($cachedData['goi_cuoc_id']);
    
        // Sử dụng activation_fee thay vì phi_hoa_mang
        $activationFee = $cachedData['activation_fee'] ?? 0;
        $giaGoiCuoc = $cachedData['gia_goi_cuoc'] ?? 0;
    
        $totalTienHang = $soThueBao->phi_hoa_mang + ($goiCuoc->gia ?? 0);
    
        return view('frontend.dichvudidong.oder', compact('soThueBao', 'goiCuoc', 'totalTienHang', 'tempId', 'cachedData'));
    }
    
    
    
    
    public function success()
{
    return view('frontend.dichvudidong.success');
}





    public function index()
    {
        // Lấy danh sách ID của số thuê bao đã được sử dụng trong bảng orders
        $usedSoThueBaoIds = Order::pluck('so_thue_bao_id')->toArray();
    
        // Cập nhật trạng thái các số thuê bao thành 'giu_so' nếu đã được sử dụng
        SoThueBao::whereIn('id', $usedSoThueBaoIds)->update(['trang_thai' => 'giu_so']);
    
        // Lấy danh sách orders với mối quan hệ tới số thuê bao
        $orders = Order::with('soThueBao')->latest()->get();
    
        // Lấy tất cả số thuê bao để hiển thị trạng thái
        $soThueBaos = SoThueBao::all();
        
        // Trả về view với dữ liệu số thuê bao và đơn hàng
        return view('admin.khachhang_dangky.oder.index', compact('orders', 'soThueBaos'));
    }
    


    public function show($id)
{
    
    $order = Order::findOrFail($id); // Tìm đơn hàng theo ID
    return response()->json($order); // Trả về dữ liệu JSON để hiển thị trên modal
}


// API: Thay đổi trạng thái thanh toán
public function togglePaymentStatus($id)
{
    $order = Order::findOrFail($id);

    // Chuyển đổi trạng thái
    $newStatus = $order->trang_thai === 'hoa_mang' ? 'giu_so' : 'hoa_mang';
    $order->trang_thai = $newStatus;
    $order->save();

    // Đồng bộ trạng thái với bảng so_thue_bao
    $soThueBao = $order->soThueBao;
    if ($soThueBao) {
        $soThueBao->trang_thai = $newStatus;
        $soThueBao->save();
    }

    return response()->json([
        'success' => true,
        'newStatus' => $newStatus,
    ]);
}




//API: Thay đổi trạng thái nhận hàng

public function toggleDeliveryStatus(Order $order)
{
    if ($order->trang_thai !== 'hoa_mang') {
        return response()->json([
            'success' => false,
            'message' => 'Đơn hàng chưa Hòa mạng, không thể nhận hàng.'
        ], 400);
    }

    // Chuyển đổi trạng thái nhận hàng
    $order->da_nhan_hang = !$order->da_nhan_hang;
    $order->save();

    return response()->json([
        'success' => true,
        'isDelivered' => $order->da_nhan_hang,
    ]);
}





}
