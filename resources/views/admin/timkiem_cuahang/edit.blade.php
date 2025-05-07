@extends('layouts.admin')

@section('content')
<x-layout.content-header title="sửa cửa hàng" />

<div class="container mx-auto mt-8 max-w-lg">

    <form action="{{ route('store.update', $store) }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Chỉnh Sửa Cửa Hàng</h2>

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên Cửa Hàng</label>
            <input type="text" name="name" id="name" class="w-full py-3 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $store->name }}" required>
        </div>

        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700">Địa Chỉ</label>
            <input type="text" name="address" id="address" class="w-full py-3 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $store->address }}" required>
        </div>

        <div class="mb-6">
            <label for="latitude" class="block text-sm font-medium text-gray-700">Vĩ độ (Latitude)</label>
            <input type="text" name="latitude" id="latitude" class="w-full py-3 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $store->latitude }}" required>
        </div>

        <div class="mb-6">
            <label for="longitude" class="block text-sm font-medium text-gray-700">Kinh độ (Longitude)</label>
            <input type="text" name="longitude" id="longitude" class="w-full py-3 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ $store->longitude }}" required>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                Cập Nhật
            </button>
        </div>
    </form>
</div>

@endsection
