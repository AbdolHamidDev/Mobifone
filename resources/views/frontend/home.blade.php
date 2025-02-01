@extends('layouts.frontend')

@section('title', 'MobiFone')

@section('content')


    <!-- Banner Section -->
    @include('frontend.banner')

    <!-- Services Section -->
    @include('frontend.services')

    <!-- Simple CTA Section -->
    @include('frontend.simple-cta')

    <!-- Đăng ký nhanh -->
    @include('frontend.dangkynhanh')

    <!-- About Section -->
    @include('frontend.about')

    <!-- Calculator Section -->
    @include('frontend.calculator')

    @include('frontend.map')
    <!-- Testimonials Section -->
    @include('frontend.testimonials')
 
@endsection



<div id="scroll-buttons">
  <button id="scroll-to-top" title="Lên đầu trang">&#x25B2; </button>
  <button id="scroll-to-bottom" title="Xuống cuối trang">&#x25BC; </button>
</div>
@push('scripts')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
    
</script>
@endif
<script>
    // Khởi tạo Swiper
    const swiper = new Swiper('#top', {
      loop: true, // Cho phép quay vòng
      slidesPerView: 1, // Hiển thị 1 slide mỗi lần
      spaceBetween: 10, // Khoảng cách giữa các slide
      navigation: {
        nextEl: '.swiper-button-next', // Nút tiếp theo
        prevEl: '.swiper-button-prev', // Nút quay lại
      },
      autoplay: {
        delay: 5000, // Tự động chuyển slide sau mỗi 5 giây
      },
    });

    // Lấy các nút
const scrollTopButton = document.getElementById('scroll-to-top');
const scrollBottomButton = document.getElementById('scroll-to-bottom');

// Thêm sự kiện cuộn trang
window.addEventListener('scroll', function () {
    const scrollTop = window.scrollY; // Vị trí hiện tại so với đầu trang
    const windowHeight = window.innerHeight; // Chiều cao cửa sổ
    const docHeight = document.body.offsetHeight; // Tổng chiều cao trang

    // Hiển thị nút "Lên đầu" nếu cuộn xuống hơn 200px
    if (scrollTop > 200) {
        scrollTopButton.style.display = 'block';
    } else {
        scrollTopButton.style.display = 'none';
    }

    // Hiển thị nút "Xuống cuối" nếu chưa ở cuối trang
    if (scrollTop + windowHeight < docHeight - 200) {
        scrollBottomButton.style.display = 'block';
    } else {
        scrollBottomButton.style.display = 'none';
    }
});

// Xử lý sự kiện nhấn vào nút "Lên đầu"
scrollTopButton.addEventListener('click', function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
});

// Xử lý sự kiện nhấn vào nút "Xuống cuối"
scrollBottomButton.addEventListener('click', function () {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth',
    });
});

// Đặt trạng thái mặc định của các nút là ẩn
scrollTopButton.style.display = 'none';
scrollBottomButton.style.display = 'none';

  </script>
@endpush
<style>
/* Container nút cuộn */
#scroll-buttons {
    position: fixed;
    right: 30px; /* Đặt nút cách cạnh phải xa hơn một chút */
    bottom: 30px; /* Đặt nút cách cạnh dưới xa hơn một chút */
    display: flex;
    flex-direction: column;
    gap: 15px; /* Khoảng cách giữa các nút */
    z-index: 1000; /* Ưu tiên hiển thị trên các phần tử khác */
}

/* Phong cách chung cho nút */
#scroll-buttons button {
    background-color: #4f4c4c; /* Màu nền tối hiện đại */
    color: #ffffff; /* Màu chữ trắng nổi bật */
    border: 2px solid transparent; /* Viền ẩn mặc định */
    border-radius: 50%; /* Bo tròn nút */
    padding: 15px; /* Tăng kích thước padding để nút trông lớn hơn */
    width: 50px; /* Chiều rộng cố định */
    height: 50px; /* Chiều cao cố định */
   
    cursor: pointer; /* Con trỏ dạng nút */
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3); /* Hiệu ứng đổ bóng mềm mại */
    transition: all 0.3s ease; /* Hiệu ứng chuyển mượt mà */
}

/* Hiệu ứng hover */
#scroll-buttons button:hover {
    background-color: #007bff; /* Thay đổi màu nền khi hover */
    color: #ffffff; /* Giữ màu chữ trắng */
    border-color: #ffffff; /* Thêm viền trắng khi hover */
    transform: scale(1.15); /* Hiệu ứng phóng to nhẹ khi hover */
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.5); /* Tăng độ nổi bật khi hover */
}

/* Hiệu ứng khi nhấn */
#scroll-buttons button:active {
    transform: scale(1); /* Thu nhỏ về kích thước ban đầu */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3); /* Giảm độ nổi bật */
}



</style>

