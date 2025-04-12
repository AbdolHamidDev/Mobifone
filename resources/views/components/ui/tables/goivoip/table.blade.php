 <!-- Header with Add Button -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold text-primary mb-0">
        <i class="fas fa-phone-alt me-2"></i>Quản lý gói cước VoIP
    </h2>

    <div class="d-flex gap-2">

        <button class="btn btn-primary rounded-pill px-4" id="btn-add">
            <i class="fas fa-plus-circle me-2"></i>Thêm Mới
        </button>
    </div>
</div>

<div class="card shadow-sm border-0 table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0" id="cuocPhiTable">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Quốc gia</th>
                    <th>Nhóm cước</th>
                    <th>Mã vùng</th>
                    <th class="text-right">Block 6s đầu</th>
                    <th class="text-right">Giá mỗi giây</th>
                    <th class="text-right">Giá 1 phút đầu</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded via AJAX -->
            </tbody>
        </table>
    </div>
</div>