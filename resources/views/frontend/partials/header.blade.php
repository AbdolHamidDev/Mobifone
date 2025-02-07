<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo MobiFone">
                    </a>
                    
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <!-- Dịch vụ di động với menu con -->
                        <li class="has-sub">
                          <a href="javascript:void(0)">Dịch vụ di động</a>
                          <ul class="sub-menu">
                            <li>
                              <a href="{{ url('/dich-vu-di-dong/loai-thue-bao') }}">Loại thuê bao</a>
                          </li>
                          
                            <li><a href="{{ route('frontend.dichvudidong.goicuoc') }}">Gói cước</a></li>
                            <li><a href="{{ route('frontend.dichvudidong.goidata') }}">Gói data</a></li>
                            <li><a href="{{ route('frontend.dichvudidong.dichvu') }}">Dịch vụ</a></li>
                            <li><a href="{{ route('frontend.dichvudidong.sothuebao') }}">Đăng ký hòa mạng</a></li>
                            <li><a href="{{ url('/dich-vu-quoc-te') }}">Dịch vụ quốc tế</a></li>
                          </ul>
                        </li>
                  
                        <li class="has-sub">
                            <a href="javascript:void(0)">Hỗ trợ khách hàng</a>
                            <ul class="sub-menu">
                              <li><a href="#">Kết nối dài lâu</a></li>
                              <li><a href="{{ url('/cauhoi-thuonggap') }}">Câu hỏi thường gặp</a></li>
                              <li><a href="#calculator">Gửi phản ánh</a></li>
                              <li><a href="{{ url('/store-search') }}">Tìm kiếm cửa hàng</a></li>
                              <li><a href="{{ url('/chuyendoi-mang') }}">Chuyển mạng giữ số</a></li>                       
                            </ul>
                          </li>
                          <li class="has-sub">
                            <a href="javascript:void(0)">Khuyến mại</a>
                            <ul class="sub-menu">
                              <li><a href="#">Tin khuyến mại</a></li>
                              <li><a href="#">Thông tin trúng thưởng</a></li>
                              <li><a href="#">Tra cứu mã & giải thưởng</a></li>
                              <li><a href="#">Mobifone shop</a></li>                                                 
                            </ul>
                          </li>
                          <li class="has-sub">
                            <a href="javascript:void(0)">My Mobifone</a>
                            <ul class="sub-menu">
                                <div class="dropdown-content">
                                    <div class="dropdown-column">
                                        <h4>Tài khoản</h4>
                                        <li><a href="#">Thông tin tài khoản</a></li>
                                        <li><a href="#">Thông tin cá nhân</a></li>
                                        <li><a href="#">Đăng ký thông tin</a></li>
                                        <li><a href="#">Lịch sử mypoint</a></li>
                                    </div>
                                    <div class="dropdown-column">
                                        <h4>Tiện ích</h4>
                                        <li><a href="#">Nạp tiền</a></li>
                                        <li><a href="#">Thanh toán ngân hàng</a></li>
                                        <li><a href="#">Autopay</a></li>
                                        <li><a href="#">MobiFone Online</a></li>
                                        <li><a href="#">Ưu đãi mypoint</a></li>
                                        <li><a href="#">Thanh toán MobiFiber</a></li>
                                    </div>
                                    <div class="dropdown-column">
                                        <h4>Cước</h4>
                                        <li><a href="#">Tra cước</a></li>
                                        <li><a href="#">Lịch sử nạp tiền/thanh toán</a></li>
                                        <li><a href="#">Lịch sử thanh toán trên web/app MobiFone</a></li>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        
                          
  
                        <li class="scroll-to-section"><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                        <li>
                          <a href="" class="search-button">
                              <i class="fas fa-search"></i> Tìm kiếm
                          </a>
                      </li>
                      
                      
                        
                    </ul>        
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    .nav .sub-menu {
  display: none; /* Ẩn menu con theo mặc định */
  position: absolute; /* Định vị menu con bên trong menu cha */
  top: 100%; /* Hiển thị ngay dưới menu cha */
  left: 0; /* Canh trái menu con với menu cha */
  background: #fff; /* Màu nền menu con */
  border: 1px solid #ddd; /* Viền của menu con */
  list-style: none; /* Xóa dấu đầu dòng */
  padding: 10px 0; /* Khoảng cách trên dưới cho menu con */
  z-index: 1000; /* Đảm bảo menu con nằm trên các thành phần khác */
  min-width: 200px; /* Đặt chiều rộng tối thiểu cho menu con */
  overflow: visible; /* Đảm bảo hiển thị đầy đủ nội dung bên trong */
}

.nav .sub-menu li {
  padding: 0; /* Xóa khoảng cách giữa các mục */
}

.nav .sub-menu li a {
  display: block; /* Hiển thị mục con như một khối */
  padding: 8px 16px; /* Khoảng cách bên trong các mục */
  color: #000; /* Màu chữ của mục */
  text-decoration: none; /* Xóa gạch chân */
}

.nav .sub-menu li a:hover {
  background: #f7f7f7; /* Màu nền khi hover */
}

.nav .has-sub:hover .sub-menu {
  display: block; /* Hiển thị menu con khi hover vào menu cha */
}

/* Thiết kế cho nút Tìm kiếm */
.search-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 30px;
    background: linear-gradient(135deg, #0066CC, #CC0000); /* Gradient màu xanh và đỏ mềm mại */
    color: white;
    font-weight: bold;
    font-size: 16px;
    text-transform: uppercase; /* Chữ in hoa */
    transition: all 0.3s ease-in-out; /* Hiệu ứng chuyển tiếp */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bóng đổ nhẹ */
}

/* Hiệu ứng hover */
.search-button:hover {
    background: linear-gradient(135deg, #004d99, #990000); /* Gradient đậm hơn khi hover */
    transform: scale(1.05); /* Phóng to nhẹ khi hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Bóng đổ đậm hơn khi hover */
}

/* Đảm bảo icon có màu trắng và khoảng cách hợp lý */
.search-button i {
    margin-right: 10px;
    font-size: 18px; /* Kích thước icon */
    transition: transform 0.3s ease; /* Hiệu ứng quay icon khi hover */
}

/* Thêm hiệu ứng cho icon khi hover */
.search-button:hover i {
    transform: rotate(360deg); /* Quay icon 360 độ khi hover */
}





</style>