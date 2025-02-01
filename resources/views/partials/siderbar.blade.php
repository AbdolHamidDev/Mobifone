<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/hamidkin.jpg') }}" class="img-circle elevation-2" alt="User Image"
                    style="border: 2px solid #00aaff;">
            </div>
          
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm..."
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

  <!-- Dropdown Gói Cước -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ajax-link">
        <i class="fas fa-cube" style="color:#6A0572;"></i> <!-- Màu tím đậm -->
        <p>
            Gói Cước
            <i class="fas fa-caret-square-down right" style="color:#1B998B;"></i> <!-- Màu xanh ngọc tươi -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Gói Cước Chính -->
        <li class="nav-item">
            <a href="{{ route('goicuocs.index') }}" class="nav-link ajax-link">
                <i class="fas fa-archive" style="color:#F76E11;"></i> <!-- Màu cam cháy -->
                <p>Gói Cước Chính</p>
            </a>
        </li>
        <!-- Gói Cước Chi Tiết -->
        <li class="nav-item">
            <a href="{{ route('goicuocs_detail.index') }}" class="nav-link ajax-link">
                <i class="fas fa-th-list" style="color:#8A5A44;"></i> <!-- Màu nâu đậm -->
                <p>Gói Cước Chi Tiết</p>
            </a>
        </li>
    </ul>
</li>

<!-- Dropdown Gói Data -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ajax-link">
        <i class="fas fa-signal" style="color:#B3001B;"></i> <!-- Màu đỏ đô -->
        <p>
            Gói Data
            <i class="fas fa-caret-square-down right" style="color:#3A6351;"></i> <!-- Màu xanh rêu -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Gói Data Chính -->
        <li class="nav-item">
            <a href="{{ route('Goidatas.index') }}" class="nav-link ajax-link">
                <i class="fas fa-server" style="color:#FFB703;"></i> <!-- Màu vàng sáng -->
                <p>Gói Data Chính</p>
            </a>
        </li>
        <!-- Gói Data Chi Tiết -->
        <li class="nav-item">
            <a href="{{ route('goidatas_detail.index') }}" class="nav-link ajax-link">
                <i class="fas fa-database" style="color:#A239CA;"></i> <!-- Màu tím sáng -->
                <p>Gói Data Chi Tiết</p>
            </a>
        </li>
    </ul>
</li>


<!-- Tin tức & khuyến mãi -->
<li class="nav-item">
    <a href="{{ route('news.index') }}" class="nav-link ajax-link">
        <i class="fas fa-bullhorn" style="color:#C0392B;"></i> <!-- Màu đỏ sẫm -->
        <p>Tin tức & khuyến mãi</p>
    </a>
</li>

<!-- Dropdown Tuyển dụng -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ajax-link toggle-dropdown">
        <i class="fas fa-users" style="color:#2980B9;"></i> <!-- Màu xanh biển -->
        <p>
            Tuyển dụng
            <i class="fas fa-chevron-down right" style="color:#7E5109;"></i> <!-- Màu nâu đất -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Danh sách tuyển dụng -->
        <li class="nav-item">
            <a href="{{ route('tuyendung.index') }}" class="nav-link ajax-link">
                <i class="fas fa-briefcase" style="color:#AF601A;"></i> <!-- Màu cam đồng -->
                <p>Danh sách tuyển dụng</p>
            </a>
        </li>
        <!-- Quản lý CV -->
        <li class="nav-item">
            <a href="{{ route('cv.index') }}" class="nav-link ajax-link">
                <i class="fas fa-file-contract" style="color:#16A085;"></i> <!-- Màu xanh ngọc bích -->
                <p>Quản lý CV</p>
            </a>
        </li>
    </ul>
</li>

<!-- Tìm kiếm cửa hàng -->
<li class="nav-item">
    <a href="{{ route('store.index') }}" class="nav-link ajax-link">
        <i class="fas fa-map-marker-alt" style="color:#8E44AD;"></i> <!-- Màu tím sáng -->
        <p>Tìm kiếm cửa hàng</p>
    </a>
</li>

<!-- Đăng ký chuyển mạng -->
<li class="nav-item">
    <a href="{{ route('dang-ky-chuyen-doi-mang.index') }}" class="nav-link ajax-link">
        <i class="fas fa-random" style="color:#5DADE2;"></i> <!-- Màu xanh dương nhạt -->
        <p>Đăng ký chuyển mạng</p>
    </a>
