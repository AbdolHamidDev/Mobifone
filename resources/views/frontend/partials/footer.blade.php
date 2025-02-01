

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 footer-section">
                <div class="footer-logo"> MobiFone</div>
               

                <h5> Tải ứng dụng My MobiFone</h5>
            <div class="app-icons">
                <a href="https://apps.apple.com/vn/app/my-mobifone/id719320091" target="_blank" class="app-icon apple">
                    <i class="fab fa-apple"></i>
                </a>
                <a href="https://play.google.com/store/apps/details?id=vms.com.vn.mymobifone" target="_blank" class="app-icon android">
                    <i class="fab fa-android"></i>
                </a>
                <a href="https://appgallery.cloud.huawei.com/ag/n/app/C102512327?channelId=web&amp;detailType=0" target="_blank" class="app-icon huawei">
                    <i class="fab fa-huawei"></i>
                </a>
            </div>
            <h5> Kết nối với MobiFone</h5>
                <div class="social-links">
                    <a href="https://www.facebook.com/mobifone" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/@mobifone.official" class="social-icon"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@mobifone.official" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    <a href="https://zalo.me/4055244641440308778" class="social-icon">
                      <img src="{{ asset('assets/images/zalo.png') }}" alt="Zalo" class="zalo-icon">
                  </a>
                </div>
                <h5>Điểm Giao Dịch TP Long Xuyên (An Giang)</h5>
                <p class="footer-about">
                  106 Trần Hưng Đạo, P.Mỹ Bình, TP.Long Xuyên, An Giang<br>
                  Số điện thoại: 02963727696<br>
                  Giờ làm việc: T2 - T7: Sáng 7h30-11h, Chiều 13h-17h; CN: nghỉ; Lễ/Tết: 8h30-11h30
              </p>
            </div>

            <div class="col-lg-2 col-md-6 footer-section">
                <h5>GIỚI THIỆU</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu MobiFone</a></li>
                    <li><a href="{{ url('/hop-tac') }}">Hợp tác MobiFone</a></li>
                    <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                    <li><a href="https://www.mobifone.vn/assets/source/file/logofontchuMobiFone.rar">Tải Logo</a></li>
             
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-section">
                <h5>HỖ TRỢ</h5>
                <ul class="footer-links">
                    <li><a href="#calculator">Gửi phản ánh</a></li>
                    <li><a href="{{ url('/cauhoi-thuonggap') }}">Câu hỏi thường gặp</a></li>
                    <li><a href="{{ url('/store-search') }}">Tìm kiếm cửa hàng</a></li>
                    <li><a href="{{ url('/chuyendoi-mang') }}">Chuyển mạng giữ số</a></li>
                    <li><a href="">Sitmap</a></li>
                    <li><a href=" https://tttb.mobifone.vn">Đăng ký thông tin</a></li>

                </ul>
            </div>

            <div class="col-lg-4 footer-section">
                <h5>Bản tin</h5>
                <p class="footer-about">
                    Đăng ký nhận bản tin của chúng tôi để nhận thông tin cập nhật, tin tức và ưu đãi đặc biệt.
                </p>
                <div class="footer-newsletter">
                    <input type="email" id="newsletter-email" placeholder="Nhập email của bạn" required>
                    <button class="newsletter-btn" id="newsletter-submit">
                        <i class="fas fa-paper-plane"></i> 
                    </button>
                    <p id="newsletter-message" style="display: none;"></p>
                </div>
                
              <div class="footer-content">
                <p class="footer-about">
                  Giấy chứng nhận đăng ký doanh nghiệp: Mã số doanh nghiệp: 0100686209, Đăng ký thay đổi lần thứ 10 ngày 10/03/2021, cấp bởi sở KHĐT Thành phố Hà Nội.
              </p>
                <a href="http://online.gov.vn/Home/WebDetails/113413" target="_blank">
                    <img class="kiem-dinh" alt="Logo kiểm định" title="Logo kiểm định" src="https://www.mobifone.vn/images/common/logoCCDV.png">
                </a>
               
            </div>
            
          </div>
          
         
          
          <div class="footer-bottom">
              <ul class="footer-bottom-links">
                <a href="{{ route('frontend.terms') }}">Điều khoản sử dụng</a>
                <a href="{{ route('frontend.privacy.policy') }}">Bảo mật thông tin</a>

              </ul>
              <p class="footer-about">© Copyright 2025 - MobiFone.</p>
          </div>
          
    </div>
</footer>
<script>
document.querySelector('a[href="#calculator"]').addEventListener('click', function (event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>
    const targetSection = document.querySelector('#calculator'); // Lấy phần tử section bằng id
    if (targetSection) {
        targetSection.scrollIntoView({
            behavior: 'smooth', // Cuộn mượt mà
            block: 'start',     // Cuộn đến đầu phần tử
        });
    }
});
document.getElementById('newsletter-submit').addEventListener('click', function () {
    const emailInput = document.getElementById('newsletter-email');
    const message = document.getElementById('newsletter-message');

    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {
        // Lưu email vào LocalStorage
        let emailList = JSON.parse(localStorage.getItem('newsletterEmails')) || [];
        if (!emailList.includes(email)) {
            emailList.push(email);
            localStorage.setItem('newsletterEmails', JSON.stringify(emailList));

            // Hiển thị thông báo thành công
            message.style.display = 'block';
            message.style.color = 'green';
            message.textContent = 'Cảm ơn bạn! Bạn đã đăng ký nhận bản tin thành công.';
        } else {
            // Email đã tồn tại
            message.style.display = 'block';
            message.style.color = 'yellow';
            message.textContent = 'Bạn đã đăng ký trước đó rồi!';
        }

        emailInput.value = '';
    } else {
        // Hiển thị thông báo lỗi
        message.style.display = 'block';
        message.style.color = 'red';
        message.textContent = 'Vui lòng nhập email hợp lệ!';
    }
});
// Đảm bảo nút và icon không bị thay đổi kích thước
document.getElementById('newsletter-email').addEventListener('focus', function () {
    const button = document.getElementById('newsletter-submit');
    button.style.width = button.offsetWidth + 'px'; // Cố định chiều rộng nút
    button.style.height = button.offsetHeight + 'px'; // Cố định chiều cao nút
});

</script>
<style>
    html {
    scroll-behavior: smooth;
}


</style>