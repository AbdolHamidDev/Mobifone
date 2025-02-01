    <!-- feature section -->
    <!-- Bootstrap CSS -->


    <section class="feature_section ">
        <div class="carousel_btn-box">
            <a class="slider_btn_prev" href="" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="slider_btn_next" href="" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid service_container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="box">
                        <div class="number_box">
                            <h5>
                                01
                            </h5>
                        </div>
                        <h4>
                            Nhập yêu cầu chuyển mạng
                        </h4>
                        <!-- Thêm nút đăng ký -->
                        <a href="#" class="btn_register" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Đăng ký</a>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="box">
                        <div class="number_box">
                            <h5>
                                02
                            </h5>
                        </div>
                        <h4>
                            MobiFone liên lạc để xác minh nhu cầu của khách hàng
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="box">
                        <div class="number_box">
                            <h5>
                                03
                            </h5>
                        </div>
                        <h4>
                            MobiFone liên lạc và gặp trực tiếp khách hàng, và hỗ trợ khách hàng làm các thủ tục hồ sơ
                            chuyển mạng.
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="box">
                        <div class="number_box">
                            <h5>
                                04
                            </h5>
                        </div>
                        <h4>
                            Khách hàng nhận được thông báo kết quả chuyển mạng và sử dụng dịch vụ của MobiFone
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Thêm lớp modal-lg để làm modal to hơn -->
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="registerModalLabel">Đăng ký chuyển đổi mạng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form đăng ký -->
                    <form action="{{ route('dang-ky-chuyen-doi-mang.store') }}" method="POST">
                        @csrf
                        <div class="row g-4"> <!-- Giảm khoảng cách giữa các trường -->
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ho_ten" class="form-label">Họ Tên</label>
                                    <input type="text"
                                        class="form-control shadow-sm border rounded"
                                        id="ho_ten" name="ho_ten" placeholder="Nhập họ tên của bạn" required>
                                </div>
                                <div class="mb-3">
                                    <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                                    <input type="text"
                                        class="form-control shadow-sm border rounded"
                                        id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                        class="form-control shadow-sm border rounded"
                                        id="email" name="email" placeholder="Nhập email của bạn">
                                </div>
                                <div class="mb-3">
                                    <label for="dia_chi_lien_he" class="form-label">Địa Chỉ Liên Hệ</label>
                                    <input type="text"
                                        class="form-control shadow-sm border rounded"
                                        id="dia_chi_lien_he" name="dia_chi_lien_he" placeholder="Nhập địa chỉ liên hệ" required>
                                </div>
                            </div>
                            

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="hinh_thuc_xu_ly" class="form-label">Hình Thức Xử Lý</label>
                                    <select class="form-select"
                                        id="hinh_thuc_xu_ly" name="hinh_thuc_xu_ly" required>
                                        <option value="tai_dia_chi_dang ky">Tại địa chỉ đăng ký</option>
                                        <option value="den_cua_hang">Đến cửa hàng</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Địa bàn tiếp nhận: Tỉnh/Thành phố, Quận/Huyện, Xã/Phường - nhóm thành hàng ngang -->
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="tinh_thanh_pho" class="form-label">Tỉnh/Thành Phố</label>
                                    <select class="form-select" id="tinh_thanh_pho" name="tinh_thanh_pho" required>
                                        <option value="">Chọn Tỉnh/Thành Phố</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="quan_huyen" class="form-label">Quận/Huyện</label>
                                    <select class="form-select" id="quan_huyen" name="quan_huyen" required>
                                        <option value="">Chọn Quận/Huyện</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="xa_phuong" class="form-label">Xã/Phường</label>
                                    <select class="form-select" id="xa_phuong" name="xa_phuong" required>
                                        <option value="">Chọn Xã/Phường</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                       <!-- Người giới thiệu -->
                       <div class="mb-4">
                        <label for="nguoi_gioi_thieu" class="form-label">Người Giới Thiệu:</label>
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNguoiGioiThieu" aria-expanded="false" aria-controls="collapseNguoiGioiThieu">
                            Mở rộng/Thu gọn thông tin người giới thiệu
                        </button>
                    </div>
                    
                    <div class="collapse" id="collapseNguoiGioiThieu">
                        <!-- Họ tên người giới thiệu -->
                        <div class="mb-4">
                            <label for="nguoi_gioi_thieu_ho_ten" class="form-label">Họ tên người giới thiệu</label>
                            <input type="text" class="form-control" id="nguoi_gioi_thieu_ho_ten" name="nguoi_gioi_thieu_ho_ten" placeholder="Nhập họ tên người giới thiệu">
                        </div>
                    
                        <!-- Số điện thoại người giới thiệu -->
                        <div class="mb-4">
                            <label for="nguoi_gioi_thieu_so_dien_thoai" class="form-label">Số điện thoại người giới thiệu</label>
                            <input type="text" class="form-control" id="nguoi_gioi_thieu_so_dien_thoai" name="nguoi_gioi_thieu_so_dien_thoai" placeholder="Nhập số điện thoại người giới thiệu">
                        </div>
                    
                        <!-- Email người giới thiệu -->
                        <div class="mb-4">
                            <label for="nguoi_gioi_thieu_email" class="form-label">Email người giới thiệu</label>
                            <input type="email" class="form-control" id="nguoi_gioi_thieu_email" name="nguoi_gioi_thieu_email" placeholder="Nhập email người giới thiệu">
                        </div>
                    
                      <!-- Đơn vị người giới thiệu -->
