
<section id="calculator" class="calculator">

  <div class="container">
      <div class="row">
          <div class="col-lg-7">
              <div class="left-image">
                  <img src="assets/images/calculator-image.png" alt="Hình minh họa">
              </div>
          </div>
          <div class="col-lg-5">
              <div class="section-heading">
                  <h6>Liên Hệ Với Chúng Tôi</h6>
                  <h4>Nhận Thông Tin Hỗ Trợ</h4>
              </div>
              <form id="calculate" action="{{ route('contact.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <fieldset>
                            <label for="name">Họ và Tên</label>
                            <input type="text" name="name" id="name" placeholder="Nhập họ và tên" autocomplete="on" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Nhập email của bạn" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <label for="phone">Số Điện Thoại</label>
                            <input type="tel" name="phone" id="phone" placeholder="Nhập số điện thoại của bạn" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <label for="chooseOption" class="form-label">Lý Do Liên Hệ</label>
                            <select name="reason" class="form-select" aria-label="Default select example" id="chooseOption">
                                <option selected>Chọn lý do</option>
                                <option value="Dịch vụ trực tuyến">Dịch vụ trực tuyến</option>
                                <option value="Hỗ trợ tài chính">Hỗ trợ tài chính</option>
                                <option value="Lợi nhuận hàng năm">Lợi nhuận hàng năm</option>
                                <option value="Đầu tư tiền mã hóa">Đầu tư tiền mã hóa</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <label for="message">Nội Dung Liên Hệ</label>
                            <textarea name="message" id="message" rows="5" placeholder="Nhập nội dung liên hệ của bạn" required></textarea>
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <button type="submit" id="form-submit" class="orange-button">Gửi Liên Hệ</button>
                        </fieldset>
                    </div>
                </div>
            </form>
            
          </div>
      </div>
  </div>
</section>
