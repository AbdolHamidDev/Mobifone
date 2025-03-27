<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hệ thống')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon1.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon1.ico') }}">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- Core CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @vite('resources/css/app.css')
    
    <!-- Icon Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- UI Framework -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    
    <!-- DataTables CSS - QUAN TRỌNG: Thêm đúng thứ tự -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  
    
    <!-- UI Components -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admins/header/header.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/mode.css') }}">

    <!-- Fix CSS cho DataTables -->
    <style>
        /* Đảm bảo phân trang DataTables phù hợp với Bootstrap 5 */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin-left: -1px;
            line-height: 1.5;
            color: #0d6efd;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
            display: inline-block;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            z-index: 3;
            color: #fff !important;
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            z-index: 2;
            color: #0a58ca;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            color: #6c757d !important;
            cursor: default;
            background-color: #fff !important;
            border-color: #dee2e6 !important;
        }
        
        /* Fix khoảng cách và căn chỉnh phân trang */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
            float: right !important;
        }
        
        /* Fix header table */
        .dataTables_wrapper .table thead th {
            position: relative;
            background-color: #f8f9fa;
        }
    </style>
    
    <!-- Page-specific CSS -->
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('partials.header')
        @include('partials.siderbar')
        
        <div id="content-area">
            @yield('content')
        </div>
    </div>
    
    <!-- Core JS Libraries -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <!-- Data Handling -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    
    <!-- DataTables JS - QUAN TRỌNG: Thêm đúng thứ tự -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- UI Components -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Charting -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Modern Frameworks -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('admins/header/header.js') }}"></script>
    
    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            // Khởi tạo DataTables với cấu hình tối ưu
            $('.data-table').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                drawCallback: function(settings) {
                    // Xử lý sau khi vẽ bảng
                    $('.dataTables_paginate').addClass('pagination');
                    $('.paginate_button').addClass('page-item');
                    $('.paginate_button a').addClass('page-link');
                }
            });
            
            // Áp dụng class Bootstrap cho các phần tử phân trang
            $(document).on('draw.dt', function() {
                $('.dataTables_paginate').addClass('pagination');
                $('.paginate_button').addClass('page-item');
                $('.paginate_button a').addClass('page-link');
            });
        });
    </script>

    <!-- Notification Handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init();
            }
            
            // Success notification
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
            @endif
            
            // Error notification
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
            });
            @endif
            
            // Info notification
            @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Thông tin!',
                text: '{{ session('info') }}',
            });
            @endif
            
            // Delete confirmation handler
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Có, xóa!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    
    <!-- Page-specific JS -->
    @yield('js')
</body>

</html>