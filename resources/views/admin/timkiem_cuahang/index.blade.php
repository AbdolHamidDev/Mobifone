@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Danh sách" key="Cửa hàng" />

<div class="container mx-auto mt-5">

    <a href="{{ route('store.create') }}" class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium px-6 py-2 rounded-full shadow-md transition-all duration-300 hover:from-blue-600 hover:to-blue-700 hover:shadow-lg mb-4">
        + Thêm mới
    </a>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-6">
        <table class="table-auto w-full border-collapse text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Tên Cửa Hàng</th>
                    <th class="border px-6 py-4 text-left">Địa Chỉ</th>
                    <th class="border px-6 py-4 text-left">Vị Trí</th>
                    <th class="border px-6 py-4 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                <tr class="hover:bg-gray-50">
                    <td class="border px-6 py-4">{{ $store->name }}</td>
                    <td class="border px-6 py-4">{{ $store->address }}</td>
                    <td class="border px-6 py-4">Lat: {{ $store->latitude }}, Lng: {{ $store->longitude }}</td>
                    <td class="border px-6 py-4 text-center">
                        <a href="{{ route('store.edit', $store) }}" class="text-blue-500 hover:text-blue-700 transition-all duration-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('store.destroy', $store) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-4 hover:text-red-700 transition-all duration-200">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
