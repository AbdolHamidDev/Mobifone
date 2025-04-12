@extends('layouts.admin')

@section('content')
<x-layout.content-header name="khách hàng" key="đăng ký hòa mạng" />

<div class="card">
  
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <table id="orders-table" class="table table-striped table-hover align-middle">
                <thead class="table-dark">
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
                                <a href="#" class="text-primary fw-bold" data-id="{{ $order->id }}" onclick="showOrderDetails(event)">
                                    📞 {{ $order->soThueBao->so_thue_bao ?? 'Không xác định' }}
                                </a>
                            </td>
                            <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                     <!-- Trạng thái Thanh toán -->
<td class="text-center">
    <button 
        class="btn btn-sm fw-bold btn-toggle-payment {{ $order->trang_thai === 'hoa_mang' ? 'btn-success' : 'btn-warning' }}" 
        onclick="togglePaymentStatus({{ $order->id }})">
        <i class="fas {{ $order->trang_thai === 'hoa_mang' ? 'fa-check-circle' : 'fa-clock' }}"></i> 
        {{ $order->trang_thai === 'hoa_mang' ? 'Hòa mạng' : 'Giữ số' }}
    </button>
</td>

<!-- Trạng thái Nhận hàng -->
<td class="text-center">
    <button 
        class="btn btn-sm fw-bold btn-toggle-delivery {{ $order->da_nhan_hang ? 'btn-success' : 'btn-danger' }}" 
        onclick="toggleDeliveryStatus({{ $order->id }})"
        data-id="{{ $order->id }}"
        {{ $order->trang_thai !== 'hoa_mang' ? 'disabled' : '' }}>  
        <i class="fas {{ $order->da_nhan_hang ? 'fa-box' : 'fa-truck-loading' }}"></i> 
        {{ $order->da_nhan_hang ? 'Đã nhận' : 'Chưa nhận' }}
    </button>
</td>

                            
                            <!-- Nút Xem chi tiết -->
                            <td class="text-center">
                                <button class="btn btn-info btn-sm fw-bold text-white" data-id="{{ $order->id }}" onclick="showOrderDetails(event)">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </button>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

<!-- Modal hiển thị chi tiết đơn hàng -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="fw-bold text-center text-success">Thông tin khách hàng</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Khách hàng</th>
                            <td id="customer-name"></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td id="phone"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="email"></td>
                        </tr>
                        <tr id="address-row">
                            <th>Địa chỉ</th>
                            <td id="address"></td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="fw-bold text-center text-primary mt-4">Thông tin đơn hàng</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Loại SIM</th>
                            <td id="sim-type"></td>
                        </tr>
                        <tr>
                            <th>Gói cước</th>
                            <td id="goi-cuoc"></td>
                        </tr>
                        <tr>
                            <th>Trạng thái đơn hàng</th>
                            <td id="trang-thai"></td>
                        </tr>
                        <tr>
                            <th>Phương thức thanh toán</th>
                            <td id="payment-method"></td>
                        </tr>
                        <tr>
                            <th>Phương thức giao hàng</th>
                            <td id="delivery-method"></td>
                        </tr>
                        <tr>
                            <th>Phí kích hoạt</th>
                            <td id="activation-fee"></td>
                        </tr>
                        <tr>
                            <th>Giá gói cước</th>
                            <td id="package-price"></td>
                        </tr>
                        <tr>
                            <th>Phí giao hàng</th>
                            <td id="shipping-fee"></td>
                        </tr>
                        <tr class="bg-light">
                            <th><strong>Tổng tiền</strong></th>
                            <td id="total-amount" class="fw-bold text-danger"></td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td id="created-at"></td>
                        </tr>

                        
                        <tr>
                            <th>QR Code</th>
                            <td>
                                <div id="qr-code-container"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Hiển thị QR Code nếu có -->
                <div id="qr-code-container" class="text-center mt-4" style="display: none;">
                    <h5>Mã QR Code của khách hàng</h5>
                    <img id="qr-code-img" src="" alt="QR Code" style="width: 180px; border: 5px solid #ddd; padding: 10px; background: #fff;">
                    <p class="text-muted">Tên file: <strong id="qr-code-file"></strong></p>
                    <p class="text-muted">Quét mã này để kích hoạt eSIM</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


