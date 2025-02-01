@extends('layouts.frontend')
<link rel="stylesheet" href="{{ asset('frontends/sothuebao/sothuebao_chitiet.css') }}">
@section('content')
    <div class="container" style="padding-top: 15vh;">

        <div class="text-center mt-4">
            <p>
                Phiên đặt số có hiệu lực trong
                <span id="countdown-timer">15:00</span> phút
            </p>
        </div>

        <div class="progress-container">
            <div class="progress-step completed"> <!-- Bước hoàn thành -->
                <div class="circle"></div>
                <p>Chọn SIM</p>
            </div>
            <div class="progress-line active"></div>
            <div class="progress-step active"> <!-- Bước hiện tại -->
                <div class="circle">2</div>
                <p>Đăng ký</p>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step">
                <div class="circle">3</div>
                <p>Hoàn tất</p>
            </div>
        </div>



        <div class="row">
            <!-- Cột trái: Form nhập thông tin -->
            <div class="col-lg-8">
                <div class="card shadow-sm p-4">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="temp_id" value="{{ $tempId }}">

                   

<!-- Loại SIM -->
<div class="mb-3">
    <label class="form-label">Loại SIM</label>
    <div class="d-flex gap-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sim_type" id="sim_vat_ly" value="SIM Vật lý" checked>
            <label class="form-check-label" for="sim_vat_ly">SIM Vật lý</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sim_type" id="esim" value="eSIM">
            <label class="form-check-label" for="esim">eSIM</label>
        </div>
    </div>

    <!-- Thông báo chỉ hiển thị khi chọn eSIM -->
    <div id="esim_notice" class="mt-2 text-secondary" style="display: none;">
        eSIM là SIM điện tử và chỉ dùng cho các dòng máy hỗ trợ eSIM, vui lòng xem danh sách thiết bị 
        <a href="#" data-bs-toggle="modal" data-bs-target="#esimModal">tại đây</a>!
    </div>
</div>

<!-- Thông tin khách hàng -->
<h5 class="mt-4">Thông tin khách hàng</h5>
<div class="mb-3">
    <label for="customer_name" class="form-label">Họ và tên</label>
    <input type="text" id="customer_name" name="customer_name" class="form-control"
        value="{{ old('customer_name') }}" placeholder="Họ và tên" required>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Số điện thoại</label>
    <input type="text" id="phone" name="phone" class="form-control"
        value="{{ old('phone') }}" placeholder="Số điện thoại" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-control"
        value="{{ old('email') }}" placeholder="Email">
</div>

<!-- Địa chỉ nhận SIM (Ẩn khi chọn eSIM) -->
<div id="address_section">
    <h5 class="mt-4">Địa chỉ nhận SIM</h5>
    <div class="mb-3">
        <label for="province" class="form-label">Tỉnh/Thành phố</label>
        <select id="province" name="province" class="form-control" required>
            <option value="">Chọn Tỉnh/Thành phố</option>
        </select>
        <input type="hidden" id="province_name" name="province_name">
    </div>
    <div class="mb-3">
        <label for="district" class="form-label">Quận/Huyện</label>
        <select id="district" name="district" class="form-control" required>
            <option value="">Chọn Quận/Huyện</option>
        </select>
        <input type="hidden" id="district_name" name="district_name">
    </div>
    <div class="mb-3">
        <label for="ward" class="form-label">Phường/Xã</label>
        <select id="ward" name="ward" class="form-control" required>
            <option value="">Chọn Phường/Xã</option>
        </select>
        <input type="hidden" id="ward_name" name="ward_name">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ cụ thể</label>
        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Địa chỉ cụ thể" required>{{ old('address') }}</textarea>
    </div>
</div>
<!-- Hình thức nhận SIM (Chỉ hiển thị khi chọn eSIM) -->
<div id="qr_code_section" class="text-center mt-4" style="display: none;">
    <h5>Hình thức nhận SIM: <span class="text-primary">QR Code</span></h5>
    <button id="show_qr_code" class="btn btn-success mt-2">Nhận QR Code</button>
