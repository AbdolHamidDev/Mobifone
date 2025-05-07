@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Khách hàng đăng ký hòa mạng" />

<div class="card">
    <div class="card-body">
        <table id="orders-table" class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Số Thuê Bao</th>
                    <th>Ngày tạo</th>
                    <th>Thanh toán</th>
                    <th>Nhận hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td class="text-center">{{ $order->id }}</td>
                        <td class="text-center">
                            <a href="#" class="text-primary" data-id="{{ $order->id }}" onclick="showOrderDetails(event)">
                                {{ $order->soThueBao->so_thue_bao ?? 'Không xác định' }}
                            </a>
                        </td>
                        <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <button 
                                class="btn btn-sm btn-toggle-payment {{ $order->trang_thai === 'hoa_mang' ? 'btn-success' : 'btn-warning' }}" 
                                onclick="togglePaymentStatus({{ $order->id }})"
                                data-id="{{ $order->id }}">
                                {{ $order->trang_thai === 'hoa_mang' ? 'Hòa mạng' : 'Giữ số' }}
                            </button>
                        </td>
                        <td class="text-center">
                            <button 
                                class="btn btn-sm btn-toggle-delivery {{ $order->da_nhan_hang ? 'btn-success' : 'btn-danger' }}" 
                                onclick="toggleDeliveryStatus({{ $order->id }})"
                                data-id="{{ $order->id }}"
                                {{ $order->trang_thai !== 'hoa_mang' ? 'disabled' : '' }}>
                                {{ $order->da_nhan_hang ? 'Đã nhận' : 'Chưa nhận' }}
                            </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info btn-sm text-white" data-id="{{ $order->id }}" onclick="showOrderDetails(event)">
                                Xem chi tiết
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal chi tiết đơn hàng -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Thông tin khách hàng</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Khách hàng</th><td id="customer-name"></td></tr>
                        <tr><th>Số điện thoại</th><td id="phone"></td></tr>
                        <tr><th>Email</th><td id="email"></td></tr>
                        <tr id="address-row"><th>Địa chỉ</th><td id="address"></td></tr>
                    </tbody>
                </table>

                <h4 class="text-center mt-4">Thông tin đơn hàng</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Loại SIM</th><td id="sim-type"></td></tr>
                        <tr><th>Gói cước</th><td id="goi-cuoc"></td></tr>
                        <tr><th>Trạng thái</th><td id="trang-thai"></td></tr>
                        <tr><th>Thanh toán</th><td id="payment-method"></td></tr>
                        <tr><th>Giao hàng</th><td id="delivery-method"></td></tr>
                        <tr><th>Phí kích hoạt</th><td id="activation-fee"></td></tr>
                        <tr><th>Giá gói cước</th><td id="package-price"></td></tr>
                        <tr><th>Tổng tiền</th><td id="total-amount" class="fw-bold"></td></tr>
                        <tr><th>Ngày tạo</th><td id="created-at"></td></tr>
                    </tbody>
                </table>

                <div id="qr-code-container" class="text-center mt-4 d-none">
                    <h5>Mã QR Code</h5>
                    <img id="qr-code-img" src="" alt="QR Code">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
// Khởi tạo DataTable
$(document).ready(function() {
    $('#orders-table').DataTable({
        language: {
            lengthMenu: "Hiển thị _MENU_ mục",
            zeroRecords: "Không tìm thấy kết quả",
            info: "Hiển thị _PAGE_ trên _PAGES_",
            infoEmpty: "Không có dữ liệu",
            infoFiltered: "(lọc từ _MAX_ mục)",
            search: "Tìm kiếm:",
            paginate: { next: "Tiếp", previous: "Trước" }
        },
        pageLength: 10
    });
});

// Hiển thị chi tiết đơn hàng
async function showOrderDetails(event) {
    event.preventDefault();
    const orderId = event.target.getAttribute('data-id');
    if (!orderId) return;

    try {
        const response = await fetch(`/admin/orders/${orderId}`);
        const data = await response.json();
        
        // Cập nhật thông tin khách hàng
        document.getElementById('customer-name').textContent = data.customer_name;
        document.getElementById('phone').textContent = data.phone;
        document.getElementById('email').textContent = data.email;
        document.getElementById('address').textContent = `${data.address}, ${data.ward}, ${data.district}, ${data.province}`;

        // Cập nhật thông tin đơn hàng
        document.getElementById('sim-type').textContent = data.sim_type;
        document.getElementById('goi-cuoc').textContent = data.goi_cuoc_id;
        document.getElementById('trang-thai').textContent = data.trang_thai;
        document.getElementById('payment-method').textContent = data.payment_method;
        document.getElementById('activation-fee').textContent = formatCurrency(data.activation_fee);
        document.getElementById('package-price').textContent = formatCurrency(data.package_price);
        document.getElementById('total-amount').textContent = formatCurrency(data.total_amount);
        document.getElementById('created-at').textContent = new Date(data.created_at).toLocaleString();

        // Xử lý phương thức giao hàng
        document.getElementById('delivery-method').textContent = 
            data.shipping_fee == 25000 ? "Giao hàng tiết kiệm" : 
            data.shipping_fee == 30000 ? "Giao hàng nhanh" : "Mua hàng online Esim";

        // Xử lý địa chỉ cho eSIM
        document.getElementById('address-row').style.display = 
            data.sim_type === 'eSIM' ? 'none' : '';

        // Xử lý QR Code
        const qrContainer = document.getElementById('qr-code-container');
        if (data.qr_code && data.qr_code !== 'NO_QR_CODE') {
            const qrCodePath = data.qr_code.startsWith('storage/') 
                ? `/${data.qr_code}` 
                : `/storage/${data.qr_code}`;
            
            document.getElementById('qr-code-img').src = qrCodePath;
            qrContainer.classList.remove('d-none');
        } else {
            qrContainer.classList.add('d-none');
        }

        // Hiển thị modal
        new bootstrap.Modal(document.getElementById('orderDetailsModal')).show();
    } catch (error) {
        console.error('Lỗi khi lấy thông tin đơn hàng:', error);
    }
}

