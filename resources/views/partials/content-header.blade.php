<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="flex justify-end items-center gap-2 text-sm text-gray-200 animate-fadeInUp pr-6">
                        <!-- Icon Name -->
                        <a href="#" class="no-underline font-semibold flex items-center px-4 py-2 rounded-full bg-blue-500/40 backdrop-blur-md shadow-md transition hover:bg-blue-500/60 hover:shadow-lg">
                            <i class="fas fa-home mr-2"></i> {{ $name }}
                        </a>
                        <span>/</span>
                        
                        <!-- Icon Key -->
                        @php
                            $icons = [
                                'users' => 'fas fa-users',       // Quản lý người dùng
                                'settings' => 'fas fa-cog',      // Cài đặt
                                'dashboard' => 'fas fa-chart-bar', // Bảng điều khiển
                                'orders' => 'fas fa-shopping-cart', // Đơn hàng
                                'reports' => 'fas fa-file-alt',  // Báo cáo
                                'support' => 'fas fa-life-ring', // Hỗ trợ
                            ];
                            $iconKey = $icons[$key] ?? 'fas fa-folder'; // Mặc định là folder nếu không có
                        @endphp
                        <span class="text-gray-600 flex items-center">
                            <i class="{{ $iconKey }} mr-2"></i> {{ $key }}
                        </span>
                    </nav>
                </div>
            </div>
        </div>
    </div>

