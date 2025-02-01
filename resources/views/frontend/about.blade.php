<section class="about-us" id="about">
  <div class="container">
      <div class="row">
          <div class="col-lg-8 offset-lg-2">
              <div class="section-heading">
                  <h6>Tra cứu thông tin</h6>
                  <h4>Tin tức và khuyến mãi</h4>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="naccs">
                  <div class="tabs">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="menu">
                                  <!-- Tab mặc định "Tin khuyến mãi" được chọn ngay từ đầu -->
                                  <div class="active gradient-border" id="tin-khuyen-mai-tab"><span>Tin khuyến mãi</span></div>
                                  <div class="gradient-border" id="tin-tuc-su-kien-tab"><span>Tin tức sự kiện</span></div>
                                  <div class="gradient-border" id="thong-cao-bao-chi-tab"><span>Thông cáo báo chí</span></div>
                              </div>
                          </div>
                          <div class="col-lg-12">
                            <ul class="nacc">
                              <!-- Tab Tin khuyến mãi -->
                              <li class="tab-content" id="tin-khuyen-mai-content" style="display: block;">
                                  @foreach ($newsPromotion as $item)
                                      @if ($item->kiemduyet && $item->kichhoat)  <!-- Điều kiện kiểm duyệt và kích hoạt -->
                                          <div class="news-item">
                                              <div class="news-image">
                                                  <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                              </div>
                                              <div class="news-info">
                                                  <span class="title">{{ $item->title }}</span>
                                                  <p>{{ $item->description }}</p>
                                              </div>
                                          </div>
                                      @endif
                                  @endforeach
                              </li>
                          
                              <!-- Tab Tin tức sự kiện -->
                              <li class="tab-content" id="tin-tuc-su-kien-content" style="display: none;">
                                  @foreach ($newsEvent as $item)
                                      @if ($item->kiemduyet && $item->kichhoat)
                                          <div class="news-item">
                                              <div class="news-image">
                                                  <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                              </div>
                                              <div class="news-info">
                                                  <span class="title">{{ $item->title }}</span>
                                                  <p>{{ $item->description }}</p>
                                              </div>
                                          </div>
                                      @endif
                                  @endforeach
                              </li>
                          
                              <!-- Tab Thông cáo báo chí -->
                              <li class="tab-content" id="thong-cao-bao-chi-content" style="display: none;">
                                  @foreach ($newsPress as $item)
                                      @if ($item->kiemduyet && $item->kichhoat)
                                          <div class="news-item">
                                              <div class="news-image">
                                                  <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                              </div>
                                              <div class="news-info">
                                                  <span class="title">{{ $item->title }}</span>
                                                  <p>{{ $item->description }}</p>
                                              </div>
                                          </div>
                                      @endif
                                  @endforeach
                              </li>
                          </ul>
                          
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>



<script>
  document.addEventListener("DOMContentLoaded", function() {
      const tabs = document.querySelectorAll('.menu .gradient-border');
      const tabContents = document.querySelectorAll('.tab-content');

      tabs.forEach(tab => {
          tab.addEventListener('click', function() {
              const tabId = this.id.replace('-tab', '');  // Lấy ID tab

              // Tắt tất cả các tab và nội dung
              tabs.forEach(item => item.classList.remove('active'));
              tabContents.forEach(content => content.style.display = 'none');

              // Kích hoạt tab hiện tại và hiển thị nội dung của nó
              this.classList.add('active');
              document.getElementById(tabId + '-content').style.display = 'block';
          });
      });
  });
</script>









<style>
.news-item {
    display: flex; /* Sử dụng flexbox để xếp ảnh và nội dung cùng hàng */
    align-items: center; /* Canh giữa theo chiều dọc */
    margin-bottom: 20px; /* Khoảng cách giữa các phần tử */
}

.news-image {
    flex: 0 0 auto; /* Không thay đổi kích thước ảnh */
    margin-right: 20px; /* Khoảng cách giữa ảnh và nội dung */
}

.news-image img {
    width: 100%; /* Đặt ảnh chiếm toàn bộ chiều rộng của phần tử chứa */
    max-width: 200px; /* Giới hạn chiều rộng tối đa của ảnh */
    height: auto; /* Giữ tỷ lệ cho ảnh */
    object-fit: cover; /* Cắt ảnh sao cho vừa với khung mà không bị biến dạng */
}

.news-info {
    flex: 1; /* Nội dung chiếm phần còn lại */
}

.news-info .title {
    font-size: 24px; /* Cỡ chữ tiêu đề */
    font-weight: bold;
}

.news-info p {
    font-size: 16px; /* Cỡ chữ mô tả */
    margin-top: 10px; /* Khoảng cách từ tiêu đề đến mô tả */
}


/* Ẩn tất cả các nội dung tab */
.tab-content {
    display: none;
}

/* Hiển thị nội dung của tab được chọn */
#tin-khuyen-mai-content {
    display: block;
}

.menu .active {
    font-weight: bold;
    color: #00c3ff;  /* Màu cho tab được chọn */
}

/* Các hiệu ứng hover, active cho các tab */
.menu .gradient-border {
    padding: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.menu .gradient-border:hover {
    background-color: #2e2e44;
}

</style>