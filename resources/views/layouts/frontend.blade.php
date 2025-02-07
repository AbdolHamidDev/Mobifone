<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  

    <title>@yield('title', 'Mobifone')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
    <!-- Additional CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Header -->
    @include('frontend.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

 <!-- Scripts -->

 

 <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
 <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
 <script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- Tải jQuery từ CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tải Popper.js từ CDN (Yêu cầu cho Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<!-- Tải Bootstrap từ CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



 <script src="{{ asset('assets/js/plugins.js') }}"></script>
 <script type="text/javascript" src="{{ asset('assets/js/lightbox.min.js') }}"></script>

 <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
 <script src="{{ asset('assets/js/script.js') }}"></script>

 @yield('js')
@stack('scripts')
</body>

</html>
