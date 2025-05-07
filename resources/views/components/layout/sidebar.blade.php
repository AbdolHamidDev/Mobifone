<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/hamidkin.jpg') }}" class="img-circle elevation-2" alt="User Image">
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
                <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dropdown Gói Cước -->
                @if(auth()->user()->can('quản lý gói cước'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-cube"></i>
                        <p>
                            Gói Cước
                            <i class="fas fa-angle-down right"></i>
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
                @endif
                
                @if(auth()->user()->can('quản lý gói data'))
                <!-- Dropdown Gói Data -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-signal"></i>
                        <p>
                            Gói Data
                            <i class="fas fa-angle-down right"></i>
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
                @endif

                @if(auth()->user()->can('quản lý dịch vụ di động'))
                <!-- Dropdown Dịch vụ di động -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-broadcast-tower"></i>
                        <p>
                            Dịch vụ di động
                            <i class="fas fa-angle-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('quản lý loại thuê bao'))
                        <!-- Loại thuê bao -->
                        <li class="nav-item">
                            <a href="{{ route('subscription-types.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-id-card-alt"></i>
                                <p>Loại thuê bao</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý dịch vụ'))
                        <!-- Dịch vụ -->
                        <li class="nav-item">
                            <a href="{{ route('dichvus.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-cogs"></i>
                                <p>Dịch vụ</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý số thuê bao'))
                        <!-- Số thuê bao -->
                        <li class="nav-item">
                            <a href="{{ route('so-thue-bao.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-phone-square"></i>
                                <p>Số thuê bao</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(auth()->user()->can('quản lý dịch vụ quốc tế'))
                <!-- Dropdown dịch vụ quốc tế -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-globe"></i>
                        <p>
                            Dịch vụ quốc tế
                            <i class="fas fa-angle-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('quản lý quốc gia'))
                        <!-- Quốc gia -->
                        <li class="nav-item">
                            <a href="{{ route('quoc-gia.index') }}" class="nav-link">
                                <i class="fas fa-flag"></i>
                                <p>Quốc gia</p>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth()->user()->can('quản lý nhà khai thác'))
                        <!-- Nhà khai thác -->
                        <li class="nav-item">
                            <a href="{{ route('nha-khai-thac.index') }}" class="nav-link">
                                <i class="fas fa-broadcast-tower"></i>
                                <p>Nhà khai thác</p>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth()->user()->can('quản lý cước quốc tế'))
                        <!-- Cước Quốc tế -->
                        <li class="nav-item">
                            <a href="{{ route('cuoc-quoc-te.index') }}" class="nav-link">
                                <i class="fas fa-dollar-sign"></i>
                                <p>Cước Quốc tế</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý gọi VoIP'))
                        <!-- Gọi VoIP 131 -->
                        <li class="nav-item">
                            <a href="{{ route('goi-voip-cuoc-phi.index') }}" class="nav-link">
                                <i class="fas fa-phone-volume"></i>
                                <p>Gọi VoIP 131</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(auth()->user()->can('quản lý khách hàng đăng ký'))
                <!-- Dropdown Khách Hàng Đăng Ký -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-user-check"></i>
                        <p>
                            Khách hàng đăng ký
                            <i class="fas fa-angle-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('quản lý đăng ký gói cước'))
                        <!-- Gói Cước -->
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-file-contract"></i>
                                <p>Gói Cước</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý đăng ký gói data'))
                        <!-- Gói Data -->
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.data') }}" class="nav-link ajax-link">
                                <i class="fas fa-wifi"></i>
                                <p>Gói Data</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý gói cước tự tạo'))
                        <!-- Gói Cước Tự Tạo -->
                        <li class="nav-item">
                            <a href="{{ route('custom-packages.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-layer-group"></i>
                                <p>Gói Cước Tự Tạo</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('quản lý đăng ký hòa mạng'))
                        <!-- Đăng ký hòa mạng -->
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-user-plus"></i>
                                <p>Đăng ký hòa mạng</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(auth()->user()->can('quản lý tuyển dụng'))
                <!-- Dropdown Tuyển dụng -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ajax-link toggle-dropdown">
                        <i class="fas fa-users"></i>
                        <p>
                            Tuyển dụng
                            <i class="fas fa-angle-down right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('quản lý danh sách tuyển dụng'))
                        <!-- Danh sách tuyển dụng -->
                        <li class="nav-item">
                            <a href="{{ route('tuyendung.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-briefcase"></i>
                                <p>Danh sách tuyển dụng</p>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth()->user()->can('quản lý CV'))
                        <!-- Quản lý CV -->
                        <li class="nav-item">
                            <a href="{{ route('cv.index') }}" class="nav-link ajax-link">
                                <i class="fas fa-file-contract"></i>
                                <p>Quản lý CV</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(auth()->user()->can('quản lý đăng ký chuyển mạng'))
                <!-- Đăng ký chuyển mạng -->
                <li class="nav-item">
                    <a href="{{ route('dang-ky-chuyen-doi-mang.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-random"></i>
                        <p>Đăng ký chuyển mạng</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý tin tức và khuyến mãi'))
                <!-- Tin tức & khuyến mãi -->
                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-bullhorn"></i>
                        <p>Tin tức & khuyến mãi</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý cửa hàng'))
                <!-- Tìm kiếm cửa hàng -->
                <li class="nav-item">
                    <a href="{{ route('store.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Tìm kiếm cửa hàng</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý liên hệ'))
                <!-- Liên hệ -->
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-envelope"></i>
                        <p>Liên hệ</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý chat'))
                <!-- Chat -->
                <li class="nav-item">
                    <a href="{{ route('chat.admin') }}" class="nav-link ajax-link">
                        <i class="fas fa-paper-plane"></i>
                        <p>Chat</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý hủy gói'))
                <!-- Hủy gói -->
                <li class="nav-item">
                    <a href="{{ route('cancellations.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-ban"></i>
                        <p>Khách hàng hủy gói</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý nhân viên') || auth()->user()->hasRole('admin'))
                <!-- Quản lý nhân viên -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-users-cog"></i>
                        <p>Danh sách nhân viên</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('quản lý vai trò') || auth()->user()->hasRole('admin'))
                <!-- Quản lý vai trò -->
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link ajax-link">
                        <i class="fas fa-user-shield"></i>
                        <p>Danh sách vai trò</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>