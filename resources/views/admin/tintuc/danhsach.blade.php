@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Tin tức khuyến mãi" />
    <div class="container mx-auto">
        <a href="{{ route('news.create') }}" class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium px-6 py-2 rounded-full shadow-md transition-all duration-300 hover:from-blue-600 hover:to-blue-700 hover:shadow-lg mb-4">
            + Thêm mới
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Tiêu Đề</th>
                    <th class="border border-gray-300 px-4 py-2">Danh Mục</th>
                    <th class="border border-gray-300 px-4 py-2">Hình Ảnh</th>
                    <th class="border border-gray-300 px-4 py-2">Nội Dung</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Xuất Bản</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Trạng Thái Kiểm Duyệt</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Trạng Thái Hiển Thị</th>
                    <th class="border border-gray-300 px-4 py-2">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $value)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->category }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($value->image)
                                <img src="{{ asset('storage/' . $value->image) }}" alt="Ảnh" class="w-20 h-20 object-cover">
                            @else
                                <span class="text-gray-500 italic">Không có ảnh</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ \Illuminate\Support\Str::limit($value->content, 50, '...') }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->published_at }}</td>

                        <td class="text-center" title="Trạng thái kiểm duyệt">
                            <a href="{{ route('news.kiemduyet', ['id' => $value->id]) }}">
                                @if ($value->kiemduyet == 1)
                                    <i class="fas fa-circle-check text-success"></i>
                                @else
                                    <i class="fas fa-circle-xmark text-danger"></i>
                                @endif
                            </a>
                        </td>
                        
                        <td class="text-center" title="Trạng thái hiển thị">
                            <a href="{{ route('news.kichhoat', ['id' => $value->id]) }}">
                                @if ($value->kichhoat == 1)
                                    <i class="fas fa-eye text-success"></i>
                                @else
                                    <i class="fas fa-eye-slash text-danger"></i>
                                @endif
                            </a>
                        </td>
                        

                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('news.edit', $value->id) }}" class="fas fa-edit"></a> |
                            <form action="{{ route('news.destroy', $value->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-trash-alt text-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
@endsection
