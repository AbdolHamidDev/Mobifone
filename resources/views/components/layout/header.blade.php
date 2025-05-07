<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
        </a>
    </li>

    @if(auth()->user() && auth()->user()->hasRole('admin'))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/home" class="nav-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
    @endif
</ul>


    <!-- Logo ở giữa -->
    <div class="navbar-brand mx-auto">
        <a href="/admin/home">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mobifone Logo" class="brand-image" style="height: 30px; max-width: 150px;">
        </a>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>