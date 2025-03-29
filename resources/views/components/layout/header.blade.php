
<nav class="main-header navbar navbar-expand-lg navbar-dark"
    style="background: linear-gradient(180deg, #1c1c28, #2e2e44); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="/admin/home" class="nav-link text-white">
                <i class="fas fa-home"></i> Dasbroard
            </a>
        </li>
     

    </ul>


     <!-- 🌟 LOGO MOBIFONE ở giữa -->
     <div class="d-flex justify-content-end" style="width: 40%;">
        <a href="/admin/home">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mobifone Logo" class="navbar-logo">
        </a>
    </div>
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
              <!-- Chat Messages Dropdown -->
<li class="relative">
    <button class="relative flex items-center text-gray-500 hover:text-blue-600 focus:outline-none" id="chatDropdownButton">
        <i class="fa-solid fa-comments small-icon"></i>



        @if ($conversations->sum('unread_count') > 0)
            <span class="absolute top-0 right-0 transform translate-x-2 -translate-y-2 bg-red-500 text-white scale-75 font-bold px-0.5 py-0 rounded-full">
                {{ $conversations->sum('unread_count') > 99 ? '99+' : $conversations->sum('unread_count') }}
            </span>
        @endif
    </button>

    <!-- Dropdown Content -->
    <div id="chatDropdownMenu" class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 shadow-lg rounded-lg z-50">
        <div class="p-3 border-b text-gray-700 font-semibold">
            {{ $conversations->sum('unread_count') > 0 ? $conversations->sum('unread_count') . ' Tin nhắn mới' : 'Không có tin nhắn mới' }}
        </div>

        <div class="max-h-64 overflow-y-auto">
            @if ($conversations->count() > 0)
                @foreach ($conversations->take(5) as $conversation)
                    @php
                        $latestMessage = $conversation->messages()->latest()->first();
                    @endphp
                    @if ($latestMessage)
                        <a href="{{ route('chat.admin.messages', $conversation->id) }}" class="flex items-center px-4 py-3 hover:bg-gray-100">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($conversation->phone) }}&background=random&color=fff&size=40" class="w-10 h-10 rounded-full">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">{{ $conversation->phone }}</p>
                                <p class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($latestMessage->message, 40) }}</p>
                            </div>
                            @if ($conversation->unread_count > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                    {{ $conversation->unread_count }}
                                </span>
                            @endif
                        </a>
                        <div class="border-t"></div>
                    @endif
                @endforeach
            @else
                <p class="px-4 py-3 text-sm text-gray-600">Không có tin nhắn mới</p>
            @endif
        </div>

        <a href="{{ route('chat.admin') }}" class="block text-center py-2 text-blue-600 font-medium hover:bg-gray-100">
            Xem tất cả
        </a>
    </div>
</li>

        <!-- Nút icon để mở modal -->
        <div class="modal-container">
            <a class="nav-link text-white" id="view-registered-emails" href="#" role="button">
                <i class="fas fa-envelope"></i>
                <span class="badge badge-danger navbar-badge" id="email-count">0</span>
            </a>
            </li>

            <!-- Modal -->
            <div id="email-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h5>Danh sách email đã đăng ký</h5>
                    <div id="email-list"></div>
                </div>
            </div>
        </div>



        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">
                        {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">
                        {{ isset($contacts) && $contacts->count() > 0 ? $contacts->count() : 0 }} Messages
                    </span>
                    <div class="dropdown-divider"></div>

                    @if (isset($contacts) && $contacts->count() > 0)
                        @foreach ($contacts as $contact)
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ $contact->name }} <!-- Hiển thị tên người gửi -->
                                        </h3>
                                        <p class="text-sm">{{ $contact->message }}</p> <!-- Hiển thị tin nhắn -->
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ $contact->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    @else
                        <a href="#" class="dropdown-item">No messages available</a>
                    @endif
        </li>
       

<!-- Script Toggle Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownButton = document.getElementById("chatDropdownButton");
        const dropdownMenu = document.getElementById("chatDropdownMenu");

        dropdownButton.addEventListener("click", function (event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function () {
            dropdownMenu.classList.add("hidden");
        });
    });
</script>



        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>

</nav>



<style>
    .navbar-logo {
    height: 30px; /* Điều chỉnh kích thước logo */
    max-width: 150px;
}

.small-icon {
    font-size: 24px; /* Hoặc 14px nếu cần nhỏ hơn */
}




</style>