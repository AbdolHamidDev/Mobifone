@extends('layouts.frontend')
<style>
  .image img {
    width: 900px;  /* Chiều rộng cố định */
    height: 500px; /* Chiều cao cố định */
    object-fit: cover; /* Đảm bảo ảnh không bị kéo giãn */
}

</style>
@section('content')
<div class="container" style="padding-top: 15vh;">
        <h1 class="text-2xl font-bold text-blue-600 mb-4">Giới thiệu MobiFone</h1>
        <div class="image">
            <img src="assets/images/gioithieu.jpg">
          </div>
        <p><strong>Tên đơn vị:</strong> TỔNG CÔNG TY VIỄN THÔNG MOBIFONE</p>

        <p><strong>Tên giao dịch quốc tế:</strong> MobiFone Corporation</p>

        <p><strong>Tên viết tắt:</strong> MOBIFONE</p>

        <p><strong>Thông tin chung:</strong></p>
        <p>
            Là mạng viễn thông di động đầu tiên tại Việt Nam, MobiFone được thành lập ngày 16/04/1993 với tên gọi ban đầu là Công ty thông tin di động (VMS). Ngày 01/12/2014, MobiFone được chuyển đổi thành Tổng công ty Viễn thông MobiFone, thuộc Bộ Thông tin và Truyền thông. Tháng 11/2018, MobiFone được chuyển giao quyền đại diện chủ sở hữu về Ủy ban Quản lý vốn nhà nước tại doanh nghiệp.
        </p>
        <p>
            Tại Việt Nam, MobiFone là một trong số các doanh nghiệp Viễn thông – Công nghệ thông tin – Nội dung số lớn nhất, là nhà cung cấp mạng thông tin di động đầu tiên, với hơn 30% thị phần. MobiFone là thương hiệu được khách hàng yêu thích lựa chọn, nhận được nhiều giải thưởng, xếp hạng danh giá trong nước và quốc tế. MobiFone đang chuyển đổi hướng đến phát triển thành tập đoàn công nghệ hàng đầu Việt Nam.
        </p>

        <p><strong>Tầm nhìn:</strong></p>
        <p>
            MOBIFONE ĐỊNH HƯỚNG PHÁT TRIỂN THÀNH TẬP ĐOÀN CÔNG NGHỆ HÀNG ĐẦU VIỆT NAM
        </p>
        <p>
            Cùng với việc đi đầu trong cung cấp hạ tầng công nghệ, MobiFone tạo không ngừng tạo ra các sản phẩm, dịch vụ và giải pháp để giúp khách hàng nâng tầm trải nghiệm, giúp doanh nghiệp nâng cao hiệu suất kinh doanh, cùng đóng góp vào sự phát triển của xã hội Việt Nam.
        </p>

        <p><strong>Sứ mệnh:</strong></p>
        <p>
            MobiFone không ngừng sáng tạo, đổi mới, kiến tạo hệ sinh thái số mạnh mẽ và hoàn chỉnh, nâng tầm cuộc sống của người Việt và góp phần đưa Việt Nam trở thành quốc gia số.
        </p>

        <p><strong>Triết lý kinh doanh:</strong></p>
        <p>
            <strong>LẤY KHÁCH HÀNG LÀM TRUNG TÂM</strong>
        </p>
        <p>
            Chúng tôi hành động với mục đích, niềm đam mê và thái độ tích cực để giúp khách hàng thực hiện ước mơ của họ.
        </p>

        <p><strong>Giá trị cốt lõi:</strong></p>
        <p>
            Trên tinh thần đổi mới, thần tốc, phát huy các giá trị cốt lõi:
        </p>
        <p class="font-bold text-red-600">ĐỔI MỚI - THẦN TỐC – CHUYÊN NGHIỆP – HIỆU QUẢ.</p>

        <p><strong>Cam kết của MobiFone:</strong></p>
        <ul class="list-disc pl-6">
            <li>THÁI ĐỘ NIỀM NỞ</li>
            <li>THẤU HIỂU NHU CẦU</li>
            <li>TƯ VẤN HIỆU QUẢ</li>
            <li>TRẢI NGHIỆM KHÁC BIỆT</li>
            <li>TIN TƯỞNG TRỌN VẸN</li>
        </ul>
    </div>
@endsection


    <style>
        .container {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #1d4ed8; /* Màu xanh đậm */
        }

        p {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 1.2rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-red-600 {
            color: #b91c1c;
        }

        .list-disc {
            list-style-type: disc;
        }

     



    </style>

