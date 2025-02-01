@extends('layouts.admin')
@section('content')
    <div class="container mx-auto">
        @include('partials.content-header', ['name' => 'Sửa', 'key' => 'bài viết'])

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tiêu Đề</label>
                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Danh Mục</label>
                <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="tin-khuyen-mai" {{ $news->category == 'tin-khuyen-mai' ? 'selected' : '' }}>Tin Khuyến Mãi</option>
                    <option value="tin-tuc-su-kien" {{ $news->category == 'tin-tuc-su-kien' ? 'selected' : '' }}>Tin Tức Sự Kiện</option>
                    <option value="thong-cao-bao-chi" {{ $news->category == 'thong-cao-bao-chi' ? 'selected' : '' }}>Thông Cáo Báo Chí</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Nội Dung</label>
                <textarea name="content" id="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $news->content) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Hình Ảnh</label>
                @if ($news->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="Ảnh" class="w-20 h-20 object-cover">
                    </div>
                @endif
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
