@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('admins/goivoip/style.css') }}">
@endpush
@section('content')
    <x-layout.content-header name="Danh sách" key="Gói Voip" />

    <!-- Khu vực Dasbroad và bảng -->
    <div class="container-fluid py-4">

        <div class="dashboard-container">
            <header class="dashboard-header">
                <h1><i class="fas fa-phone-alt"></i> Bảng điều khiển phân tích</h1>
                <div class="header-actions">
                    <button class="btn btn-refresh"><i class="fas fa-sync-alt"></i> Làm mới</button>
                </div>
            </header>

            <div class="dashboard-content">
                <x-ui.cards.goivoip.tongquan />

                <x-ui.cards.goivoip.price />

                <x-ui.charts.goivoip.4chart />

                <x-ui.tables.goivoip.table />
            </div>
        </div>
    </div>

    <x-modal.modal-goivoip :quocGias="$quocGias" />




    <!-- Loading Overlay -->
    <div class="loading-overlay" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @push('scripts')
        <script type="module" src="{{ asset('admins/goivoip/main.js') }}"></script>
        <script>
            var urlDashboard = "{{ route('goivoip.dashboard') }}";
        </script>
        <script>
            var urlDashboard1 = "{{ route('goivoip.dashboard1') }}";
        </script>
    @endpush
@endsection
