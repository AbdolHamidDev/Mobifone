@extends('layouts.admin')
@section('content')
    <div class="container mx-auto">
        <x-layout.content-header title="thêm bài viết" />

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tiêu Đề</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Danh Mục</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="tin-khuyen-mai">Tin Khuyến Mãi</option>
                    <option value="tin-tuc-su-kien">Tin Tức Sự Kiện</option>
                    <option value="thong-cao-bao-chi">Thông Cáo Báo Chí</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Nội Dung</label>
                <textarea name="content" id="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Hình Ảnh</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content'))
            .then(editor => {
                window.editor = editor;

                // Đồng bộ nội dung với <textarea> trước khi submit
                document.querySelector('form').addEventListener('submit', function() {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });

        document.querySelector('form').addEventListener('submit', function(e) {
            // Lấy nội dung từ CKEditor
            const content = window.editor.getData();

            if (!content.trim()) {
                e.preventDefault(); // Ngăn gửi form
                alert('Nội dung không được để trống!');
            } else {
                // Đồng bộ nội dung với <textarea> trước khi submit
                document.querySelector('#content').value = content;
            }
        });
    </script>
@endsection