<div class="mb-4">
    <label for="nguoi_gioi_thieu_don_vi" class="form-label">Đơn vị người giới thiệu</label>
    <select class="form-select" id="nguoi_gioi_thieu_don_vi" name="nguoi_gioi_thieu_don_vi">
        <option value="-1">--Đơn vị giới thiệu--</option>
        <option value="1">Cơ quan TCT</option>
        <option value="2">Ban QLHT 1</option>
        <option value="3">Ban QLHT 2</option>
        <option value="4">Ban QLHT 3</option>
        <option value="5">Ban QLDAKT 1</option>
        <option value="6">Ban QLDAKT 2</option>
        <option value="7">CTKV 1</option>
        <option value="8">CTKV 2</option>
        <option value="9">CTKV 3</option>
        <option value="10">CTKV 4</option>
        <option value="11">CTKV 5</option>
        <option value="12">CTKV 6</option>
        <option value="13">CTKV 7</option>
        <option value="14">CTKV 8</option>
        <option value="15">CTKV 9</option>
        <option value="16">Trung tâm VTQT</option>
        <option value="17">Trung tâm MVAS</option>
        <option value="18">Trung tâm CNTT</option>
        <option value="19">Trung tâm NOC</option>
        <option value="20">Trung tâm MLMB</option>
        <option value="21">Trung tâm MLMT</option>
        <option value="22">Trung tâm MLMN</option>
        <option value="23">Trung tâm DK&amp;SC TBVT</option>
        <option value="24">Trung tâm TC&amp;TK</option>
        <option value="25">Trung tâm R&amp;D</option>
        <option value="26">Trung tâm TVTK</option>
        <option value="27">Công ty MobiFone Global</option>
        <option value="28">Công ty MobiFone Plus</option>
        <option value="29">Công ty MobiFone Service</option>
    </select>
</div>

                    
                       <!-- Đơn vị cấp phòng người giới thiệu -->
<div class="mb-4">
    <label for="nguoi_gioi_thieu_don_vi_cap_phong" class="form-label">Đơn vị cấp phòng người giới thiệu</label>
    <select class="form-select" id="nguoi_gioi_thieu_don_vi_cap_phong" name="nguoi_gioi_thieu_don_vi_cap_phong">
        <option value="-1">--Đơn vị cấp phòng--</option>
        <option value="1">Khu vực 1 - Hà Nội</option>
        <option value="2">Khu vực 2 - TP. Hồ Chí Minh</option>
        <option value="3">Khu vực 3 - Đà Nẵng</option>
        <option value="4">Khu vực 4 - Phú Thọ</option>
        <option value="5">Khu vực 5 - Hải Phòng</option>
        <option value="6">Khu vực 6 - Nghệ An</option>
        <option value="7">Khu vực 7 - Đắk Lắk</option>
        <option value="8">Khu vực 8 - Đồng Nai</option>
        <option value="9">Khu vực 9 - TP. Cần Thơ</option>
        <option value="10">Khu vực 10 - An Giang</option>
    </select>
</div>

