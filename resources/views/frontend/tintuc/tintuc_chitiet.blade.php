@extends('layouts.frontend')

@section('title', $news->title)

@section('content')

<!-- Import Fancybox CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.31/fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.31/fancybox.umd.min.js"></script>

<div class="container" style="padding-top: 15vh;">

        <!-- Tiêu đề tin tức -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $news->title }}</h1>

        <!-- Thông tin xuất bản -->
        <div class="flex items-center text-gray-500 text-sm mb-4">
            <span class="mr-4">🗂️ {{ ucfirst($news->category) }}</span>
            <span>📅 {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d/m/Y H:i') : 'Chưa cập nhật' }}</span>
        </div>


        

        <!-- Nội dung chi tiết -->
        <div class="prose max-w-none leading-relaxed text-gray-700 text-lg">
            {!! $news->content !!}
        </div>
        
        <!-- Nút quay lại -->
        <div class="mt-6 text-center">
            <a href="javascript:history.back()" class="text-blue-600 hover:underline font-semibold text-lg">← Quay lại</a>
        </div>
 
</div>

<!-- Fancybox JS -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Fancybox.bind("[data-fancybox]", {
            Thumbs: {
                autoStart: true,
            },
            Toolbar: {
                display: ["zoom", "fullscreen", "close"],
            },
        });
    });
</script>

@endsection