</div>

<!-- Phương thức vận chuyển (Ẩn khi chọn eSIM) -->
<div id="delivery_section">
    <h5 class="mt-4">Thông tin vận chuyển và thanh toán</h5>
    <div class="mb-3">
        <label for="delivery_method" class="form-label">Phương thức vận chuyển</label>
        <div id="delivery_options">
            <label class="delivery-option">
                <input type="radio" name="delivery_method" value="25000" checked>
                <img src="http://localhost/mobifone/public/assets/images/logo_ghtk.jpg" alt="GHTK" class="delivery-icon">
                Giao hàng tiết kiệm (25,000đ)
            </label>
            <label class="delivery-option">
                <input type="radio" name="delivery_method" value="30000">
                <img src="http://localhost/mobifone/public/assets/images/logo_ghn.jpg" alt="GHN" class="delivery-icon">
                Giao hàng nhanh (30,000đ)
            </label>
        </div>
    </div>
</div>
<!-- Input ẩn để lưu shipping_fee -->
<input type="hidden" name="shipping_fee" id="shipping_fee_input" value="25000">

<!-- Phương thức thanh toán -->
<div class="mb-3">
    <label for="payment_method" class="form-label">Phương thức thanh toán</label>
    <div id="payment_options">
        <label class="payment-option" id="vietcombank-option">
            <input type="radio" name="payment_method" value="Vietcombank QR" checked id="vietcombank">
            <img src="http://localhost/mobifone/public/assets/images/Icon-Vietcombank.jpg" alt="Vietcombank" class="payment-icon">
            Vietcombank QR
        </label>
        <label class="payment-option" id="cash-option">
            <input type="radio" name="payment_method" value="Tiền mặt khi nhận hàng" id="cash">
            <img src="http://localhost/mobifone/public/assets/images/tienmat.jpg" alt="Tiền mặt" class="payment-icon">
            Thanh toán khi nhận hàng
        </label>
    </div>
</div>
     <!-- Vùng hiển thị QR Code -->
     <div id="qr_code_container" class="mt-3" style="display: none;">
        <p style="color: red; font-style: italic; text-align: center;">Vui lòng chuyển khoản trước khi đặt hàng
        </p>
        <img id="qr_code_image" src="http://localhost/mobifone/public/assets/images/thanhtoan.jpg"
            alt="QR Code" style="max-width: 200px;">
        <p style="color: black; font-style: italic; text-align: center; margin-top: 10px;">
            * Hệ thống sẽ kiểm tra giao dịch trước khi đi đơn
        </p>
    </div>
</div>
    </div>
    
                <div class="col-lg-4">
                    <div class="square-card text-white shadow-sm bg-background-card">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase" style="margin-bottom: 10px;">
                                {{ \App\Helpers\ContentHelper::formatLoaiThueBao($cachedData['loai_thue_bao'] ?? 'khong_xac_dinh') }}
                            </h5>
                        
                            <h3 class="fw-bold text-warning">
                                {{ \App\Helpers\ContentHelper::getSoThueBaoById($cachedData['so_thue_bao_id'] ?? null) }}
                            </h3>
                            
                            <p>Gói cước đăng ký: {{ $cachedData['ten_goi_cuoc'] ?? 'Không xác định' }}</p>
                        
                            <hr class="my-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small>Loại số</small>
                                    <p class="mb-0">
                                        {{ \App\Helpers\ContentHelper::formatLoaiSo($cachedData['loai_so'] ?? 'khong_xac_dinh') }}
                                    </p>
                                </div>
                                
                                <div>
                                    <small>Khu vực hòa mạng</small>
                                    <p class="mb-0">{{ $cachedData['khu_vuc'] ?? 'Không có dữ liệu' }}</p>
                                </div>
                                <div>
                                    <small>Phí giữ số</small>
                                    <p class="mb-0">
                                        {{ $cachedData['phi_giu_so'] == 0 ? 'Miễn phí' : number_format($cachedData['phi_giu_so']) . 'đ' }}
                                    </p>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small>Phí hòa mạng</small>
                                    <p class="fw">{{ number_format($cachedData['activation_fee']) }}đ</p>
                                </div>
                                <div>
                                    <small>Giá gói cước</small>
                                    <p>{{ number_format($cachedData['gia_goi_cuoc']) }}đ</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
               
                
                    <!-- Đơn hàng nằm dưới Step 2 -->
                    <div class="mt-4">
                        <h4 class="fw-bold">Đơn hàng</h4>
                        <div class="card shadow-sm p-4">
                           <!-- Tổng tiền hàng -->
