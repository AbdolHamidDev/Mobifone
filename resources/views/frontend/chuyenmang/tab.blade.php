<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Chuyển mạng giữ số</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
}

.section-container {
  text-align: center;
  margin: 20px;
}

/* Cơ bản */
.tabs {
  display: flex;
  justify-content: center;
  gap: 30px; /* Khoảng cách giữa các tab */
  margin-bottom: 30px;
}

.tab {
  padding: 12px 30px; /* Tăng padding để tab rộng hơn */
  font-size: 16px;
  background-color: #007bff;
  color: #fff;
  border-radius: 25px; /* Tạo góc bo tròn cho tab */
  cursor: pointer;
  display: flex;
  align-items: center; /* Canh chỉnh icon và chữ theo chiều dọc */
  transition: background-color 0.3s, transform 0.3s;
}

.tab:hover {
  background-color: #0056b3;
  transform: translateY(-3px); /* Hiệu ứng di chuyển nhẹ khi hover */
}

.tab i {
  margin-right: 10px; /* Khoảng cách giữa icon và chữ */
  font-size: 20px; /* Kích thước icon */
  transition: color 0.3s;
}

.tab:hover i {
  color: #ffcc00; /* Màu sắc của icon khi hover */
}

.tab.active {
  background-color: #0056b3; /* Màu sắc tab khi được chọn */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ cho tab active */
}


.content {
  display: none;
  padding: 40px; /* Tăng padding để nội dung có không gian rộng hơn */
  background-color: #fff;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Tăng độ bóng cho ô */
  border-radius: 5px;
  margin: 30px auto; /* Thêm margin để các ô không bị dính sát nhau */
  max-width: 1200px; /* Tăng max-width để các ô rộng hơn */
}

.content.active {
  display: block;
}

img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
}

h2 i {
  margin-right: 10px; /* Thêm khoảng cách giữa icon và tiêu đề */
  font-size: 24px; /* Tăng kích thước của icon */
  color: #007bff; /* Màu sắc của icon */
}

.tab.active {
  background-color: #0056b3; /* Màu sắc tab khi được chọn */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ cho tab active */
}

  </style>
</head>
<body>

<section class="section-container">
    <div class="tabs">
        <div class="tab" data-target="gioi-thieu">
          <i class="fas fa-info-circle"></i> Giới thiệu
        </div>
        <div class="tab" data-target="thu-tuc">
          <i class="fas fa-cogs"></i> Thủ tục
        </div>
        <div class="tab" data-target="luu-y">
          <i class="fas fa-exclamation-circle"></i> Lưu ý
        </div>
        <div class="tab" data-target="uu-dai">
          <i class="fas fa-gift"></i> Ưu đãi
        </div>
      </div>
      

  <div id="gioi-thieu" class="content">
    <h2><i class="fas fa-info-circle"></i> Giới thiệu</h2>
    <p>Chuyển mạng viễn thông di động giữ nguyên số (MNP) là thủ tục cho phép các thuê bao di động có thể chuyển từ một nhà mạng di động này đến một nhà mạng di động khác mà giữ nguyên số. Với dịch vụ chuyển mạng giữ số của MobiFone, người sử dụng số di động được giữ nguyên số thuê bao của mình và sử dụng dịch vụ của MobiFone.</p>
    <p>MobiFone cam kết hỗ trợ khách hàng thực hiện chuyển mạng giữ số nhanh nhất, thuận tiện nhất.</p>
  </div>
  
  <div id="thu-tuc" class="content">
    <h2><i class="fas fa-cogs"></i> Thủ tục</h2>
    <p><strong>Kênh online</strong></p>
    <ul>
      <li>Bước 1: Khách hàng truy cập website: chuyenmang.mobifone.vn và đăng ký theo biểu mẫu đăng ký.</li>
      <li>Bước 2: Thực hiện giao dịch chuyển mạng theo hướng dẫn trên trang web hoặc liên hệ với nhân viên hỗ trợ.</li>
    </ul>
    <p><strong>Kênh tổng đài</strong></p>
    <ul>
      <li>Bước 1: Khách hàng gọi đến tổng đài MobiFone (1800 1090).</li>
      <li>Bước 2: Thực hiện giao dịch chuyển mạng theo hướng dẫn từ nhân viên tổng đài.</li>
    </ul>
  </div>
  
  <div id="luu-y" class="content">
    <h2><i class="fas fa-exclamation-circle"></i> Lưu ý</h2>
    <p>- Tổng thời gian chuyển mạng kéo dài khoảng 01-05 ngày.</p>
    <p>- Cước phí chuyển mạng: 50.000 VNĐ cho thuê bao trả trước, 60.000 VNĐ cho thuê bao trả sau.</p>
    <p>- Khách hàng sẽ bị hủy các dịch vụ đang sử dụng tại nhà mạng cũ khi chuyển mạng thành công.</p>
  </div>
  
  <div id="uu-dai" class="content">
    <h2><i class="fas fa-gift"></i> Ưu đãi</h2>
    <img src="chuyenmang/images/uudai.jpg" alt="Ưu đãi">
  </div>
  
</section>


<script>
    // Lấy tất cả các tab và nội dung của các tab
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.content');
  
    // Lắng nghe sự kiện click trên mỗi tab
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const target = tab.getAttribute('data-target');
  
        // Ẩn tất cả các nội dung
        contents.forEach(content => {
          content.classList.remove('active');
        });
  
        // Hiển thị nội dung của tab đang chọn
        document.getElementById(target).classList.add('active');
  
        // Xóa lớp 'active' khỏi tất cả các tab và thêm vào tab đang được chọn
        tabs.forEach(tab => {
          tab.classList.remove('active');
        });
        tab.classList.add('active');
      });
    });
  
    // Mở phần "Giới thiệu" mặc định khi tải trang
    document.addEventListener('DOMContentLoaded', () => {
      const defaultTab = document.querySelector('.tab[data-target="gioi-thieu"]');
      defaultTab.click(); // Tự động click vào tab "Giới thiệu"
    });
  </script>
  
</body>
</html>
