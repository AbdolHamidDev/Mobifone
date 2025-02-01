<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Chuyển đổi mạng</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="chuyenmang/css/bootstrap.css" />
  <!-- fonts awesome style -->
  <link href="chuyenmang/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="chuyenmang/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="chuyenmang/css/responsive.css" rel="stylesheet" />

  <!-- Bootstrap CSS (Version 5.1.3) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Popper.js (Version 2.11.6) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS (Version 5.1.3) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

@include('frontend.chuyenmang.header')
@include('frontend.chuyenmang.feature')
@include('frontend.chuyenmang.tab')
@include('frontend.chuyenmang.footer')

<!-- Hiển thị SweetAlert khi có thông báo thành công -->
@if (session('success'))
<script>
    Swal.fire({
        title: 'Thành công!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
<script src="chuyenmang/js/jquery-3.4.1.min.js"></script>
<script src="chuyenmang/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="chuyenmang/js/custom.js"></script>
</body>
</html>