<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Mobifone Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mobifone Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Dropdown Gói Cước -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            Gói Cước
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('goicuocs.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>Gói Cước Chính</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('goicuocs_detail.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Gói Cước Chi Tiết</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Gói Data -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-signal"></i>
                        <p>
                            Gói Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('Goidatas.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-server"></i>
                                <p>Gói Data Chính</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('goidatas_detail.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Gói Data Chi Tiết</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Dịch vụ di động -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-broadcast-tower"></i>
                        <p>
                            Dịch vụ di động
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('subscription-types.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-id-card-alt"></i>
                                <p>Loại thuê bao</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dichvus.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Dịch vụ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('so-thue-bao.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-phone-square"></i>
                                <p>Số thuê bao</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Dịch vụ quốc tế -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Dịch vụ quốc tế
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('quoc-gia.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>Quốc gia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nha-khai-thac.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-broadcast-tower"></i>
                                <p>Nhà khai thác</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cuoc-quoc-te.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>Cước Quốc tế</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('goi-voip-cuoc-phi.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-phone-volume"></i>
                                <p>Gói VoIP 131</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Khách hàng đăng ký -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Khách hàng đăng ký
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>Gói Cước</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.data') }}" class="nav-link">
                                <i class="nav-icon fas fa-wifi"></i>
                                <p>Gói Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('custom-packages.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Gói Cước Tự Tạo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Đăng ký hòa mạng</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown Tuyển dụng -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Tuyển dụng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tuyendung.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>Danh sách tuyển dụng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cv.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>Quản lý CV</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Đăng ký chuyển mạng -->
                <li class="nav-item">
                    <a href="{{ route('dang-ky-chuyen-doi-mang.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-random"></i>
                        <p>Đăng ký chuyển mạng</p>
                    </a>
                </li>

                <!-- Tin tức & khuyến mãi -->
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Tin tức & khuyến mãi</p>
                    </a>
                </li>

                <!-- Tìm kiếm cửa hàng -->
                <li class="nav-item">
                    <a href="{{ route('store.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>Tìm kiếm cửa hàng</p>
                    </a>
                </li>

                <!-- Liên hệ -->
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Liên hệ</p>
                    </a>
                </li>

                <!-- Chat -->
                <li class="nav-item">
                    <a href="{{ route('chat.admin') }}" class="nav-link">
                        <i class="nav-icon fas fa-paper-plane" style="color:#1DA1F2;"></i>
                        <p>Chat</p>
                    </a>
                </li>

                <!-- Hủy gói -->
                <li class="nav-item">
                    <a href="{{ route('cancellations.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ban" style="color:#FF4757;"></i>
                        <p>Khách hàng hủy gói</p>
                    </a>
                </li>

                <!-- Người dùng -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Người dùng</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>