<div class="d-flex justify-content-between mb-2">
    <div>
        <p class="mb-0 text-muted">Tổng tiền hàng</p>
    </div>
    <div>
        <p class="fw-bold" id="total_price">
            {{ number_format($totalTienHang) }}đ
        </p>
    </div>
</div>

<!-- Phí giao hàng -->
<div class="d-flex justify-content-between mb-2">
    <div>
        <p class="mb-0 text-muted">Phí giao hàng</p>
    </div>
    <div>
        <p id="shipping_fee" class="fw-bold">25,000đ</p> <!-- Giá mặc định -->
    </div>
</div>
<hr>

<!-- Tổng tiền -->
<div class="d-flex justify-content-between">
    <div>
        <p class="fw-bold text-muted">Tổng tiền thanh toán</p>
    </div>
    <div>
        <p id="total_payment" class="fw-bold text-success">
            {{ number_format($soThueBao->activation_fee + ($goiCuoc->gia ?? 0) + 25000) }}đ
        </p>
    </div>


                            </div>


                    </div>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label text-muted" for="terms">
                            Tôi đồng ý với <a href="#">Chính sách</a> về mua sim số của MobiFone
                        </label>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Đặt hàng</button>
                    </form>
                    </div>
                </div>


           


           


                  <!-- Modal Esim -->
    <div class="modal fade" id="esimModal" tabindex="-1" aria-labelledby="esimModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="esimModalLabel">Thông tin eSIM và danh sách thiết bị hỗ trợ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Lưu ý:</strong> eSIM là một loại SIM điện tử (sử dụng mã QR) và KHÔNG PHẢI thẻ SIM vật lý lắp vào điện thoại. eSIM không dùng cho các đồng hồ thông minh.</p>

                    <h6>Apple</h6>
                    <ul>
                        <li>iPhone XR (mẫu A2105, từ 2018)</li>
                        <li>iPhone XS (mẫu A2097, từ 2018)</li>
                        <li>iPhone XS Max (mẫu A2101, từ 2018)</li>
                        <li>iPhone 11/ 11 Pro/ 11 Pro Max</li>
                        <li>iPhone SE (mẫu 2020)</li>
                        <li>iPhone 12/ 12mini/ 12 Pro/ 12 Pro Max</li>
                        <li>iPhone 13/ 13 mini/ 13 Pro/ 13 Pro Max</li>
                        <li>iPhone 14/ 14 Plus/ 14 Pro/ 14 Pro Max</li>
                        <li>iPhone 15/ 15 Plus/ 15 Pro/ 15 Pro Max</li>
                    </ul>
                    <p><strong>Lưu ý:</strong> Đối với các dòng máy Lock và mã LL/A (bản Mỹ) và ZA/A (bản Singapore) không hỗ trợ eSIM.</p>

                    <h6>Google</h6>
                    <ul>
                        <li>Google Pixel 7/ 7 Pro</li>
                        <li>Google Pixel 6/ 6a/ 6 Pro</li>
                        <li>Google Pixel 5/ 5a 5G</li>
                        <li>Google Pixel 4/ 4a/ 4a 5G/ 4 XL</li>
                        <li>Google Pixel 3/ 3a/ 3a XL/ 3 XL</li>
                    </ul>

                    <h6>Huawei</h6>
                    <ul>
                        <li>Huawei P40/ P40 4G/ P40 Pro</li>
                        <li>Huawei Mate 40 Pro</li>
                    </ul>

                    <h6>Oppo</h6>
                    <ul>
                        <li>Oppo Reno 5 A/ 6 Pro 5G</li>
                        <li>Oppo Find X3/ X3 Pro/ X5/ X5 Pro</li>
                    </ul>

                    <h6>Samsung</h6>
                    <ul>
                        <li>Samsung Galaxy Fold</li>
                        <li>Samsung Galaxy Note 20/ Note 20 Plus/ Note 20 Ultra</li>
                        <li>Samsung Galaxy S20/ S20+/ S20 Ultra</li>
                        <li>Samsung Galaxy S21 5G/ S21+ 5G/ S21 Ultra 5G</li>
                        <li>Samsung Galaxy S22 5G/ S22 Plus 5G/ S22 Ultra</li>
                        <li>Samsung Galaxy S23/ S23 Plus/ S23 Ultra</li>
                        <li>Samsung Galaxy Z Flip/ Flip3 5G/ Flip 4</li>
                        <li>Samsung Galaxy Z Fold/ Fold 2/ Fold 3 / Fold 4</li>
                    </ul>

                    <h6>Sony</h6>
                    <ul>
                        <li>Sony Xperia 10 III Lite/ 5 IV/ 1 IV</li>
                    </ul>

                    <h6>iPad</h6>
                    <ul>
                        <li>iPad Pro LTE (2018)</li>
                        <li>iPad Pro 11" (mẫu A2068, từ 2020)/ iPad Pro 11 (2021, 2020)</li>
                        <li>iPad Pro 12.9" (mẫu A2069, từ 2020)/ iPad Pro 12.9 (2021, 2020, 2017, 2015)</li>
                        <li>iPad Air (mẫu A2123, từ 2019)/ iPad Air (2022, 2020)</li>
                        <li>iPad (mẫu A2198, từ 2019)</li>
                        <li>iPad Mini (mẫu A2124, từ 2019)/ iPad mini (2021, 2019)/ iPad mini 3/ iPad mini 6</li>
                        <li>iPad 10.2 (2021, 2020, 2019)</li>
                        <li>iPad 9.7 (2016)</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>


        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const esimRadio = document.querySelector('input[value="eSIM"]');
        const simPhysicalRadio = document.querySelector('input[value="SIM Vật lý"]');
        const qrCodeSection = document.getElementById('qr_code_section');
    
        function updateQRCodeVisibility() {
            if (esimRadio.checked) {
                qrCodeSection.style.display = 'block'; // Hiển thị khi chọn eSIM
            } else {
                qrCodeSection.style.display = 'none'; // Ẩn khi chọn SIM vật lý
            }
        }
    
        // Gọi ngay khi trang load để cập nhật trạng thái đúng
        updateQRCodeVisibility();
    
        // Lắng nghe sự kiện thay đổi radio
        esimRadio.addEventListener('change', updateQRCodeVisibility);
        simPhysicalRadio.addEventListener('change', updateQRCodeVisibility);
    });