// Hàm thay đổi trạng thái thanh toán
async function togglePaymentStatus(orderId) {
    // Tìm nút liên quan đến đơn hàng cụ thể
    const button = document.querySelector(`button[onclick="togglePaymentStatus(${orderId})"]`);
    if (!button) {
        console.error("Không tìm thấy nút để thay đổi trạng thái thanh toán!");
        return;
    }

    // Lưu nội dung ban đầu của nút
    const originalContent = button.innerHTML;

    // Tạm thời vô hiệu hóa nút và thông báo đang xử lý
    button.disabled = true;
    button.innerHTML = 'Đang xử lý...';

    try {
        // Gửi yêu cầu POST đến server để thay đổi trạng thái
        const response = await fetch(`/admin/orders/${orderId}/toggle-payment`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        });

        // Kiểm tra phản hồi HTTP
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Phân tích dữ liệu JSON từ server
        const data = await response.json();

        // Cập nhật giao diện nếu server trả về thành công
        if (data.success) {
            const isPaid = data.newStatus === "hoa_mang";

            // Cập nhật lớp CSS và nội dung của nút thanh toán
            button.className = `btn btn-sm btn-toggle-payment ${isPaid ? 'btn-success' : 'btn-warning'}`;
            button.innerHTML = isPaid ? 'Hòa mạng' : 'Giữ số';

            // Cập nhật nút trạng thái nhận hàng (nếu có)
            const deliveryButton = document.querySelector(`button[onclick="toggleDeliveryStatus(${orderId})"]`);
            if (deliveryButton) {
                deliveryButton.disabled = !isPaid;
            }
        } else {
            // Xử lý lỗi từ server
            console.error("Lỗi từ server:", data.message || "Không rõ lỗi");
            alert(data.message || "Có lỗi xảy ra, vui lòng thử lại.");
        }
    } catch (error) {
        // Xử lý lỗi kết nối hoặc lỗi không mong muốn
        console.error("Lỗi xảy ra khi gửi yêu cầu:", error);
        alert("Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.");
    } finally {
        // Khôi phục trạng thái ban đầu của nút
        button.disabled = false;
    }
}

// Hàm thay đổi trạng thái nhận hàng
async function toggleDeliveryStatus(orderId) {
    // Tìm nút liên quan đến đơn hàng cụ thể
    const button = document.querySelector(`button[onclick="toggleDeliveryStatus(${orderId})"]`);
    if (!button) {
        console.error("Không tìm thấy nút để thay đổi trạng thái nhận hàng!");
        return;
    }

    // Lưu nội dung ban đầu của nút
    const originalContent = button.innerHTML;

    // Tạm thời vô hiệu hóa nút và thông báo đang xử lý
    button.disabled = true;
    button.innerHTML = 'Đang xử lý...';

    try {
        // Gửi yêu cầu POST đến server để thay đổi trạng thái
        const response = await fetch(`/admin/orders/${orderId}/toggle-delivery`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        });

        // Kiểm tra phản hồi HTTP
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Phân tích dữ liệu JSON từ server
        const data = await response.json();

        // Cập nhật giao diện nếu server trả về thành công
        if (data.success) {
            // Cập nhật lớp CSS và nội dung của nút
            button.className = `btn btn-sm btn-toggle-delivery ${data.isDelivered ? 'btn-success' : 'btn-danger'}`;
            button.innerHTML = data.isDelivered ? 'Đã nhận' : 'Chưa nhận';
        } else {
            // Xử lý lỗi từ server
            console.error("Lỗi từ server:", data.message || "Không rõ lỗi");
            alert(data.message || "Có lỗi xảy ra, vui lòng thử lại.");
        }
    } catch (error) {
        // Xử lý lỗi kết nối hoặc lỗi không mong muốn
        console.error("Lỗi xảy ra khi gửi yêu cầu:", error);
        alert("Có lỗi xảy ra khi kết nối đến server. Vui lòng thử lại.");
    } finally {
        // Khôi phục trạng thái ban đầu của nút
        button.disabled = false;
    }
}
// Hàm phụ trợ định dạng tiền tệ
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
}
</script>
@endsection