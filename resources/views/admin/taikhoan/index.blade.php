@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Danh sách" key="Cửa hàng" />
    <link rel="stylesheet" href="">

<body>
    <div class="registration-form">
        <h2>Đăng ký tài khoản nhân viên</h2>
        <form action="/register" method="POST">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Phân quyền:</label>
            <select id="role" name="role">
                <option value="employee">Nhân viên</option>
                <option value="manager">Quản lý</option>
            </select>

            <button type="submit">Đăng ký</button>
        </form>
    </div>
</body>