</script>



<!-- Reset tổng tiền esim -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const esimRadio = document.querySelector('input[value="eSIM"]');
        const simPhysicalRadio = document.querySelector('input[value="SIM Vật lý"]');
        const shippingFeeElement = document.getElementById('shipping_fee');
        const totalPaymentElement = document.getElementById('total_payment');
        const totalPriceElement = document.getElementById('total_price'); // Tổng tiền hàng
    
        function updatePrices() {
            let totalPrice = parseFloat(totalPriceElement.innerText.replace(/[^\d]/g, '')); // Lấy giá trị số từ chuỗi
            let shippingFee = esimRadio.checked ? 0 : 25000; // Nếu chọn eSIM thì phí = 0, ngược lại là 25,000
    
            // Cập nhật giao diện
            shippingFeeElement.innerText = shippingFee.toLocaleString('vi-VN') + 'đ';
            totalPaymentElement.innerText = (totalPrice + shippingFee).toLocaleString('vi-VN') + 'đ';
        }
    
        // Gọi ngay khi trang load
        updatePrices();
    
        // Lắng nghe sự kiện thay đổi trên radio chọn SIM
        esimRadio.addEventListener('change', updatePrices);
        simPhysicalRadio.addEventListener('change', updatePrices);
    });
</script>
    

