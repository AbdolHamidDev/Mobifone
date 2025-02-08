<section class="services" id="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-phone"></i>
          <h4>Loại Thuê Bao</h4>
          <p>Các loại thuê bao phong phú, phù hợp với nhu cầu cá nhân và doanh nghiệp.</p>
          <a href="{{ url('/dich-vu-di-dong/loai-thue-bao') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-list-alt"></i>
          <h4>Gói Cước</h4>
          <p>Các gói cước đa dạng, tiết kiệm chi phí và tối ưu hóa tiện ích.</p>
          <a href="{{ route('frontend.dichvudidong.goicuoc') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-signal"></i>
          <h4>Gói Data</h4>
          <p>Nhiều gói data linh hoạt, phù hợp với nhu cầu truy cập internet.</p>
          <a href="{{ route('frontend.dichvudidong.goidata') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-cogs"></i>
          <h4>Dịch Vụ</h4>
          <p>Các dịch vụ hỗ trợ toàn diện giúp khách hàng an tâm sử dụng.</p>
          <a href="{{ route('frontend.dichvudidong.dichvu') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-user-plus"></i>
          <h4>Đăng Ký Hòa Mạng</h4>
          <p>Quy trình nhanh chóng, dễ dàng cho khách hàng mới.</p>
          <a href="{{ route('frontend.dichvudidong.sothuebao') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="service-item">
          <i class="fas fa-globe"></i>
          <h4>Dịch Vụ Quốc Tế</h4>
          <p>Hỗ trợ các dịch vụ quốc tế chất lượng cao, kết nối toàn cầu.</p>
          <a href="{{ url('/dich-vu-quoc-te') }}" class="subtle-link">Xem tất cả &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* Style cho liên kết "Xem ngay" */
/* Đặt style cố định cho thẻ chứa liên kết */
.service-item {
  position: relative;
  padding-bottom: 60px; /* Thêm khoảng trống cho liên kết */
}

/* Style cho liên kết "Xem ngay" */
.subtle-link {
  position: absolute;
  bottom: 5px; /* Cố định cách đáy thẻ chứa 10px */
  left: 20px; /* Cố định cách cạnh trái 10px */
  color: #524f4f;
  font-weight: bold;
  font-size: 14px;
  text-decoration: none;
  transition: color 0.3s ease;
}

.subtle-link::after {
  content: "";
  display: block;
  height: 2px;
  width: 0;
  background: #524f4f;
  transition: width 0.3s ease;
  position: absolute;
  left: 0;
  bottom: -2px;
}

.subtle-link:hover {
  color: #272525;
}

.subtle-link:hover::after {
  width: 100%;
}

  </style>