<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Mobifone Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mobifone Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ Auth::user()->name ?? 'Admin' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('goicuocs.danhsach') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Gói cước</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sothuebao.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p>Số thuê bao</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tintuc.danhsach') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Tin tức & KM</p>
                    </a>
                </li>
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