</li>

<!-- Liên hệ -->
<li class="nav-item">
    <a href="{{ route('contact.index') }}" class="nav-link ajax-link">
        <i class="fas fa-envelope" style="color:#F4D03F;"></i> <!-- Màu vàng chanh -->
        <p>Liên hệ</p>
    </a>
</li>


            
               <!-- Dropdown Dịch vụ di động -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ajax-link toggle-dropdown">
        <i class="fas fa-mobile-alt" style="color:#FF6F61;"></i> <!-- Màu cam san hô -->
        <p>
            Dịch vụ di động
            <i class="fas fa-chevron-down right" style="color:#6A0572;"></i> <!-- Màu tím đậm -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Mục đầu tiên -->
        <li class="nav-item">
            <a href="{{ route('subscription-types.index') }}" class="nav-link ajax-link">
                <i class="fas fa-sim-card" style="color:#8E44AD;"></i> <!-- Màu tím sáng -->
                <p>Loại thuê bao</p>
            </a>
        </li>


        <!-- Mục thứ 2 -->
        <li class="nav-item">
            <a href="{{ route('dichvus.index') }}" class="nav-link ajax-link">
                <i class="fas fa-sim-card" style="color:#8E44AD;"></i> <!-- Màu tím sáng -->
                <p>Dịch vụ</p>
            </a>
        </li>



          <!-- Mục thứ 3 -->
          <li class="nav-item">
            <a href="{{ route('so-thue-bao.index') }}" class="nav-link ajax-link">
                <i class="fas fa-sim-card" style="color:#149acb;"></i> <!-- Màu tím sáng -->
                <p>Số thuê bao</p>
            </a>
        </li>




    </ul>
</li>

<!-- Dropdown Khách Hàng Đăng Ký -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link ajax-link toggle-dropdown">
        <i class="fas fa-user-edit" style="color:#D72638;"></i> <!-- Màu đỏ rực -->
        <p>
            Khách hàng đăng ký
            <i class="fas fa-sort-down right" style="color:#07689F;"></i> <!-- Màu xanh biển tối -->
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Gói Cước -->
        <li class="nav-item">
            <a href="{{ route('subscriptions.index') }}" class="nav-link ajax-link">
                <i class="fas fa-link" style="color:#FFC300;"></i> <!-- Màu vàng đậm -->
                <p>Gói Cước</p>
            </a>
        </li>
        <!-- Gói Data -->
        <li class="nav-item">
            <a href="{{ route('subscriptions.data') }}" class="nav-link ajax-link">
                <i class="fas fa-network-wired" style="color:#118DF0;"></i> <!-- Màu xanh lam sáng -->
                <p>Gói Data</p>
            </a>
        </li>
        <!-- Gói Cước Tự Tạo -->
        <li class="nav-item">
            <a href="{{ route('custom-packages.index') }}" class="nav-link ajax-link">
                <i class="fas fa-tools" style="color:#EF3054;"></i> <!-- Màu đỏ tươi -->
                <p>Gói Cước Tự Tạo</p>
            </a>
        </li>


          <!-- Đăng ký hòa mạng -->
          <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link ajax-link">
                <i class="fas fa-tools" style="color:#EF3054;"></i> <!-- Màu đỏ tươi -->
                <p>Đăng ký hòa mạng</p>
            </a>
        </li>
    </ul>
</li>



                
            </ul>
        </nav>



    </div>
</aside>

<!-- Đảm bảo jQuery được tải đầu tiên -->

<link rel="stylesheet" href="{{ asset('admins/Sidebar/sidebar.css') }}">


<script>



$(document).ready(function () {
    // Kích hoạt PJAX
    $(document).pjax('a.ajax-link', '#content-area', {
        timeout: 5000  // Thời gian chờ cho request
    });

    // Hiển thị spinner trong khi tải
    $(document).on('pjax:start', function () {
        $('#content-area').html('<div class="text-center mt-5"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
    });

    

    // Xử lý sau khi PJAX hoàn tất
    $(document).on('pjax:end', function () {
        console.log('Nội dung đã được tải bằng PJAX.');
    });

});



</script>
