# 📝 Changelog

Tất cả các thay đổi quan trọng của dự án **Mobifone** sẽ được ghi chú trong file này.

Format dựa trên [Keep a Changelog](https://keepachangelog.com/vi-BR/),
và dự án tuân theo [Semantic Versioning](https://semver.org/lang/vi/).

## [Unreleased]

### Added
- CI/CD pipeline với GitHub Actions
- Automated testing với PHPUnit
- Code quality checks với Laravel Pint
- Code coverage reporting với Codecov

### Changed
- Redesign README.md với phong cách professional
- Toàn bộ nội dung README bằng tiếng Việt
- Thêm thông tin Trường Đại học An Giang (AGU)

### Fixed
- Cập nhật deployment instructions cho Render và Aiven

---

## [1.0.0] - 2024-XX-XX

### Added
- Hệ thống quản lý gói cước di động (Voice/SMS)
- Hệ thống quản lý gói DATA 4G/5G
- Quản lý kho SIM số (VIP/Regular)
- Hệ thống đăng ký hòa mạng
- Chuyển mạng giữ số (MNP)
- Dịch vụ quốc tế (roaming, VoIP)
- Quản lý cửa hàng với bản đồ
- Tin tức & khuyến mãi
- Tuyển dụng & quản lý CV
- Chat hỗ trợ real-time
- Xác thực OTP qua SMS
- Admin Panel với RBAC (Spatie Permission)
- Import/Export Excel (Maatwebsite)
- DataTables cho admin CRUD
- QR Code generation
- Pusher Channels integration

### Technical
- Laravel 11 framework
- PHP 8.2+
- MySQL 8.0 / MariaDB
- Tailwind CSS 3 + DaisyUI
- Alpine.js
- Vite 6
- Redis (predis)
- GuzzleHTTP client

### Documentation
- README.md đầy đủ tiếng Việt
- Hướng dẫn cài đặt chi tiết
- Deployment guide cho Render
- API documentation

---

## Cấu trúc Version

- **MAJOR** - Thay đổi lớn, breaking changes
- **MINOR** - Thêm tính năng mới, backward compatible
- **PATCH** - Sửa lỗi, backward compatible

## Loại thay đổi

- `Added` - Tính năng mới
- `Changed` - Thay đổi tính năng đã có
- `Deprecated` - Tính năng sẽ bị xóa
- `Removed` - Tính năng đã bị xóa
- `Fixed` - Sửa lỗi
- `Security` - Bảo mật

[Unreleased]: https://github.com/AbdolHamidDev/Mobifone/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/AbdolHamidDev/Mobifone/releases/tag/v1.0.0