<!-- Data table và hiện QR -->
<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục",
                "zeroRecords": "Không tìm thấy kết quả",
                "info": "Hiển thị _PAGE_ trên _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ mục)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            },
            "pageLength": 10,
            "ordering": true,
            "responsive": true
        });
    });

    function showOrderDetails(event) {
    event.preventDefault();
    const orderId = event.target.getAttribute('data-id');

    if (!orderId) {
        console.error('Không tìm thấy Order ID.');
        return;
    }

    fetch(`/admin/orders/${orderId}`)
        .then(response => response.json())
        .then(data => {
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
            document.getElementById('activation-fee').textContent = `${Intl.NumberFormat().format(data.activation_fee)}đ`;
            document.getElementById('package-price').textContent = `${Intl.NumberFormat().format(data.package_price)}đ`;
            document.getElementById('total-amount').textContent = `${Intl.NumberFormat().format(data.total_amount)}đ`;
            document.getElementById('created-at').textContent = new Date(data.created_at).toLocaleString();

            // ✅ Xử lý phương thức giao hàng
            const deliveryMethod = document.getElementById('delivery-method');
            if (data.shipping_fee == 25000) {
                deliveryMethod.textContent = "Giao hàng tiết kiệm";
            } else if (data.shipping_fee == 30000) {
                deliveryMethod.textContent = "Giao hàng nhanh";
            } else {
                deliveryMethod.textContent = "Hình thức mua hàng online Esim"; // Trường hợp khác
            }

            // ✅ Kiểm tra nếu là eSIM thì ẩn mục "Địa chỉ"
            const addressRow = document.getElementById('address').closest('tr');
            if (data.sim_type === 'eSIM') {
                addressRow.style.display = 'none';
            } else {
                addressRow.style.display = '';
            }

            // ✅ Xử lý QR Code nếu có
            const qrCodeContainer = document.getElementById('qr-code-container');
            if (data.qr_code && data.qr_code !== 'NO_QR_CODE') {
                const qrCodePath = data.qr_code.startsWith('storage/') 
                    ? `/${data.qr_code}` 
                    : `/storage/${data.qr_code}`;

                qrCodeContainer.innerHTML = `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px;">
                        <h5 style="font-size: 1.2rem; color: #333; margin-bottom: 10px;">Mã QR Code của bạn</h5>
                        <img src="${qrCodePath}" alt="QR Code" 
                            style="width: 180px; height: auto; border: 5px solid #ddd; border-radius: 10px; padding: 10px; background: #fff;">
                        <p style="font-size: 0.9rem; color: #666; margin-top: 8px;">Tên file: <strong>${data.qr_code.split('/').pop()}</strong></p>
                        <p style="font-size: 0.9rem; color: #666;">Quét mã này để kích hoạt eSIM</p>
                    </div>
                `;
                qrCodeContainer.style.display = 'block';
            } else {
                qrCodeContainer.innerHTML = ''; // Ẩn nếu không có QR Code
                qrCodeContainer.style.display = 'none';
            }

            // ✅ Hiển thị modal sau khi cập nhật dữ liệu
            const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Lỗi khi lấy thông tin đơn hàng:', error);
        });
}




</script>

<!-- Thay đổi trạng thái thanh toán -->
<script>
   function togglePaymentStatus(orderId) {
    const button = document.querySelector(`button[onclick="togglePaymentStatus(${orderId})"]`);
    const deliveryButton = document.querySelector(`button[onclick="toggleDeliveryStatus(${orderId})"]`);
    const originalText = button.innerHTML; // Lưu nội dung gốc của nút

    button.disabled = true; // Vô hiệu hóa nút khi xử lý
    button.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Đang xử lý`; // Hiệu ứng loading

    fetch(`/admin/orders/${orderId}/toggle-payment`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const isPaid = data.newStatus === "hoa_mang";

            // ✅ Cập nhật giao diện nút "Hòa mạng"
            button.classList.toggle("btn-warning", !isPaid);
            button.classList.toggle("btn-success", isPaid);
            button.innerHTML = isPaid 
                ? `<i class="fas fa-check-circle"></i> Hòa mạng`
                : `<i class="fas fa-clock"></i> Giữ số`;

            // ✅ Cập nhật trạng thái "Nhận hàng" ngay lập tức
            if (isPaid) {
                deliveryButton.removeAttribute("disabled");
            } else {
                deliveryButton.setAttribute("disabled", "true");
            }
        } else {
            console.error("Lỗi:", data.message);
        }
    })
    .catch(error => {
        console.error("Lỗi:", error);
    })
    .finally(() => {
        button.disabled = false; // Kích hoạt lại nút
    });
}

</script>


<!-- Thay đổi trạng thái nhận hàng -->
<script>
   // ✅ Cập nhật trạng thái "Nhận hàng"
function toggleDeliveryStatus(orderId) {
    fetch(`/admin/orders/${orderId}/toggle-delivery`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cập nhật nút "Nhận hàng"
            const deliveryButton = document.querySelector(`button[onclick="toggleDeliveryStatus(${orderId})"]`);

            if (data.isDelivered) {
                deliveryButton.classList.remove("btn-danger");
                deliveryButton.classList.add("btn-success");
                deliveryButton.innerHTML = `<i class="fas fa-box"></i> Đã nhận`;
            } else {
                deliveryButton.classList.remove("btn-success");
                deliveryButton.classList.add("btn-danger");
                deliveryButton.innerHTML = `<i class="fas fa-truck-loading"></i> Chưa nhận`;
            }
        }
    })
    .catch(error => console.error("Lỗi khi thay đổi trạng thái nhận hàng:", error));
}

</script>


<style>
    /* Tăng độ tròn và hiệu ứng shadow cho bảng */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Nút trạng thái thanh toán */
.btn-toggle-payment, .btn-toggle-delivery {
    transition: all 0.3s ease-in-out;
    padding: 8px 12px;
    border-radius: 8px;
}

/* Hover hiệu ứng mượt mà */
.btn-toggle-payment:hover, .btn-toggle-delivery:hover {
    filter: brightness(90%);
}

/* Hiệu ứng hover cho nút "Xem chi tiết" */
.btn-info {
    background: #17a2b8;
    border: none;
}

.btn-info:hover {
    background: #138496;
}

/* Icon cho trạng thái */
.btn-toggle-payment i, .btn-toggle-delivery i {
    margin-right: 5px;
}


/* Làm nút "Nhận hàng" mờ đi khi bị khóa */
.btn-toggle-delivery:disabled {
    background-color: #cccccc !important;
    border-color: #cccccc !important;
    cursor: not-allowed;
}

</style>
@endsection
