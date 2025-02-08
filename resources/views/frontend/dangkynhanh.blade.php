

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('frontends/dangkynhanh/dangkynhanh.css') }}">

    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-8" id="dichvudidong">
        <h2 class="text-center text-3xl font-bold mb-6 text-gray-800">📱 Dịch Vụ Di Động</h2>
        
            <!-- Tabs -->
            <div class="flex justify-center space-x-8 border-b pb-3">
                <button onclick="switchTab(event, 'tab-goi-data', '/api/goidata', 'goi-data-list')" 
                        class="tab-button" 
                        data-default-tab
                        data-api="/api/goidata"
                        data-container="goi-data-list">
                    📶 GÓI DATA
                </button>
                <button onclick="switchTab(event, 'tab-goi-cuoc', '/api/goicuoc', 'goi-cuoc-list')" 
                        class="tab-button" 
                        data-api="/api/goicuoc"
                        data-container="goi-cuoc-list">
                    💰 GÓI CƯỚC
                </button>             
            </div>
        
            <!-- Nội dung từng Tab -->
            <div id="tab-goi-data" class="tab-section" data-default-section>
                <h3 class="text-xl font-semibold mb-4 text-gray-800">🚀 Danh sách gói data</h3>
                <div class="carousel flex overflow-x-auto space-x-4 p-2" id="goi-data-list"></div>
            </div>
        
            <div id="tab-goi-cuoc" class="tab-section">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">💰 Danh sách gói cước</h3>
                <div class="carousel flex overflow-x-auto space-x-4 p-2" id="goi-cuoc-list"></div>
            </div>
        </div>

    <!-- Modal Đăng Ký -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Đăng ký gói cước</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerForm">
                <div class="modal-body">
                    <p id="selectedPackage" class="fw-bold"></p>
                    <input type="hidden" id="packageId" name="package_id">
                    <input type="hidden" id="packageType" name="type"> <!-- Chuyển vào form -->
            
                    <div class="form-group mb-3">
                        <label for="phoneNumber">Nhập số điện thoại</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="submitRegisterForm">Xác nhận</button>
                </div>
            </form>
            
        </div>
    </div>
</div>


        
    <script src="{{ asset('frontends/dangkynhanh/dangkynhanh.js') }}"></script>