</div>               


                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill">Đăng Ký</button>
                        <!-- Thêm padding cho nút và bo tròn -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Lấy danh sách tỉnh
        fetch('https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1')
            .then(response => response.json())
            .then(data => {
                if (data && data.data && Array.isArray(data.data.data)) {
                    const provinces = data.data.data;
                    const provincesSelect = document.getElementById('tinh_thanh_pho');
                    provinces.forEach(value => {
                        provincesSelect.innerHTML += `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                    });
                } else {
                    console.error('Dữ liệu tỉnh thành không hợp lệ.');
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API:', error);
            });
    
        // Lấy danh sách quận/huyện theo tỉnh
        function fetchDistricts(provincesID) {
            fetch(`https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${provincesID}&limit=-1`)
                .then(response => response.json())
                .then(data => {
                    const districtsSelect = document.getElementById('quan_huyen');
                    if (data && data.data && Array.isArray(data.data.data)) {
                        let districts = data.data.data;
                        districtsSelect.innerHTML = `<option value=''>Chọn Quận/Huyện</option>`;
                        districts.forEach(value => {
                            districtsSelect.innerHTML += `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                        });
                    } else {
                        console.error('Dữ liệu quận huyện không hợp lệ.');
                        districtsSelect.innerHTML = `<option value=''>Không có quận huyện</option>`;
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi gọi API:', error);
                });
        }
    
        // Lấy danh sách xã/phường theo quận huyện
        function fetchWards(districtsID) {
            fetch(`https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${districtsID}&limit=-1`)
                .then(response => response.json())
                .then(data => {
                    const wardsSelect = document.getElementById('xa_phuong');
                    if (data && data.data && Array.isArray(data.data.data)) {
                        let wards = data.data.data;
                        wardsSelect.innerHTML = `<option value=''>Chọn Xã/Phường</option>`;
                        wards.forEach(value => {
                            wardsSelect.innerHTML += `<option value='${value.code}' data-name='${value.name}'>${value.name}</option>`;
                        });
                    } else {
                        console.error('Dữ liệu xã phường không hợp lệ.');
                        wardsSelect.innerHTML = `<option value=''>Không có xã phường</option>`;
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi gọi API:', error);
                });
        }
    
        // Xử lý sự kiện chọn tỉnh
        function getProvinces(event) {
            fetchDistricts(event.target.value);
            document.getElementById('xa_phuong').innerHTML = `<option value=''>Chọn Xã/Phường</option>`;
        }
    
        // Xử lý sự kiện chọn quận huyện
        function getDistricts(event) {
            fetchWards(event.target.value);
        }
    
        // Gán sự kiện cho tỉnh, quận
        document.getElementById('tinh_thanh_pho').addEventListener('change', function (event) {
            getProvinces(event);
            const selectedOption = event.target.options[event.target.selectedIndex];
            console.log('Tên Tỉnh/Thành phố:', selectedOption.getAttribute('data-name'));
        });
    
        document.getElementById('quan_huyen').addEventListener('change', function (event) {
            getDistricts(event);
            const selectedOption = event.target.options[event.target.selectedIndex];
            console.log('Tên Quận/Huyện:', selectedOption.getAttribute('data-name'));
        });
    
        document.getElementById('xa_phuong').addEventListener('change', function (event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            console.log('Tên Xã/Phường:', selectedOption.getAttribute('data-name'));
        });
    </script>

    <style>
        /* Định dạng cho nút đăng ký */
        .btn_register {
            display: inline-block;
            padding: 10px 20px;
            background-color: #c82333;
            /* Màu đỏ đậm */
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            /* Viền nút tròn */
            text-decoration: none;
            margin-top: 20px;
            border: 2px solid #c82333;
            /* Viền có màu sắc tương tự nền */
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            /* Bóng đổ nhẹ */
        }

        /* Hiệu ứng hover cho nút */
        .btn_register:hover {
            background-color: white;
            /* Nền trắng khi hover */
            color: #c82333;
            /* Chữ đỏ khi hover */
            border-color: #c82333;
            /* Viền đỏ khi hover */
            transform: translateY(-5px);
            /* Nút nổi lên khi hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Bóng đổ mạnh khi hover */
        }

        /* Hiệu ứng focus cho nút */
        .btn_register:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(200, 35, 51, 0.5);
            /* Viền sáng khi nút được focus */
        }

        /* Hiệu ứng active cho nút khi bấm */
        .btn_register:active {
            transform: translateY(2px);
            /* Nút hạ xuống khi bấm */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Giảm bóng khi bấm */
        }

        /* Hiệu ứng chuyển màu nền khi hover */
        .btn_register:hover {
            background-color: #f8f9fa;
            /* Nền sáng hơn khi hover */
        }
    </style>