<!-- ẩn phương thức thanh toán khi nhấn vào esim -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const esimRadio = document.querySelector('input[value="eSIM"]');
        const simPhysicalRadio = document.querySelector('input[value="SIM Vật lý"]');
        const cashOption = document.getElementById('cash-option');
        const vietcombankRadio = document.getElementById('vietcombank');
    
        function updatePaymentOptions() {
            if (esimRadio.checked) {
                cashOption.style.display = 'none'; // Ẩn thanh toán tiền mặt
                vietcombankRadio.checked = true; // Chọn mặc định Vietcombank
            } else {
                cashOption.style.display = 'block'; // Hiện lại tùy chọn tiền mặt
            }
        }
    
        // Gọi khi trang load để đảm bảo trạng thái đúng
        updatePaymentOptions();
    
        // Lắng nghe sự kiện thay đổi trên radio chọn SIM
        esimRadio.addEventListener('change', updatePaymentOptions);
        simPhysicalRadio.addEventListener('change', updatePaymentOptions);
    });
</script>
    





<!-- ẩn phương thức địa chỉ khi nhấn vào Esim -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const simVatLy = document.getElementById("sim_vat_ly"); // Radio button SIM Vật lý
        const esim = document.getElementById("esim"); // Radio button eSIM
        const esimNotice = document.getElementById("esim_notice"); // Thông báo eSIM
        const addressSection = document.getElementById("address_section"); // Phần địa chỉ
        const deliverySection = document.getElementById("delivery_section"); // Phần phương thức vận chuyển
        const qrSection = document.getElementById("qr_code_section"); // Phần nhận QR Code


         // Các trường có `required`
    const requiredFields = [
        document.getElementById("province"),
        document.getElementById("district"),
        document.getElementById("ward"),
        document.getElementById("address")
    ];
        // Hàm ẩn/hiện các phần tùy thuộc vào loại SIM được chọn
        function toggleEsimOptions() {
        if (esim.checked) {
            esimNotice.style.display = "block"; // Hiện thông báo eSIM
            addressSection.style.display = "none"; // Ẩn địa chỉ
            deliverySection.style.display = "none"; // Ẩn phương thức vận chuyển
            qrSection.style.display = "block"; // Hiện nút Nhận QR Code
            // Xóa thuộc tính required
            requiredFields.forEach(field => field.removeAttribute("required"));
        } else {
            esimNotice.style.display = "none"; // Ẩn thông báo eSIM
            addressSection.style.display = "block"; // Hiện địa chỉ
            deliverySection.style.display = "block"; // Hiện phương thức vận chuyển
            
            // Thêm lại thuộc tính required
            requiredFields.forEach(field => field.setAttribute("required", "required"));
        }
    }

        // Gán sự kiện thay đổi radio button
        simVatLy.addEventListener("change", toggleEsimOptions);
        esim.addEventListener("change", toggleEsimOptions);

        // Kiểm tra trạng thái ban đầu khi tải trang
        toggleEsimOptions();
    });
</script>

    

<!-- Thời gian -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const endTimeKey = 'countdownEndTime'; // Key lưu trữ trong localStorage
        const timerElement = document.getElementById('countdown-timer');
    
        function resetTimer() {
            const currentTime = new Date().getTime();
            const newEndTime = currentTime + 15 * 60 * 1000; // 15 phút từ hiện tại
            localStorage.setItem(endTimeKey, newEndTime);
        }
    
        function updateCountdown() {
            const now = new Date().getTime();
            const endTime = localStorage.getItem(endTimeKey);
            
            if (!endTime || now >= endTime) {
                // Nếu không có thời gian hoặc đã hết hạn, reset lại
                resetTimer();
            }
    
            const remainingTime = localStorage.getItem(endTimeKey) - now;
    
            if (remainingTime > 0) {
                const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            } else {
                // Nếu hết thời gian, reset lại và thông báo người dùng
                resetTimer();
                timerElement.textContent = '15:00';
    
                Swal.fire({
                    title: 'Hết thời gian hiệu lực!',
                    text: 'Phiên đặt số của bạn đã hết hiệu lực.',
                    icon: 'warning',
                    confirmButtonText: 'Đóng',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/'; // Chuyển hướng hoặc thực hiện hành động khác
                    }
                });
            }
        }
    
        // Reset thời gian nếu người dùng tải lại trang hoặc rời khỏi trang rồi quay lại
        window.addEventListener('beforeunload', function() {
            resetTimer();
        });
    
        // Cập nhật mỗi giây
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Chạy ngay khi tải trang
    });
    </script>
    

