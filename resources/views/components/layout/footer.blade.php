<div class="admin-footer" style="background: linear-gradient(180deg, #1c1c28, #2e2e44); box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);">
    <div class="footer-container">
        <div class="footer-brand">
            <svg class="footer-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4L4 8V16L12 20L20 16V8L12 4Z" stroke="#6C5CE7" stroke-width="2"/>
                <path d="M12 12L4 8M12 12L20 8M12 12V20" stroke="#6C5CE7" stroke-width="2"/>
            </svg>
            <span class="brand-name">HAMID<span>ADMIN</span></span>
        </div>
        
        <div class="footer-main">
            <div class="footer-section">
                <h4>Liên kết nhanh</h4>
                <ul>
                    <li><a href="#">Bảng điều khiển</a></li>
                    <li><a href="#">Thống kê</a></li>
                    <li><a href="#">Cài đặt</a></li>
                    <li><a href="#">Người dùng</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Hỗ trợ</h4>
                <ul>
                    <li><a href="#">Tài liệu</a></li>
                    <li><a href="#">API</a></li>
                    <li><a href="#">Cộng đồng</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Pháp lý</h4>
                <ul>
                    <li><a href="#">Chính sách riêng tư</a></li>
                    <li><a href="#">Điều khoản dịch vụ</a></li>
                    <li><a href="#">Cookie</a></li>
                    <li><a href="#">Bảo mật</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                &copy; 2024 <strong>HamID</strong>. Bảo lưu mọi quyền.
            </div>
            <div class="footer-social">
                <a href="#" class="social-icon" title="Facebook">
                    <svg viewBox="0 0 24 24" fill="#A6B0CF"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/></svg>
                </a>
                <a href="#" class="social-icon" title="Github">
                    <svg viewBox="0 0 24 24" fill="#A6B0CF"><path d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"/></svg>
                </a>
                <a href="#" class="social-icon" title="Email">
                    <svg viewBox="0 0 24 24" fill="#A6B0CF"><path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.admin-footer {
    color: #A6B0CF;
    padding: 40px 0 20px;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    position: relative;
    z-index: 10;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-brand {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.footer-logo {
    width: 32px;
    height: 32px;
    margin-right: 12px;
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #E2E8FF;
    letter-spacing: 0.5px;
}

.brand-name span {
    color: #6C5CE7;
    font-weight: 800;
}

.footer-main {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-section h4 {
    color: #E2E8FF;
    margin-bottom: 16px;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section li {
    margin-bottom: 12px;
}

.footer-section a {
    color: #A6B0CF;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    display: inline-block;
    position: relative;
}

.footer-section a:hover {
    color: #6C5CE7;
    transform: translateX(5px);
}

.footer-section a:after {
    content: '';
    position: absolute;
    width: 0;
    height: 1px;
    bottom: -2px;
    left: 0;
    background-color: #6C5CE7;
    transition: width 0.3s ease;
}

.footer-section a:hover:after {
    width: 100%;
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid rgba(166, 176, 207, 0.1);
    font-size: 0.85rem;
}

.footer-bottom .copyright strong {
    color: #E2E8FF;
    font-weight: 600;
}

.footer-social {
    display: flex;
    gap: 16px;
}

.social-icon {
    color: #A6B0CF;
    width: 24px;
    height: 24px;
    transition: all 0.3s ease;
    opacity: 0.8;
}

.social-icon:hover {
    color: #6C5CE7;
    opacity: 1;
    transform: translateY(-3px);
}

@media (max-width: 768px) {
    .footer-main {
        grid-template-columns: 1fr 1fr;
    }
    
    .footer-bottom {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer-main {
        grid-template-columns: 1fr;
    }
    
    .footer-brand {
        justify-content: center;
    }
}
</style>