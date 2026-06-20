# 🤝 Hướng dẫn đóng góp

Cảm ơn bạn đã quan tâm đến việc đóng góp cho dự án **Mobifone**! Đây là dự án mã nguồn mở, và mọi đóng góp từ cộng đồng đều được hoan nghênh.

## Quy tắc ứng xử

Dự án này tuân thủ [Quy tắc ứng xử](CODE_OF_CONDUCT.md) của chúng tôi. Khi tham gia, bạn cần tuân thủ các quy tắc này.

## Quy trình đóng góp

### 1. Báo cáo lỗi

Nếu bạn tìm thấy lỗi, vui lòng tạo một **Issue** trên GitHub với:
- Tiêu đề rõ ràng, mô tả chi tiết
- Các bước để tái hiện lỗi
- Ảnh chụp màn hình (nếu có)
- Thông tin môi trường (PHP, Laravel, Database, Browser)

### 2. Đề xuất tính năng

Nếu bạn có ý tưởng cải tiến, hãy tạo một **Issue** với label `enhancement`:
- Mô tả vấn đề bạn muốn giải quyết
- Đề xuất giải pháp cụ thể
- Các phương án thay thế (nếu có)

### 3. Gửi Pull Request

#### Bước 1: Fork & Clone

```bash
# Fork dự án trên GitHub, sau đó clone
git clone https://github.com/[your-username]/Mobifone.git
cd Mobifone

# Thêm upstream repository
git remote add upstream https://github.com/AbdolHamidDev/Mobifone.git
```

#### Bước 2: Tạo branch

```bash
# Luôn tạo branch mới từ nhánh main
git checkout main
git pull upstream main
git checkout -b feature/ten-tinh-nang
```

#### Bước 3: Coding Standards

- Tuân thủ **PSR-12** coding standards
- Sử dụng tiếng Việt có dấu cho UI/UX
- Sử dụng tiếng Anh cho code, comments, commit messages
- Chạy các test trước khi commit

```bash
# Kiểm tra coding style
./vendor/bin/phpcbf --standard=PSR12 app/

# Chạy test
php artisan test
```

#### Bước 4: Commit

```bash
git add .
git commit -m "feat: Thêm tính năng XYZ"
```

**Quy ước commit message:**
- `feat:` — Tính năng mới
- `fix:` — Sửa lỗi
- `docs:` — Cập nhật tài liệu
- `style:` — Format code, CSS
- `refactor:` — Tái cấu trúc
- `perf:` — Cải thiện hiệu năng
- `test:` — Thêm test
- `chore:` — Công việc bảo trì

#### Bước 5: Push & Tạo Pull Request

```bash
git push origin feature/ten-tinh-nang
```

Sau đó tạo Pull Request trên GitHub với template đã cung cấp.

## Cấu trúc code

```
app/
├── Console/        # Artisan commands
├── Events/         # Laravel Events
├── Exports/        # Excel exports
├── Helpers/        # Helper functions
├── Http/
│   ├── Controllers/# Controllers
│   └── Requests/   # Form requests
├── Imports/        # Excel imports
├── Mail/           # Mailables
├── Models/         # Eloquent Models
├── Notifications/  # Notifications
├── Observers/      # Model Observers
├── Providers/      # Service Providers
└── View/           # View Composers
```

## Biên dịch Frontend

```bash
# Development
npm run dev

# Production
npm run build
```

## Test

```bash
# Chạy tất cả test
php artisan test

# Chạy specific test
php artisan test --filter=TenTest
```

## Câu hỏi?

Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại:
- Tạo Issue trên GitHub
- Liên hệ qua email: abdolhamid.dev@gmail.com
- Xem thêm tại: https://hamid.id.vn

---

<p align="center">
  <strong>Cảm ơn bạn đã đóng góp! ❤️</strong>
</p>