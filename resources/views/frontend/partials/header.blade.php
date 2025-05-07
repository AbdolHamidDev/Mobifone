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
                                <li><a href="{{ url('/dich-vu-di-dong/loai-thue-bao') }}">Loại thuê bao</a></li>
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
                                <li><a href="{{ url('/cauhoi-thuonggap') }}">Câu hỏi thường gặp</a></li>
                                <li><a href="#calculator">Gửi phản ánh</a></li>
                                <li><a href="{{ url('/store-search') }}">Tìm kiếm cửa hàng</a></li>
                                <li><a href="{{ url('/chuyendoi-mang') }}">Chuyển mạng giữ số</a></li>
                            </ul>
                        </li>

                        <li class="scroll-to-section"><a href="{{ url('/khuyen-mai') }}">Khuyến mãi</a></li>
                        <li class="scroll-to-section"><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>

                        <!-- User Dropdown -->
                        <li class="has-sub user-dropdown">
                            <a href="javascript:void(0)">
                              <span class="user-name">
                                Xin chào, <strong>{{ explode('@', session('email'))[0] }}</strong>
                            </span>
                                                        </a>
                            @if (session('authenticated'))
                                <ul class="sub-menu user-menu">
                                    <li class="user-info">
                                        <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Avatar">
                                        <span class="phone-number">
                                          {{ explode('@', session('email'))[0] }}
                                      </span>
                                                                          </li>
                                    <li><a href="{{ url('/tra-cuu-don-hang') }}">Tra Cứu Đơn Hàng</a></li>
                                    <li><a href="{{ url('/hosokhachhang/tracuu-goicuoc') }}">Tra Cứu Gói Cước</a></li>
                                    <li>
                                        <form action="{{ route('otp.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="logout-button">Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                        <li class="scroll-to-section"><a href="{{ url('/login-otp') }}">Đăng nhập OTP</a></li>
                        @endif
                        </li>

                    </ul>

                  
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>


<style>
    /* Định dạng tổng thể dropdown */
    .user-dropdown {
        position: relative;
        font-size: 14px;
    }

    .user-dropdown a {
        display: flex;
        align-items: center;
        color: #ff6600;
        /* Màu nổi bật */
        font-weight: bold;
    }

    .user-dropdown .fa-chevron-down {
        margin-left: 5px;
        font-size: 12px;
    }

    /* Thiết kế dropdown menu */
    .user-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 220px;
        padding: 10px 0;
        z-index: 100;
    }

    .user-dropdown:hover .user-menu {
        display: block;
    }

    /* Phần hiển thị thông tin người dùng */
    .user-info {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .phone-number {
        font-weight: bold;
        color: #333;
    }

    /* Định dạng các mục trong dropdown */
    .user-menu li {
        padding: 10px;
    }

    .user-menu li a {
        display: block;
        color: #333;
        transition: 0.3s;
    }

    .user-menu li a:hover {
        background: #f5f5f5;
    }

    /* Định dạng nút đăng xuất */
    .logout-button {
        width: 100%;
        text-align: left;
        color: red;
        font-weight: bold;
        background: none;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .logout-button:hover {
        background: #ffe6e6;
    }

    .nav .sub-menu {
        display: none;
        /* Ẩn menu con theo mặc định */
        position: absolute;
        /* Định vị menu con bên trong menu cha */
        top: 100%;
        /* Hiển thị ngay dưới menu cha */
        left: 0;
        /* Canh trái menu con với menu cha */
        background: #fff;
        /* Màu nền menu con */
        border: 1px solid #ddd;
        /* Viền của menu con */
        list-style: none;
        /* Xóa dấu đầu dòng */
        padding: 10px 0;
        /* Khoảng cách trên dưới cho menu con */
        z-index: 1000;
        /* Đảm bảo menu con nằm trên các thành phần khác */
        min-width: 200px;
        /* Đặt chiều rộng tối thiểu cho menu con */
        overflow: visible;
        /* Đảm bảo hiển thị đầy đủ nội dung bên trong */
    }

    .nav .sub-menu li {
        padding: 0;
        /* Xóa khoảng cách giữa các mục */
    }

    .nav .sub-menu li a {
        display: block;
        /* Hiển thị mục con như một khối */
        padding: 8px 16px;
        /* Khoảng cách bên trong các mục */
        color: #000;
        /* Màu chữ của mục */
        text-decoration: none;
        /* Xóa gạch chân */
    }

    .nav .sub-menu li a:hover {
        background: #f7f7f7;
        /* Màu nền khi hover */
    }

    .nav .has-sub:hover .sub-menu {
        display: block;
        /* Hiển thị menu con khi hover vào menu cha */
    }
</style>
