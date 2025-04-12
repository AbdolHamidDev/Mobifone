@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Cập nhật" key="Thông tin" />

<div class="container mx-auto p-4">
    <form action="{{ route('tuyendung.update', $tuyendung->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
        @csrf
        @method('PUT')

        <!-- Vị trí công việc -->
        <div class="form-group">
            <label for="vi_tri" class="text-gray-700 text-sm font-medium">Vị trí công việc</label>
            <select class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="vi_tri" id="vi_tri" required>
                <option value="Bán hàng, Marketing" {{ $tuyendung->vi_tri == 'Bán hàng, Marketing' ? 'selected' : '' }}>Bán hàng, Marketing</option>
                <option value="Công nghệ thông tin" {{ $tuyendung->vi_tri == 'Công nghệ thông tin' ? 'selected' : '' }}>Công nghệ thông tin</option>
                <option value="Hành chính, văn phòng" {{ $tuyendung->vi_tri == 'Hành chính, văn phòng' ? 'selected' : '' }}>Hành chính, văn phòng</option>
                <option value="IT phần mềm" {{ $tuyendung->vi_tri == 'IT phần mềm' ? 'selected' : '' }}>IT phần mềm</option>
                <option value="Kinh tế" {{ $tuyendung->vi_tri == 'Kinh tế' ? 'selected' : '' }}>Kinh tế</option>
                <option value="Kế hoạch, chiến lược" {{ $tuyendung->vi_tri == 'Kế hoạch, chiến lược' ? 'selected' : '' }}>Kế hoạch, chiến lược</option>
                <option value="Kế toán" {{ $tuyendung->vi_tri == 'Kế toán' ? 'selected' : '' }}>Kế toán</option>
                <option value="Lập trình" {{ $tuyendung->vi_tri == 'Lập trình' ? 'selected' : '' }}>Lập trình</option>
                <option value="Nhân sự, tổ chức" {{ $tuyendung->vi_tri == 'Nhân sự, tổ chức' ? 'selected' : '' }}>Nhân sự, tổ chức</option>
                <option value="Thiết kế, Kiến trúc, xây dựng" {{ $tuyendung->vi_tri == 'Thiết kế, Kiến trúc, xây dựng' ? 'selected' : '' }}>Thiết kế, Kiến trúc, xây dựng</option>
                <option value="Toán" {{ $tuyendung->vi_tri == 'Toán' ? 'selected' : '' }}>Toán</option>
                <option value="Truyền thông" {{ $tuyendung->vi_tri == 'Truyền thông' ? 'selected' : '' }}>Truyền thông</option>
                <option value="Tài chính" {{ $tuyendung->vi_tri == 'Tài chính' ? 'selected' : '' }}>Tài chính</option>
                <option value="Viễn thông" {{ $tuyendung->vi_tri == 'Viễn thông' ? 'selected' : '' }}>Viễn thông</option>
                <option value="Digital Marketing" {{ $tuyendung->vi_tri == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                <option value="Điện tử viễn thông" {{ $tuyendung->vi_tri == 'Điện tử viễn thông' ? 'selected' : '' }}>Điện tử viễn thông</option>
                <option value="Điện, điện tử" {{ $tuyendung->vi_tri == 'Điện, điện tử' ? 'selected' : '' }}>Điện, điện tử</option>
            </select>
        </div>

        <!-- Mô tả công việc -->
        <div class="form-group">
            <label for="mo_ta" class="text-gray-700 text-sm font-medium">Mô tả công việc</label>
            <textarea class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="mo_ta" id="mo_ta" rows="4" required>{{ old('mo_ta', $tuyendung->mo_ta) }}</textarea>
        </div>

        <!-- Yêu cầu công việc -->
        <div class="form-group">
            <label for="yeu_cau" class="text-gray-700 text-sm font-medium">Yêu cầu công việc</label>
            <textarea class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="yeu_cau" id="yeu_cau" rows="4" required>{{ old('yeu_cau', $tuyendung->yeu_cau) }}</textarea>
        </div>

        <!-- Mức lương -->
        <div class="form-group">
            <label for="luong" class="text-gray-700 text-sm font-medium">Mức lương</label>
            <input type="text" class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="luong" id="luong" value="{{ old('luong', $tuyendung->luong) }}">
        </div>

        <!-- Thời gian ứng tuyển -->
        <div class="form-group">
            <label for="thoi_gian_ung_tuyen" class="text-gray-700 text-sm font-medium">Thời gian ứng tuyển</label>
            <input type="date" class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="thoi_gian_ung_tuyen" id="thoi_gian_ung_tuyen" value="{{ old('thoi_gian_ung_tuyen', $tuyendung->thoi_gian_ung_tuyen) }}" required>
        </div>
<!-- Checkbox Tuyển gấp -->
<div class="form-group flex items-center space-x-2">
    <input 
        type="checkbox" 
        name="tuyen_gap" 
        id="tuyen_gap" 
        class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
        {{ old('tuyen_gap', $tuyendung->thoi_gian_ung_tuyen == '9999-12-31' ? 'checked' : '') }}>
    <label for="tuyen_gap" class="text-gray-700 text-sm font-medium">Tuyển gấp</label>
</div>

        <!-- Nút lưu -->
        <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Cập nhật thông tin</button>
    </form>
</div>

@endsection
