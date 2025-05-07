<p align="center">
    <img src="https://github.com/HamidAbdol89/Mobifone/blob/master/public/assets/images/logo.png?raw=true" width="400" alt="Logo Mobifone">
</p>

<p align="center">
    <a href="https://github.com/HamidAbdol89/Mobifone"><img src="https://img.shields.io/badge/Status-Active-green" alt="Trạng thái dự án"></a>
    <a href="https://github.com/HamidAbdol89/Mobifone/releases"><img src="https://img.shields.io/github/release/HamidAbdol89/Mobifone" alt="Phiên bản mới nhất"></a>
</p>

## Giới thiệu về dự án Mobifone

Dự án này là một ứng dụng web được phát triển sử dụng Laravel, thiết kế để quản lý các **gói cước Mobifone**, **mua SIM số**, và các dịch vụ di động khác cho người dùng. Mục tiêu của dự án là cung cấp một nền tảng dễ sử dụng để quản lý các dịch vụ viễn thông với sự tập trung vào quản lý dữ liệu, tính dễ sử dụng và khả năng mở rộng.

Các tính năng chính bao gồm:
- **Quản lý gói cước Mobifone**: Hiển thị và lọc các gói cước Mobifone hiện có.
- **Mua SIM số**: Tích hợp hệ thống cho phép người dùng mua SIM số trực tiếp từ nền tảng.
- **Tích hợp API**: Dự án được xây dựng trên nền tảng **Laravel** và cung cấp API RESTful để dễ dàng tích hợp với các dịch vụ bên ngoài.
- **Giao diện người dùng**: Giao diện người dùng hiện đại, sử dụng **AJAX** và **JavaScript** để tải và hiển thị dữ liệu động.
## 🎬 Demo chức năng chính

<table>
  <tr>
    <td align="center">
      <strong>📱 Giao diện lọc gói cước</strong><br><br>
      <img src="https://github.com/HamidAbdol89/Mobifone/blob/master/public/assets/screenshots/demoGoicuoc.gif?raw=true" width="500" alt="Demo Gói Cước">
    </td>
    <td align="center">
      <strong>📞 Mua SIM số trực tiếp</strong><br><br>
      <img src="https://github.com/HamidAbdol89/Mobifone/blob/master/public/assets/screenshots/demoSim.gif?raw=true" width="500" alt="Demo Mua SIM">
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <br>
      <strong>🔍 Kiểm tra đơn hàng bằng mã giữ số</strong><br><br>
      <img src="https://github.com/HamidAbdol89/Mobifone/blob/master/public/assets/screenshots/democheck.gif?raw=true" width="600" alt="Demo Check đơn hàng">
    </td>
  </tr>
</table>

## Tính năng

- **Quản lý gói cước Mobifone**: Người dùng có thể xem và lọc các gói cước của Mobifone.
- **Mua SIM số**: Cho phép người dùng mua SIM và đăng ký dịch vụ trực tiếp trên nền tảng.
- **Hiển thị dữ liệu động**: Sử dụng Ajax/JS để tải nội dung động dựa trên hành động của người dùng.
- **Hoàn toàn tương thích với di động**: Dự án được thiết kế để hoạt động mượt mà trên mọi thiết bị.

## Hướng dẫn cài đặt

Thực hiện các bước sau để cài đặt và chạy dự án trên máy tính của bạn.

### Yêu cầu

- PHP 7.4 trở lên
- Composer
- Laravel 8.x
- MySQL hoặc MariaDB
- Node.js (dành cho frontend)

### Cài đặt

1. Clone repository:
    ```bash
    git clone https://github.com/HamidAbdol89/Mobifone.git
    ```
2. Di chuyển vào thư mục dự án:
    ```bash
    cd Mobifone
    ```
3. Cài đặt các phụ thuộc PHP sử dụng Composer:
    ```bash
    composer install
    ```
4. Sao chép tệp cấu hình môi trường:
    ```bash
    cp .env.example .env
    ```
5. Cấu hình tệp **.env** với thông tin cơ sở dữ liệu và các cấu hình khác.
6. Tạo khóa ứng dụng:
    ```bash
    php artisan key:generate
    ```
7. Chạy migration để tạo cơ sở dữ liệu:
    ```bash
    php artisan migrate
    ```
8. Cài đặt các phụ thuộc frontend:
    ```bash
    npm install
    ```
9. Chạy ứng dụng:
    ```bash
    php artisan serve
    ```
### ⚠️ Quan trọng: Import dữ liệu mẫu để tránh lỗi

**❗ Nếu không import cơ sở dữ liệu mẫu, khi chạy `php artisan serve` sẽ bị lỗi do các bảng ràng buộc bắt buộc không tồn tại.**

Đã cung cấp sẵn file SQL để mày chỉ cần import vào là chạy được ngay.

📂 **Đường dẫn:** `database/sample/mobifone.sql`  
📥 **Tải nhanh trên GitHub:**  
👉 [mobifone.sql](https://github.com/HamidAbdol89/Mobifone/blob/master/database/sample/mobifone.sql)

### Cách import vào PHPMyAdmin:

1. Mở `phpMyAdmin` từ `localhost/phpmyadmin`
2. Tạo cơ sở dữ liệu mới, ví dụ: `mobifone`
3. Chọn database đó → nhấn tab **Import**
4. Chọn file `mobifone.sql` và nhấn **Go**
## Tìm hiểu thêm

Để tìm hiểu thêm, bạn có thể tham khảo [tài liệu Laravel chính thức](https://laravel.com/docs).

Nếu bạn muốn cải tiến hoặc tích hợp frontend sử dụng JavaScript hoặc Vue.js, vui lòng tham khảo tài liệu của **frontend**.

## Đóng góp

Chúng tôi hoan nghênh mọi đóng góp từ cộng đồng! Nếu bạn muốn đóng góp cho dự án, hãy làm theo hướng dẫn trong [tài liệu đóng góp](https://github.com/HamidAbdol89/Mobifone/CONTRIBUTING.md).

## Giấy phép

Dự án này được cấp phép theo giấy phép MIT - xem chi tiết trong tệp [LICENSE](https://opensource.org/licenses/MIT).

## Lời cảm ơn

- Cảm ơn Mobifone đã cung cấp các API và dịch vụ hỗ trợ cho dự án này.
- Đặc biệt cảm ơn đến **Laravel** vì đã cung cấp một framework mạnh mẽ để phát triển dự án này.

