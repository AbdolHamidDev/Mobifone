<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/hamidkin.jpg') }}" class="img-circle elevation-2" alt="User Image"
                    style="border: 2px solid #00aaff;">
            </div>
            <div class="info text-center mt-2">
                @auth
                    <a href="#" class="d-block font-weight-bold">{{ auth()->user()->name }}</a>
                @else
                    <a href="{{ route('login') }}" class="d-block mt-2">Đăng nhập</a>
                @endauth
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Nút Đăng xuất với icon -->
            <button type="button" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i>
            </button>
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
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-cube"></i>
                        <p>
                            Gói Cước
                            <i class="fas fa-caret-square-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Gói Cước Chính -->
                        <li class="nav-item">
                            <a href="{{ route('goicuocs.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-archive"></i>
                                <p>Gói Cước Chính</p>
                            </a>
                        </li>
                        <!-- Gói Cước Chi Tiết -->
                        <li class="nav-item">
                            <a href="{{ route('goicuocs_detail.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-th-list"></i>
                                <p>Gói Cước Chi Tiết</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Gói Data -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-signal"></i>
                        <p>
                            Gói Data
                            <i class="fas fa-caret-square-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Gói Data Chính -->
                        <li class="nav-item">
                            <a href="{{ route('Goidatas.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-server"></i>
                                <p>Gói Data Chính</p>
                            </a>
                        </li>
                        <!-- Gói Data Chi Tiết -->
                        <li class="nav-item">
                            <a href="{{ route('goidatas_detail.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-database"></i>
                                <p>Gói Data Chi Tiết</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Dịch vụ di động -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-broadcast-tower"></i> <!-- Icon Tháp sóng đại diện cho dịch vụ di động -->
                        <p>
                            Dịch vụ di động
                            <i class="fas fa-angle-down right"></i> <!-- Mũi tên dropdown -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Loại thuê bao -->
                        <li class="nav-item">
                            <a href="{{ route('subscription-types.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-id-card-alt"></i> <!-- Icon thẻ SIM hoặc CMND -->
                                <p>Loại thuê bao</p>
                            </a>
                        </li>

                        <!-- Dịch vụ -->
                        <li class="nav-item">
                            <a href="{{ route('dichvus.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-cogs"></i> <!-- Icon Cài đặt, đại diện cho dịch vụ -->
                                <p>Dịch vụ</p>
                            </a>
                        </li>

                        <!-- Số thuê bao -->
                        <li class="nav-item">
                            <a href="{{ route('so-thue-bao.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-phone-square"></i> <!-- Icon Điện thoại, đại diện số thuê bao -->
                                <p>Số thuê bao</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Dropdown dịch vụ quốc tế -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-globe"></i> <!-- Icon Trái Đất (đại diện cho Quốc tế) -->
                        <p>
                            Dịch vụ quốc tế
                            <i class="fas fa-angle-down right"></i> <!-- Mũi tên xuống -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Quốc gia -->
                        <li class="nav-item">
                            <a href="{{ route('quoc-gia.index') }}" class="nav-link">
                                <i class="fas fa-flag"></i> <!-- Icon Lá cờ đại diện cho quốc gia -->
                                <p>Quốc gia</p>
                            </a>
                        </li>
                        <!-- Nhà khai thác -->
                        <li class="nav-item">
                            <a href="{{ route('nha-khai-thac.index') }}" class="nav-link">
                                <i class="fas fa-broadcast-tower"></i>
                                <!-- Icon Ăng-ten, thể hiện nhà mạng viễn thông -->
                                <p>Nhà khai thác</p>
                            </a>
                        </li>
                        <!-- Cước Quốc tế -->
                        <li class="nav-item">
                            <a href="{{ route('cuoc-quoc-te.index') }}" class="nav-link">
                                <i class="fas fa-dollar-sign"></i> <!-- Icon Dollar đại diện cho cước phí -->
                                <p> Cước Quốc tế</p>
                            </a>
                        </li>

                        <!-- Gọi VoIP 131 -->
                        <li class="nav-item">
                            <a href="{{ route('goi-voip-cuoc-phi.index') }}" class="nav-link">
                                <i class="fas fa-phone-volume"></i> <!-- Icon Điện thoại với sóng VoIP -->
                                <p> Gọi VoIP 131</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Dropdown Khách Hàng Đăng Ký -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-user-check"></i> <!-- Icon người dùng đăng ký -->
                        <p>
                            Khách hàng đăng ký
                            <i class="fas fa-angle-down right"></i> <!-- Mũi tên xuống -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Gói Cước -->
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-file-contract"></i> <!-- Icon hợp đồng, phù hợp với gói cước -->
                                <p>Gói Cước</p>
                            </a>
                        </li>

                        <!-- Gói Data -->
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.data') }}" class="nav-link ajax-link">
                                <i class="fas fa-wifi"></i> <!-- Icon Wifi, phù hợp với Gói Data -->
                                <p>Gói Data</p>
                            </a>
                        </li>

                        <!-- Gói Cước Tự Tạo -->
                        <li class="nav-item">
                            <a href="{{ route('custom-packages.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-layer-group"></i> <!-- Icon nhóm dịch vụ, phù hợp với gói tự tạo -->
                                <p>Gói Cước Tự Tạo</p>
                            </a>
                        </li>

                        <!-- Đăng ký hòa mạng -->
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-user-plus"></i> <!-- Icon đăng ký người dùng, phù hợp với hòa mạng -->
                                <p>Đăng ký hòa mạng</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Dropdown Tuyển dụng -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-users"></i>
                        <p>
                            Tuyển dụng
                            <i class="fas fa-chevron-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Danh sách tuyển dụng -->
                        <li class="nav-item">
                            <a href="{{ route('tuyendung.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-briefcase"></i>
                                <p>Danh sách tuyển dụng</p>
                            </a>
                        </li>
                        <!-- Quản lý CV -->
                        <li class="nav-item">
                            <a href="{{ route('cv.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-file-contract"></i> <!-- Màu xanh ngọc bích -->
                                <p>Quản lý CV</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Đăng ký chuyển mạng -->
                <li class="nav-item">
                    <a href="{{ route('dang-ky-chuyen-doi-mang.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-random"></i> <!-- Màu xanh dương nhạt -->
                        <p>Đăng ký chuyển mạng</p>
                    </a>
                </li>

                <!-- Tin tức & khuyến mãi -->
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-bullhorn"></i> <!-- Màu đỏ sẫm -->
                        <p>Tin tức & khuyến mãi</p>
                    </a>
                </li>

                <!-- Tìm kiếm cửa hàng -->
                <li class="nav-item">
                    <a href="{{ route('store.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-map-marker-alt"></i> <!-- Màu tím sáng -->
                        <p>Tìm kiếm cửa hàng</p>
                    </a>
                </li>

                <!-- Liên hệ -->
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-envelope"></i> <!-- Màu vàng chanh -->
                        <p>Liên hệ</p>
                    </a>
                </li>

                <!-- Chat -->
                <li class="nav-item">
                    <a href="{{ route('chat.admin') }}" class="nav-link ajax-link">
                        <i class="fas fa-paper-plane" style="color:#1DA1F2;"></i> <!-- Màu xanh Telegram -->
                        <p>Chat</p>
                    </a>
                </li>


                <!-- Hủy gói -->
                <li class="nav-item">
                    <a href="{{ route('cancellations.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-ban" style="color:#FF4757;"></i> 
                        <p>Khách hàng hủy gói</p>
                    </a>
                </li>



            </ul>
        </nav>

    </div>
</aside>
