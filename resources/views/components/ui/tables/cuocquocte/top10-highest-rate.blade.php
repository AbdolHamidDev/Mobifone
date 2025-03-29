<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold mb-0">
            <i class="fas fa-trophy me-2 text-warning"></i>Top 10 quốc gia có cước cao nhất
        </h5>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="topRateFilter"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter me-1"></i> Loại cước
            </button>
            <ul class="dropdown-menu" aria-labelledby="topRateFilter">
                <li><a class="dropdown-item active" href="#" data-type="all">Tất cả</a></li>
                <li><a class="dropdown-item" href="#" data-type="call">Gọi về VN</a></li>
                <li><a class="dropdown-item" href="#" data-type="data">Data</a></li>
                <li><a class="dropdown-item" href="#" data-type="sms">SMS</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body">

        <table class="table table-hover" id="topCountriesTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Quốc gia</th>
                    <th>Gọi về VN</th>
                    <th>Data</th>
                    <th>SMS</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu sẽ được load bằng JS -->
            </tbody>
        </table>

    </div>

</div>
