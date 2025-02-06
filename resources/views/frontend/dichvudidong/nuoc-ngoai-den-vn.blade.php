@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/dichvuquocte/ranuocngoai.css') }}">
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
@section('content')
    <div class="container" style="padding-top: 15vh;">

        <!-- THANH ĐIỀU HƯỚNG -->
        <div class="breadcrumb">
            <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
            <span class="divider">/</span>
            <a href="#">Dịch vụ di động</a>
            <span class="divider">/</span>
            <a href="/dich-vu-di-dong/dich-vu">Dịch vụ</a>
            <span class="divider">/</span>
            <span class="current">Chi tiết dịch vụ</span>
        </div>

        <!-- CARD NỘI DUNG -->
        <div class="service-detail-card">
            <img src="{{ asset('assets/images/nuocngoaidenvietnam.jpg') }}" alt="Thuê bao nước ngoài đến Việt Nam" class="service-image">
            <div class="service-info">
                <h4 class="service-title">Thuê bao nước ngoài đến Việt Nam</h4>
                <p class="service-description">
                    Hiện nay, MobiFone đã ký kết thỏa thuận chuyển vùng quốc tế với hơn 500 mạng của gần 180 quốc gia/vùng lãnh thổ để cung cấp dịch vụ thông tin di động với chất lượng tốt nhất tới du khách nước ngoài đến Việt Nam.
                </p>
            </div>
        </div>

        <!-- NỘI DUNG CHÍNH  -->
        <div class="row">
                <!-- Cột trái: Dịch vụ chính -->
            <div class="col-md-8">
                <div class="content">
                    <h2>Đối tượng sử dụng</h2>
                    <p>Cước cuộc gọi phát sinh khi khách hàng sử dụng dịch vụ được quy định bởi mạng chủ của khách hàng. Khách hàng sẽ thanh toán cước phát sinh với mạng chủ, mà không phải thanh toán với MobiFone.</p>
                
                    <h2>Các tính năng chính của dịch vụ</h2>
                    <p>Khi đến Việt Nam, khách hàng của các mạng di động có thỏa thuận CVQT với MobiFone có thể truy cập vào mạng MobiFone để sử dụng dịch vụ thoại, SMS và Data.</p>
                    <p>Khi đến Việt Nam, khách hàng nên lựa chọn truy cập thủ công vào mạng MobiFone để có thể duy trì liên lạc (Đàm thoại, Gửi tin nhắn SMS và Truy cập Data):</p>
                    <p>Chọn Menu → Setting (Cài đặt) → Select Network (Chọn mạng) → Manual (Cài đặt bằng tay) → Chọn mạng “MOBIFONE” → OK.</p>
                
                    <h3>Hướng dẫn cài đặt trên các dòng máy thông dụng:</h3>
                    <table border="1">
                        <tr>
                            <th>Hãng</th>
                            <th>Cài đặt</th>
                        </tr>
                        <tr>
                            <td>Nokia</td>
                            <td>Menu → Settings → Phone Settings → Network Selection → Automatic/Manual.<br>
                                Menu → Cài đặt → Cài đặt cho máy → Chọn mạng → Tự động/Thủ công.</td>
                        </tr>
                        <tr>
                            <td>Motorola</td>
                            <td>Menu → Network Selection → Automatic Search/Manual Search.<br>
                                Menu → Chọn mạng → Chọn tự động/Chọn thủ công.</td>
                        </tr>
                        <tr>
                            <td>Sony Ericson</td>
                            <td>Menu → Settings → Connection → Networks → Automatic/Manual.<br>
                                Menu → Cài đặt → Kết nối → Mạng di động → Chế độ tìm → Dò bằng tay.</td>
                        </tr>
                        <tr>
                            <td>Samsung</td>
                            <td>Menu → Settings → Network Services → Networks Selection → Automatic/Manual.<br>
                                Menu → Dịch vụ mạng → Lựa chọn mạng → Thủ công.</td>
                        </tr>
                        <tr>
                            <td>Blackberry</td>
                            <td>Application → Option → Mobile Network → Automatic/Manual.</td>
                        </tr>
                        <tr>
                            <td>Iphone</td>
                            <td>Menu → Settings → Network Selection → Carriers → Automatic/Manual.</td>
                        </tr>
                    </table>
                
                    <h3>Hướng dẫn thực hiện cuộc gọi/gửi tin nhắn</h3>
                    <table border="1">
                        <tr>
                            <th>STT</th>
                            <th>Tình huống</th>
                            <th>Cách quay số</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Gọi/nhắn tin cho số thuê bao của Việt Nam</td>
                            <td>Bấm đầy đủ số máy theo quy định (VD: gọi cho thuê bao thuộc mạng MobiFone: 090xxxxxxx hoặc 093xxxxxxx...)</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Gọi/nhắn tin về nước hoặc gọi quốc tế</td>
                            <td>00 (hoặc dấu "+") Mã nước cần gọi đến_Số điện thoại.</td>
                        </tr>
                    </table>
                
                    <h2>Quy định</h2>
                    <p>Để biết thêm chi tiết, Quý khách vui lòng liên hệ Tổng đài hỗ trợ khách hàng <strong>9393</strong>.</p>
            </div>
        </div>

        <!-- Cột phải: Hai dịch vụ khác -->
        <div class="col-md-4">
            <h5 class="mb-3">Dịch vụ khác</h5>
            @foreach ($dichvuKhac as $dv)
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Hiển thị ảnh dịch vụ -->
                            <img src="{{ asset('storage/' . $dv->anh) }}" alt="{{ $dv->ten_dich_vu }}" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <!-- Hiển thị tên dịch vụ -->
                                <h6 class="card-title">{{ $dv->ten_dich_vu }}</h6>
                                <!-- Hiển thị nội dung đầy đủ -->
                                <p class="card-text">{{ $dv->noi_dung }}</p>
                                <!-- Nút Xem Chi Tiết -->
                                <a href="{{ route('frontend.dichvu_chitiet.index', ['id' => $dv->id]) }}" class="btn btn-sm btn-primary">
                                    Xem Chi Tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
<style>
        .content {
        max-width: 800px; /* Giới hạn chiều rộng để nội dung không bị dàn trải */
        margin: 0 auto; /* Căn giữa nội dung */
        padding: 20px; /* Tạo khoảng cách bên trong div */
    }

    h2, h3 {
        margin-top: 20px; /* Tạo khoảng cách giữa các tiêu đề */
        margin-bottom: 10px; /* Tạo khoảng cách phía dưới tiêu đề */
    }

    p {
        margin-bottom: 15px; /* Tạo khoảng cách giữa các đoạn văn */
        line-height: 1.6; /* Tăng khoảng cách giữa các dòng giúp dễ đọc */
    }

    table {
        width: 100%; /* Bảng chiếm toàn bộ chiều rộng div */
        border-collapse: collapse; /* Gộp viền bảng để không bị đúp */
        margin-top: 15px; /* Tạo khoảng cách phía trên bảng */
        margin-bottom: 20px; /* Tạo khoảng cách phía dưới bảng */
    }

    th, td {
        border: 1px solid #ddd; /* Viền nhẹ giúp bảng dễ nhìn hơn */
        padding: 10px; /* Tạo khoảng cách bên trong ô */
        text-align: left; /* Căn lề trái cho nội dung */
    }

    th {
        background-color: #f4f4f4; /* Tô nền cho tiêu đề bảng */
        font-weight: bold; /* Làm đậm tiêu đề bảng */
    }

    tr:nth-child(even) {
        background-color: #f9f9f9; /* Tạo nền xám nhạt xen kẽ giữa các hàng */
    }
</style>