<!-- Chọn sim-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const simVatLy = document.getElementById("sim_vat_ly");
        const esim = document.getElementById("esim");
        const esimNotice = document.getElementById("esim_notice");

        function toggleEsimNotice() {
            if (esim.checked) {
                esimNotice.style.display = "block";
            } else {
                esimNotice.style.display = "none";
            }
        }

        // Gán sự kiện khi thay đổi radio button
        simVatLy.addEventListener("change", toggleEsimNotice);
        esim.addEventListener("change", toggleEsimNotice);
    });
</script>


<!-- API TỈNH THÀNH-->
<script>
    // Lấy danh sách tỉnh
    fetch('https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1')
        .then(response => response.json())
        .then(data => {
            if (data && data.data && Array.isArray(data.data.data)) {
                const provinces = data.data.data;
                const provincesSelect = document.getElementById('province');
                provinces.forEach(value => {
                    // Thêm option vào select
                    provincesSelect.innerHTML +=
                        `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                });
            } else {
                console.error('Dữ liệu tỉnh thành không hợp lệ.');
            }
        })
        .catch(error => {
            console.error('Lỗi khi gọi API:', error);
        });

    // Lấy danh sách quận/huyện theo tỉnh
    function fetchDistricts(provincesID) {
        fetch(`https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${provincesID}&limit=-1`)
            .then(response => response.json())
            .then(data => {
                const districtsSelect = document.getElementById('district');
                districtsSelect.innerHTML = `<option value=''>Chọn Quận/Huyện</option>`; // Reset trước
                if (data && data.data && Array.isArray(data.data.data)) {
                    let districts = data.data.data;
                    districts.forEach(value => {
                        districtsSelect.innerHTML +=
                            `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                    });
                } else {
                    console.error('Dữ liệu quận huyện không hợp lệ.');
                }
                // Reset xã/phường khi thay đổi tỉnh
                document.getElementById('ward').innerHTML = `<option value=''>Chọn Phường/Xã</option>`;
            })
            .catch(error => {
                console.error('Lỗi khi gọi API:', error);
            });
    }

    // Lấy danh sách xã/phường theo quận huyện
    function fetchWards(districtsID) {
        fetch(`https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${districtsID}&limit=-1`)
            .then(response => response.json())
            .then(data => {
                const wardsSelect = document.getElementById('ward');
                wardsSelect.innerHTML = `<option value=''>Chọn Phường/Xã</option>`; // Reset trước
                if (data && data.data && Array.isArray(data.data.data)) {
                    let wards = data.data.data;
                    wards.forEach(value => {
                        wardsSelect.innerHTML +=
                            `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                    });
                } else {
                    console.error('Dữ liệu xã phường không hợp lệ.');
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Khi thay đổi tỉnh
        document.getElementById('province').addEventListener('change', function(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const provinceID = selectedOption.value;
            const provinceName = selectedOption.getAttribute('data-name');

            if (provinceID) {
                document.getElementById('province_name').value =
                provinceName; // Điền tên tỉnh vào hidden input
                fetchDistricts(provinceID); // Lấy danh sách quận/huyện
            }
        });

        // Khi thay đổi quận/huyện
        document.getElementById('district').addEventListener('change', function(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const districtID = selectedOption.value;
            const districtName = selectedOption.getAttribute('data-name');

            if (districtID) {
                document.getElementById('district_name').value =
                districtName; // Điền tên huyện vào hidden input
                fetchWards(districtID); // Lấy danh sách xã/phường
            }
        });

        // Khi thay đổi xã/phường
        document.getElementById('ward').addEventListener('change', function(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const wardName = selectedOption.getAttribute('data-name');

            document.getElementById('ward_name').value = wardName; // Điền tên xã vào hidden input
        });
    });
</script>


<!-- cập nhật phương thức giá ship và ẩn hiện QR code -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const activationFee = parseInt("{{ $soThueBao->phi_hoa_mang }}") || 0;
    const packagePrice = parseInt("{{ $goiCuoc->gia ?? 0 }}") || 0;
    const shippingFeeDisplay = document.getElementById('shipping_fee');
    const totalPaymentDisplay = document.getElementById('total_payment');
    const deliveryOptions = document.querySelectorAll('input[name="delivery_method"]');
    const shippingFeeInput = document.getElementById('shipping_fee_input'); // Input ẩn

    function updateTotalPayment() {
        // Lấy phí giao hàng từ radio button được chọn
        const selectedOption = document.querySelector('input[name="delivery_method"]:checked');
        const shippingFee = parseInt(selectedOption.value) || 0;

        // Cập nhật giá trị input ẩn để gửi về Laravel
        shippingFeeInput.value = shippingFee;

        // Tính tổng tiền
        const totalPayment = activationFee + packagePrice + shippingFee;

        // Cập nhật hiển thị
        shippingFeeDisplay.innerText = shippingFee.toLocaleString('vi-VN') + 'đ';
        totalPaymentDisplay.innerText = totalPayment.toLocaleString('vi-VN') + 'đ';
    }

    // Gọi hàm ngay khi tải trang
    updateTotalPayment();

    // Thêm sự kiện khi người dùng thay đổi lựa chọn giao hàng
    deliveryOptions.forEach(option => {
        option.addEventListener('change', updateTotalPayment);
         });
    });




    document.addEventListener('DOMContentLoaded', function() {
        const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
        const qrCodeContainer = document.getElementById('qr_code_container');

        // Hàm cập nhật hiển thị QR Code
        function updateQRCode() {
            const selectedValue = document.querySelector('input[name="payment_method"]:checked').value;

            if (selectedValue === 'Vietcombank QR') {
                qrCodeContainer.style.display = 'block'; // Hiển thị QR Code
            } else {
                qrCodeContainer.style.display = 'none'; // Ẩn QR Code
            }
        }

        // Lắng nghe sự kiện thay đổi phương thức thanh toán
        paymentOptions.forEach(option => {
            option.addEventListener('change', updateQRCode);
        });

        // Gọi hàm cập nhật ban đầu
        updateQRCode();
    });
</script>


<style>
    #qr_code_container {
        text-align: center;
        /* Căn giữa nội dung */
        padding: 10px;
        border: 2px solid #ddd;
        /* Viền để phân biệt */
        border-radius: 8px;
        /* Bo tròn góc */
        background-color: #f9f9f9;
        /* Màu nền nhạt */
        margin-top: 15px;
    }

    #qr_code_container img {
        max-width: 100%;
        /* Hình ảnh co giãn phù hợp */
        height: auto;
        border-radius: 5px;
        /* Bo tròn hình ảnh */
    }

    /* Phong cách cho từng tùy chọn vận chuyển */
    .delivery-option {
        display: flex;
        align-items: center;
        gap: 15px;
        /* Khoảng cách giữa hình ảnh và chữ */
        margin-bottom: 15px;
        /* Tăng khoảng cách giữa các tùy chọn */
        padding: 10px;
        /* Thêm padding để tạo khoảng cách nội dung */
        border: 2px solid #ddd;
        /* Đường viền mặc định */
        border-radius: 8px;
        /* Bo tròn góc */
        background-color: #f9f9f9;
        /* Màu nền mặc định */
        transition: all 0.3s ease;
        /* Hiệu ứng mượt */
        cursor: pointer;
    }

    .delivery-option:hover {
        background-color: #f1f1f1;
        /* Màu nền khi hover */
        border-color: #ccc;
        /* Đổi màu viền khi hover */
    }

    .delivery-option input[type="radio"] {
        display: none;
        /* Ẩn nút radio */
    }

    .delivery-option img.delivery-icon {
        width: 40px;
        /* Kích thước icon lớn hơn */
        height: auto;
        border-radius: 8px;
        /* Bo tròn góc icon */
        transition: transform 0.3s ease, border 0.3s ease;
    }

    /* Tùy chọn được chọn */
    .delivery-option input[type="radio"]:checked+.delivery-icon {
        transform: scale(1.2);
        /* Phóng to icon khi được chọn */
        border: 3px solid #007bff;
        /* Đường viền xanh khi được chọn */
    }

    .delivery-option input[type="radio"]:checked+.delivery-icon+span {
        font-weight: bold;
        /* Làm đậm chữ khi được chọn */
        color: #007bff;
        /* Đổi màu chữ */
    }

    .delivery-option input[type="radio"]:checked+.delivery-icon+span:hover {
        text-decoration: underline;
        /* Thêm hiệu ứng hover cho chữ */
    }


    /* Container chính */
    .progress-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Mỗi bước */
    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Vòng tròn */
    .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ddd;
        /* Màu mặc định */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        color: #000;
        /* Màu chữ mặc định */
        position: relative;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Bước hoàn thành với dấu check */
    .progress-step.completed .circle {
        background-color: #007bff;
        /* Màu xanh lá */
        color: white;
        /* Dấu check màu trắng */
    }

    .progress-step.completed .circle::before {
        content: '✓';
        /* Dấu check */
        font-family: Arial, sans-serif;
        font-size: 20px;
        font-weight: bold;
        position: absolute;
        color: white;
    }

    .progress-step.completed .circle>span {
        display: none;
        /* Ẩn số khi đã có dấu check */
    }

    /* Bước hiện tại */
    .progress-step.active .circle {
        background-color: #007bff;
        /* Màu xanh dương */
        color: white;
        /* Màu chữ */
        font-weight: bold;
    }

    /* Đường kết nối */
    .progress-line {
        flex: 1;
        height: 4px;
        background-color: #ddd;
        /* Màu mặc định */
        transition: background-color 0.3s;
    }

    .progress-line.active {
        background-color: #007bff;
        /* Màu xanh dương khi active */
    }



    /* Phong cách cho từng tùy chọn thanh toán */
    .payment-option {
        display: flex;
        align-items: center;
        gap: 15px;
        /* Khoảng cách giữa hình ảnh và văn bản */
        margin-bottom: 15px;
        /* Tăng khoảng cách giữa các tùy chọn */
        padding: 10px;
        /* Thêm khoảng cách bên trong */
        border: 2px solid #ddd;
        /* Đường viền mặc định */
        border-radius: 8px;
        /* Bo tròn góc */
        background-color: #f9f9f9;
        /* Màu nền mặc định */
        cursor: pointer;
        transition: all 0.3s ease;
        /* Hiệu ứng mượt */
    }

    .payment-option:hover {
        background-color: #f1f1f1;
        /* Màu nền khi hover */
        border-color: #ccc;
        /* Đổi màu viền khi hover */
    }

    .payment-option input[type="radio"] {
        display: none;
        /* Ẩn nút radio */
    }

    .payment-option img.payment-icon {
        width: 40px;
        /* Kích thước icon */
        height: auto;
        border-radius: 5px;
        /* Bo tròn góc */
        transition: transform 0.3s ease, border 0.3s ease;
    }

    /* Khi tùy chọn được chọn */
    .payment-option input[type="radio"]:checked+.payment-icon {
        transform: scale(1.2);
        /* Phóng to icon khi được chọn */
        border: 2px solid #007bff;
        /* Đường viền xanh khi được chọn */
    }

    .payment-option input[type="radio"]:checked+.payment-icon+span {
        font-weight: bold;
        /* Làm đậm chữ khi được chọn */
        color: #007bff;
        /* Đổi màu chữ */
    }
</style>
