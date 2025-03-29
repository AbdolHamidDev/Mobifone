 <!-- Card 1: Tổng số quốc gia - Phiên bản nâng cao -->
 <div class="col-md-3">
    <div class="card border-0 shadow-sm h-100 hover-effect">
        <div class="card-body position-relative">
            <!-- Hiệu ứng gradient background -->
            <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10" 
                 style="background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); border-radius: inherit;"></div>
            
            <div class="d-flex justify-content-between align-items-center position-relative">
                <div>
                    <h6 class="text-muted mb-2 fw-normal text-uppercase small">Quốc gia</h6>
                    <h2 class="mb-0 fw-bold" id="total-countries">0</h2>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-globe-americas text-primary fs-3"></i>
                </div>
            </div>
            <div class="mt-3 position-relative">
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-2" id="country-change">
                        <i class="fas fa-caret-up me-1"></i> 0%
                    </span>
                    <span class="text-muted small">So với tháng trước</span>
                </div>
                <div class="mt-1 small text-muted">Cập nhật: <span class="text-dark">Hôm nay</span></div>
            </div>
        </div>
    </div>
</div>