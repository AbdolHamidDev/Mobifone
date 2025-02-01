<style>
    /* Card container */
    .portfolio-item .card {
        border-radius: 8px; /* Để các góc card bo tròn */
        background-color: #ffffff;
        border: 1px solid #f1f1f1;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .portfolio-item .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Nền xanh và tên gói cước */
    .portfolio-item .card .card-header {
        background-color: #0066CC; /* Màu xanh nền */
        color: #ffffff;
        text-align: center;
        padding: 15px;
        font-weight: bold;
        font-size: 1.4rem;
        text-transform: uppercase;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    /* Thông tin giá, thời gian, dung lượng */
    .portfolio-item .card-body {
        padding: 20px;
    }

    .portfolio-item .card-text {
        font-size: 1rem;
        color: #333;
        margin-bottom: 10px;
    }

    /* Icon cho các phần thông tin */
    .portfolio-item .card-text i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

   /* Nút đăng ký - mặc định */
.portfolio-item .card .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    background: white; /* Nền trắng mặc định */
    color: #0066CC!important; /* Chữ màu xanh */
    font-weight: bold;
    font-size: 16px;
    text-transform: uppercase; /* Chữ in hoa */
    transition: all 0.3s ease-in-out; /* Hiệu ứng chuyển tiếp */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bóng đổ nhẹ */
    border: 2px solid #0066CC; /* Đường viền xanh để tách biệt */
}

/* Hiệu ứng hover */
.portfolio-item .card .btn:hover {
    background: linear-gradient(135deg, #0066CC, #CC0000); /* Gradient màu xanh và đỏ khi hover */
    color: white!important; /* Chữ trắng khi hover */
    transform: scale(1.05); /* Phóng to nhẹ khi hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Bóng đổ đậm hơn khi hover */
    border: 2px solid transparent; /* Xóa đường viền khi hover */
}



/* CSS cho card và nút khi gói cước ngừng bán */
.card.inactive, .card.inactive .btn {
    opacity: 0.5; /* Làm mờ toàn bộ card và nút */
    pointer-events: none; /* Không cho phép người dùng tương tác với card hoặc nút */
    filter: grayscale(100%); /* Làm xám toàn bộ hình ảnh và nội dung */
}

.card.inactive {
    background-color: #f7f7f7; /* Màu nền nhẹ cho card khi ngừng bán */
}

/* Tùy chọn cho màu nút ngừng bán */
.card.inactive .btn {
    background-color: #cccccc; /* Màu xám cho nút khi ngừng bán */
    color: #999999; /* Màu chữ xám cho nút */
    cursor: not-allowed; /* Không cho phép nhấp vào nút */
}
/* Hiệu ứng cho phần tiêu đề */
.txt-fx {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

/* Hiệu ứng slide-up */
@keyframes slide-up {
    0% {
        transform: translateY(30px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Áp dụng hiệu ứng */
.slide-up {
    animation: slide-up 1s ease-out;
}

/* Cải thiện icon */
.txt-fx i {
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

/* Thêm hiệu ứng hover cho icon */
.txt-fx i:hover {
    transform: scale(1.2);
}




/* Hiệu ứng ánh sáng cho icon */
.fas.fa-gift, .fas.fa-bolt {
    animation: glowing 1.5s infinite alternate;
}

@keyframes glowing {
    0% {
        text-shadow: 0 0 5px #fff, 0 0 10px #0066cc, 0 0 15px #0066cc;
    }
    100% {
        text-shadow: 0 0 10px #fff, 0 0 20px #0066cc, 0 0 30px #0066cc;
    }
}

.portfolio .grid {
    display: flex;
    flex-wrap: nowrap;
    overflow: hidden; /* Ẩn các phần tử ngoài khu vực hiển thị */
}

/* Giới hạn hiển thị chỉ 8 phần tử */
.grid .portfolio-item:nth-child(n+9) {
  display: none;
}


</style>


<section class="portfolio py-5">
    <div class="container">
        <div class="justify-content-center">
            <div class="row justify-content-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="section-header text-center">
                        <h4 class=" fs-2 txt-fx slide-up">
                            <i class="fas fa-gift text-primary me-2"></i>
                            Nhanh tay đăng ký các gói nổi bật trong hôm nay
                            <i class="fas fa-bolt text-warning ms-2"></i>
                        </h4>
                        
                    </div><!--section-header-->
                </div>

                <div id="filters" class="button-group d-flex flex-wrap gap-3 justify-content-center py-5" data-aos="fade-up">
                    <a href="#" class="btn btn-primary text-decoration-none text-uppercase is-checked" data-filter=".photography" style="background-color: #0066CC; border-color: #0066CC;">Gói cước</a>
                    <a href="#" class="btn btn-primary text-decoration-none text-uppercase" data-filter=".graphicdesign" style="background-color: #0066CC; border-color: #0066CC;">Gói Data</a>
                    <a href="#" class="btn btn-primary text-decoration-none text-uppercase" data-filter=".illustrations" style="background-color: #0066CC; border-color: #0066CC;">Dịch vụ</a>
                    <a href="#" class="btn btn-primary text-decoration-none text-uppercase" data-filter=".branding" style="background-color: #0066CC; border-color: #0066CC;">Loại thuê bao</a>
                </div>
            </div>

            
                <div class="grid p-0 clearfix row row-cols-2 row-cols-lg-3 row-cols-xl-4" data-aos="fade-up">
                    @foreach ($goicuocs as $goicuoc)
                        <div class="col mb-4 portfolio-item photography">
                            <div class="card shadow-sm @if($goicuoc->status == 'inactive') inactive @endif">
                                <div class="card-header">
                                    {{ $goicuoc->ten_goicuoc }}
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-tag text-primary me-2" style="font-size: 1.2rem;"></i>
                                        <p class="card-text mb-0" style="font-size: 1rem; color: #333;">Giá: {{ number_format($goicuoc->gia) }} VND</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-alt text-warning me-2" style="font-size: 1.2rem;"></i>
                                        <p class="card-text mb-0" style="font-size: 1rem; color: #333;">Thời gian: {{ $goicuoc->thoi_gian }} tháng</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-database text-success me-2" style="font-size: 1.2rem;"></i>
                                        <p class="card-text mb-0" style="font-size: 1rem; color: #333;">Dung lượng: {{ $goicuoc->dung_luong }} {{ $goicuoc->don_vi_dung_luong }}</p>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    @if($goicuoc->status == 'active')
                                        <a href="#" class="btn text-white text-uppercase w-100">
                                            Đăng ký ngay
                                        </a>
                                    @else
                                        <span class="btn text-white text-uppercase w-100" style="background-color: #cccccc; cursor: not-allowed;">
                                            Ngừng bán
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            
            
            
            <!-- Nút xem tất cả -->
            <div class="text-center p-3">
                <a href="index.html" class="btn btn-outline-dark btn-lg mt-3 text-uppercase text-decoration-none" >
                    Xem tất cả
                </a>
            </div>

        </div>
    </div>
</section>


    