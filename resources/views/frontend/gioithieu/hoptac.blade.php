@extends('layouts.frontend')

@section('content')
<style>
    /* CSS thêm vào body */
    body {
        padding-top: 80px; /* Đảm bảo khoảng cách với header */
        font-family: 'Roboto', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px;
    }

    h1 {
       
        margin-bottom: 20px;
        color: #1c1c28; /* Màu tiêu đề */
    }

    ul {
        list-style-type: disc;
        margin-left: 20px;
    }

    .contact-info {
        margin-top: 20px;
        background-color: #f0f0f0; /* Màu nền nhẹ cho phần liên hệ */
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Thiết kế thẻ p nổi bật */
    p {
      
        color: #004f9b; /* Màu xanh đậm của MobiFone */
        font-weight: bold; /* Chữ đậm */
        line-height: 1.6;
        margin-bottom: 20px;
    }

    p strong {
        color: #004f9b; /* Màu cho strong trong p */
    }

    .highlighted-text {
    color: #0066cc; /* Màu xanh đậm của MobiFone */
    font-size: 1.2rem; /* Cỡ chữ lớn hơn để nổi bật */
    font-weight: bold; /* Làm đậm chữ */
    margin-bottom: 20px; /* Tạo khoảng cách dưới các thẻ <p> */
}

    a.link:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>Hợp tác với MobiFone</h1>
    <p class="highlighted-text"><strong>Các lĩnh vực Tổng công ty viễn thông MobiFone đang quan tâm:</strong></p>
    <ul>
        <li>Lĩnh vực M2M/IoT</li>
        <li>Lĩnh vực OTT TV</li>
        <li>Lĩnh vực thanh toán điện tử</li>
        <li>Lĩnh vực quảng cáo trên di động</li>
        <li>Lĩnh vực tài chính bảo hiểm</li>
        <li>Lĩnh vực trò chơi trên di động</li>
        <li>Lĩnh vực về giáo dục, nông nghiệp, y tế</li>
        <li>Lĩnh vực âm nhạc số</li>
        <li>Đối tác có nội dung đặc sắc như: giải bóng đá các quốc gia châu Âu, phim bom tấn Hollywood,..</li>
    </ul>

    <p class="highlighted-text"><strong>Nguyên tắc hợp tác:</strong></p>
    <ul>
        <li>MobiFone khuyến khích hợp tác cung cấp các dịch vụ chưa được cung cấp trên mạng MobiFone.</li>
        <li>Đối với các dịch vụ đã được cung cấp trên mạng MobiFone, đối tác cần làm rõ sự vượt trội của dịch vụ mới so với dịch vụ đã được cung cấp.</li>
    </ul>

    <p class="highlighted-text"><strong>Yêu cầu đối với các đối tác của MobiFone:</strong></p>
    <ul>
        <li>Giấy phép kinh doanh</li>
        <li>Năng lực tài chính</li>
        <li>Bản quyền nội dung số, bản quyền giải pháp</li>
        <li>Kinh nghiệm cung cấp nội dung số</li>
        <li>Kiến trúc hệ thống và mô hình kết nối kĩ thuật</li>
    </ul>

    <p class="highlighted-text"><strong>Nộp hồ sơ và duyệt hồ sơ tự động:</strong></p>
    <li>Quý đối tác vui lòng truy cập vào đường link: <a href="https://hoptac.mobifone.vn" class="link">https://hoptac.mobifone.vn</a></li>

    <div class="contact-info">
        <p><strong>Đầu mối liên hệ:</strong></p>
        <p>Ban Khách hàng cá nhân – Tổng Công ty Viễn thông MobiFone</p>
        <p>Địa chỉ: Số 01 phố Phạm Văn Bạch, Yên Hòa, Cầu Giấy, Hà Nội</p>
        <p>SĐT: (84 24) 37831768</p>
    </div>
</div>

@endsection
