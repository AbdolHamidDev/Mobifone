@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Chi tiết', 'key' => 'Thêm mới'])

<div class="container mx-auto mt-4">
    <form action="{{ route('goicuocs_detail.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="goicuoc_id" class="block text-sm font-medium">ID Gói Cước</label>
            <select name="goicuoc_id" id="goicuoc_id" class="border rounded w-full">
                @foreach ($goicuocs as $goicuoc)
                    <option value="{{ $goicuoc->id }}">{{ $goicuoc->ten_goicuoc }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="details" class="block text-sm font-medium">Thông tin chi tiết</label>
            <textarea name="details" id="details" class="border rounded w-full" rows="6" placeholder="Nhập thông tin chi tiết (ví dụ: Giá, Dung lượng, Phương thức đăng ký...)"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Lưu
        </button>
    </form>
</div>
@endsection
