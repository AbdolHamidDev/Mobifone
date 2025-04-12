@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Tạo công việc" key="Tuyển dụng mới" />

<div class="container mx-auto p-4">
    <form action="{{ route('tuyendung.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
        @csrf

        <!-- Vị trí công việc -->
        <div class="form-group">
            <label for="vi_tri" class="text-gray-700 text-sm font-medium">Vị trí công việc</label>
            <select class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="vi_tri" id="vi_tri" required>
                <option>Bán hàng, Marketing</option>
                <option>Công nghệ thông tin</option>
                <option>Hành chính, văn phòng</option>
                <option>IT phần mềm</option>
                <option>Kinh tế</option>
                <option>Kế hoạch, chiến lược</option>
                <option>Kế toán</option>
                <option>Lập trình</option>
                <option>Nhân sự, tổ chức</option>
                <option>Thiết kế, Kiến trúc, xây dựng</option>
                <option>Toán</option>
                <option>Truyền thông</option>
                <option>Tài chính</option>
                <option>Viễn thông</option>
                <option>Digital Marketing</option>
                <option>Điện tử viễn thông</option>
                <option>Điện, điện tử</option>
            </select>
        </div>

        <!-- Mô tả công việc -->
        <div class="form-group">
            <label for="mo_ta" class="text-gray-700 text-sm font-medium">Mô tả công việc</label>
            <textarea class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="mo_ta" id="mo_ta" rows="4" required></textarea>
        </div>

        <!-- Yêu cầu công việc -->
        <div class="form-group">
            <label for="yeu_cau" class="text-gray-700 text-sm font-medium">Yêu cầu công việc</label>
            <textarea class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="yeu_cau" id="yeu_cau" rows="4" required></textarea>
        </div>

        <!-- Mức lương -->
        <div class="form-group">
            <label for="luong" class="text-gray-700 text-sm font-medium">Mức lương</label>
            <input type="text" class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="luong" id="luong">
        </div>

        <!-- Thời gian ứng tuyển -->
        <div class="form-group">
            <label for="thoi_gian_ung_tuyen" class="text-gray-700 text-sm font-medium">Thời gian ứng tuyển</label>
            <input type="date" class="form-control mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="thoi_gian_ung_tuyen" id="thoi_gian_ung_tuyen" required>
        </div>

        <!-- Checkbox Tuyển gấp -->
        <div class="form-group flex items-center space-x-2">
            <input type="checkbox" name="tuyen_gap" id="tuyen_gap" class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
            <label for="tuyen_gap" class="text-gray-700 text-sm font-medium">Tuyển gấp</label>
        </div>

        <!-- Nút lưu -->
        <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Lưu vào csdl</button>
    </form>
</div>

@endsection
