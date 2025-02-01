@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Chi tiết', 'key' => 'Chỉnh sửa'])

<div class="container mx-auto mt-4">
    <form action="{{ route('goicuocs_detail.update', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="goicuoc_id" class="block text-sm font-medium">ID Gói Cước</label>
            <input type="text" id="goicuoc_id" name="goicuoc_id" value="{{ old('goicuoc_id', $detail->goicuoc_id) }}" class="border rounded w-full" required>
            @error('goicuoc_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="key" class="block text-sm font-medium">Key</label>
            <input type="text" id="key" name="key" value="{{ old('key', $detail->key) }}" class="border rounded w-full" required>
            @error('key')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="value" class="block text-sm font-medium">Value</label>
            <input type="text" id="value" name="value" value="{{ old('value', $detail->value) }}" class="border rounded w-full" >
          
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cập nhật
        </button>
    </form>
</div>
@endsection
