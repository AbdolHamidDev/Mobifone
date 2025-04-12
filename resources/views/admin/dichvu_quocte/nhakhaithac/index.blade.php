@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('admins/nhakhaithac/style.css') }}">
@endpush

@section('content')
<x-layout.content-header name="Danh sách" key="Nhà khai thác" />

<x-table.nhakhaithac.table />

<x-modal.nhakhaithac.modal-nhakhaithac />



@push('scripts')
<script>
    var nhaKhaiThacUrl = "{{ route('nha-khai-thac.index') }}";
</script>

<script src="{{ asset('admins/nhakhaithac/action.js') }}"></script>
@endpush


@endsection
