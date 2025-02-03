<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đặt hàng - MobiFone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 650px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: #ffffff;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .email-header img {
            max-width: 120px;
        }

        .email-body {
            padding: 25px;
        }

        .email-body h2 {
            font-size: 22px;
            color: #333333;
        }

        .email-body p {
            margin: 10px 0;
            line-height: 1.6;
            color: #555555;
        }

        .highlight {
            font-weight: bold;
            color: #007bff;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details-table th, .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .details-table th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        .qr-code-container {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code {
            width: 180px;
            height: auto;
            border: 4px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .email-footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666666;
            border-top: 1px solid #ddd;
        }

        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Xác nhận đặt hàng</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Chào {{ $orderDetails['customer_name'] }},</h2>
            <p>Cảm ơn bạn đã đặt hàng tại <strong>MobiFone</strong>. Dưới đây là thông tin đơn hàng của bạn:</p>

            <p><strong>Mã giữ số:</strong> <span class="highlight">{{ $orderDetails['order_code'] }}</span></p>

            <!-- Bảng chi tiết đơn hàng -->
            <table class="details-table">
                <tr>
                    <th>Mục</th>
                    <th>Chi tiết</th>
                </tr>
                <tr>
                    <td>Loại SIM</td>
                    <td>{{ $orderDetails['sim_type'] }}</td>
                </tr>

                @if (!empty($orderDetails['is_esim']) && $orderDetails['is_esim'])
                <tr>
                    <td>QR Code</td>
                    <td>
                        <div class="qr-code-container">
                            <h4>Quét mã QR để kích hoạt eSIM:</h4>
                            <img src="{{ $orderDetails['qr_code'] }}" alt="QR Code" class="qr-code">
                        </div>
                    </td>
                </tr>
                @else
                    <tr>
                        <td>Gói cước</td>
                        <td>{{ $orderDetails['ten_goicuoc'] }}</td>
                    </tr>
                    <tr>
                        <td>Phí kích hoạt</td>
                        <td>{{ number_format($orderDetails['activation_fee']) }}đ</td>
                    </tr>
                    <tr>
                        <td>Giá gói cước</td>
                        <td>{{ number_format($orderDetails['package_price']) }}đ</td>
                    </tr>
                    <tr>
                        <td>Phí vận chuyển</td>
                        <td>
                            {{ number_format($orderDetails['shipping_fee']) }}đ 
                            ({{ $orderDetails['shipping_fee'] == 0 ? 'Hình thức online' : ($orderDetails['shipping_fee'] == 25000 ? 'Giao hàng tiết kiệm' : 'Giao hàng nhanh') }})
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tổng tiền</strong></td>
                        <td><strong class="highlight">{{ number_format($orderDetails['total_amount']) }}đ</strong></td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán</td>
                        <td>{{ $orderDetails['payment_method'] }}</td>
                    </tr>
                @endif
            </table>

            @if (!empty($orderDetails['sim_type']) && $orderDetails['sim_type'] !== 'eSIM')
                <p><strong>Địa chỉ giao hàng:</strong></p>
                <p>{{ $orderDetails['address'] }}</p>
            @endif

            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hoặc hotline hỗ trợ.</p>

            <a href="{{ url('/') }}" class="btn-primary">Xem thêm sản phẩm</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Trân trọng,<br>Đội ngũ <strong>MobiFone</strong></p>
            <p>Hotline hỗ trợ: <a href="tel:18001090">1800 1090</a></p>
            <p>Email: <a href="mailto:hotro@mobifone.vn">hotro@mobifone.vn</a></p>
        </div>
    </div>
</body>
</html>
