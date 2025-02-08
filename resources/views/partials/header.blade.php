

<link rel="stylesheet" href="">
<script src=""></script>
<nav class="main-header navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(180deg, #1c1c28, #2e2e44); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="/admin/home" class="nav-link text-white">Home</a>
        </li>
        

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
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

        @if(isset($contacts) && $contacts->count() > 0)
            @foreach ($contacts as $contact)
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ $contact->name }} <!-- Hiển thị tên người gửi -->
                            </h3>
                            <p class="text-sm">{{ $contact->message }}</p> <!-- Hiển thị tin nhắn -->
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $contact->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            @endforeach
        @else
            <a href="#" class="dropdown-item">No messages available</a>
        @endif

<!-- Chat Messages Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link text-dark" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-info navbar-badge">
            {{ $conversations->sum('unread_count') > 0 ? $conversations->sum('unread_count') : '' }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">
            {{ $conversations->sum('unread_count') > 0 ? $conversations->sum('unread_count') . ' Tin nhắn mới' : 'Không có tin nhắn mới' }}
        </span>
        <div class="dropdown-divider"></div>

        @if(isset($conversations) && $conversations->count() > 0)
            @foreach ($conversations->take(5) as $conversation)
                @php
                    $latestMessage = $conversation->messages()->latest()->first();
                @endphp
                @if($latestMessage)
                    <a href="{{ route('chat.admin.messages', $conversation->id) }}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> {{ $conversation->phone }}
                        <span class="badge badge-danger">{{ $conversation->unread_count > 0 ? $conversation->unread_count : '' }}</span>
                        <p class="text-sm text-muted">
                            {{ \Illuminate\Support\Str::limit($latestMessage->message, 40) }}
                        </p>
                        <span class="float-right text-muted text-sm">
                            {{ $latestMessage->created_at->diffForHumans() }}
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                @endif
            @endforeach
        @else
            <a href="#" class="dropdown-item">Không có tin nhắn mới</a>
        @endif

        <a href="{{ route('chat.admin') }}" class="dropdown-item dropdown-footer">Xem tất cả</a>
    </div>
</li>











        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

     
    </ul>
  


</nav>


