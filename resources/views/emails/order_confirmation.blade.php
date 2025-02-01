<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đặt hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h2 {
            font-size: 20px;
            color: #333333;
        }

        .email-body p {
            margin: 10px 0;
            line-height: 1.6;
            color: #555555;
        }

        .email-body strong {
            color: #333333;
        }

        .email-footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }

        .divider {
            border-top: 1px solid #dddddd;
            margin: 20px 0;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Xác nhận đặt hàng từ MobiFone</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Chào {{ $orderDetails['customer_name'] }},</h2>
            <p>Cảm ơn bạn đã đặt hàng tại MobiFone. Dưới đây là thông tin đơn hàng của bạn:</p>

            <p><strong>Mã đơn hàng:</strong> {{ $orderDetails['order_code'] }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($orderDetails['total_amount']) }}đ</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $orderDetails['payment_method'] }}</p>

            <div class="divider"></div>

            <!-- Kiểm tra nếu SIM là eSIM thì hiển thị QR Code -->
            @if (!empty($orderDetails['sim_type']) && $orderDetails['sim_type'] === 'eSIM' && !empty($orderDetails['qr_code']))
            <div class="text-center">
                <h4>Quét mã QR để kích hoạt eSIM:</h4>
                <img src="{{ $qr_code_url }}" alt="QR Code" width="300">
            </div>
        @endif
        
        

            <!-- Hiển thị địa chỉ giao hàng nếu là SIM vật lý -->
            @if (!empty($orderDetails['sim_type']) && $orderDetails['sim_type'] !== 'eSIM')
                <p><strong>Địa chỉ giao hàng:</strong></p>
                <p>{{ $orderDetails['address'] }}</p>
            @endif

            <p>
                Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hoặc hotline.
            </p>

            <a href="{{ route('frontend.home') }}" class="btn-primary">Xem thêm sản phẩm</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Trân trọng,<br>Đội ngũ MobiFone</p>
        </div>
    </div>
</body>

</html>
