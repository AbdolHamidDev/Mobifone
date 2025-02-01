@extends('layouts.frontend')


<link rel="stylesheet" href="{{ asset('frontends/sothuebao/sothuebao.css') }}">
@section('content')
<div class="container" style="padding-top: 15vh;">
          <!-- Tiêu đề và link -->
  <div class="search-header">
    <span>SIM thường</span>
    <a href="#"><i class="fas fa-search"></i> Tra cứu giữ số</a>
</div>

<div class="search-container" style="background: url('{{ asset('assets/images/background_timkiem.jpg') }}') no-repeat center center; background-size: cover; margin-bottom: 40px;">
    <form id="searchForm" class="search-box">
        @csrf <!-- Thêm CSRF token để bảo mật -->
        <input type="text" id="search-input" name="searchTerm" placeholder="Nhập số cần tìm">

        <!-- Tooltip -->
        <div class="tooltip">
            <h4>Hướng dẫn tìm kiếm:</h4>
            <ul>
                <li>Tìm sim có số 6868 bạn hãy gõ 6868</li>
                <li>Tìm sim có đầu 098 đuôi 6868 hãy gõ 098*6868</li>
                <li>Tìm sim bắt đầu bằng 0912 đuôi bất kỳ, hãy gõ: 0912*</li>
            </ul>
        </div>

        <button type="submit">Tìm kiếm</button>
    </form>
</div>
<!-- Tiêu đề -->
<h2 class="mb-4 text-center text-dark fw-bold">Danh sách số thuê bao</h2>




    <div class="row">
        <!-- Cột Lọc -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Tiêu đề -->
                    <h5 class="card-title text-dark d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-filter"></i> Bộ lọc</span>
                        <span class="badge bg-dark rounded-pill">
                            {{ collect(request()->only(['dau_so', 'loai_thue_bao']))->filter()->count() }}
                        </span>
                    </h5>
    
                    <!-- Các bộ lọc được áp dụng -->
                    <div class="mb-4">
                        <label class="form-label">Áp dụng</label>
                        <div class="d-flex flex-wrap gap-2">
                            @if(request('dau_so'))
                                <span class="badge bg-light text-dark border border-dark">
                                    {{ request('dau_so') }}
                                    <a href="{{ route('frontend.dichvudidong.sothuebao', array_merge(request()->except('dau_so'))) }}" class="text-danger ms-1">×</a>
                                </span>
                            @endif
                            @if(request('loai_thue_bao'))
                                <span class="badge bg-light text-dark border border-dark">
                                    {{ request('loai_thue_bao') == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}
                                    <a href="{{ route('frontend.dichvudidong.sothuebao', array_merge(request()->except('loai_thue_bao'))) }}" class="text-danger ms-1">×</a>
                                </span>
                            @endif
                            @if(request('dau_so') || request('loai_thue_bao'))
                                <a href="{{ route('frontend.dichvudidong.sothuebao') }}" class="text-danger ms-3">Xóa tất cả ×</a>
                            @endif
                        </div>
                    </div>
    
                    <!-- Lọc Đầu số -->
                    <div class="mb-4">
                        <label class="form-label">Đầu số</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['093', '090', '076', '078'] as $dau_so)
                                <a href="{{ route('frontend.dichvudidong.sothuebao', array_merge(request()->except('dau_so'), ['dau_so' => $dau_so])) }}"
                                   class="btn btn-sm {{ request('dau_so') == $dau_so ? 'btn-dark active' : 'btn-outline-dark' }}">
                                    <i class="fas fa-phone"></i> {{ $dau_so }}
                                </a>
                            @endforeach
                        </div>
                    </div>
    
                    <!-- Lọc Loại thuê bao -->
                    <div class="mb-4">
                        <label class="form-label">Loại thuê bao</label>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('frontend.dichvudidong.sothuebao', array_merge(request()->except('loai_thue_bao'), ['loai_thue_bao' => 'tra_truoc'])) }}"
                               class="btn btn-sm {{ request('loai_thue_bao') == 'tra_truoc' ? 'btn-dark active' : 'btn-outline-dark' }}">
                                <i class="fas fa-wallet"></i> Trả trước
                            </a>
                            <a href="{{ route('frontend.dichvudidong.sothuebao', array_merge(request()->except('loai_thue_bao'), ['loai_thue_bao' => 'tra_sau'])) }}"
                               class="btn btn-sm {{ request('loai_thue_bao') == 'tra_sau' ? 'btn-dark active' : 'btn-outline-dark' }}">
                                <i class="fas fa-credit-card"></i> Trả sau
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    

        <!-- Cột Bảng -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="d-flex justify-content-end mt-2">
                    {{ $soThueBao->links() }}
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                   

                        <div id="searchResults">
                            @include('frontend.dichvudidong.table_sothuebao', ['soThueBao' => $soThueBao])
                        </div>
                        
                    
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const tooltip = document.getElementById('tooltip');

    searchInput.addEventListener('mouseenter', function () {
        // Lấy vị trí của ô tìm kiếm
        const inputRect = searchInput.getBoundingClientRect();
        const scrollY = window.scrollY || document.documentElement.scrollTop;

        // Cập nhật vị trí tooltip ngay dưới ô tìm kiếm
        tooltip.style.left = `${inputRect.left}px`;
        tooltip.style.top = `${inputRect.bottom + scrollY + 10}px`; // 10px khoảng cách dưới input
        tooltip.style.opacity = '1';
        tooltip.style.visibility = 'visible';
    });

    searchInput.addEventListener('mouseleave', function () {
        tooltip.style.opacity = '0';
        tooltip.style.visibility = 'hidden';
    });
});

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('table-container');

    function fetchTable(url, params = {}) {
        // Lưu vị trí cuộn trước khi tải
        const currentScrollPosition = container.scrollTop;

        // Hiển thị spinner
        container.innerHTML = `
            <div class="d-flex justify-content-center align-items-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        // Tạo URL với query string
        const queryString = new URLSearchParams(params).toString();
        const fetchUrl = `${url}?${queryString}`;

        // Gửi request
        fetch(fetchUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                container.innerHTML = data.html;

                // Khôi phục vị trí cuộn
                container.scrollTop = currentScrollPosition;
            })
            .catch(error => {
                console.error('Lỗi Fetch API:', error);
                container.innerHTML = `<div class="text-center py-5 text-danger">Đã xảy ra lỗi khi tải dữ liệu!</div>`;
            });
    }

    // Lọc dữ liệu
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const params = {
                dau_so: document.querySelector('input[name="dau_so"]:checked')?.value,
                loai_thue_bao: document.querySelector('input[name="loai_thue_bao"]:checked')?.value
            };
            fetchTable('{{ route('frontend.dichvudidong.sothuebao') }}', params);
        });
    });

    // Phân trang
    container.addEventListener('click', function (e) {
        if (e.target.tagName === 'A' && e.target.closest('.pagination')) {
            e.preventDefault();
            fetchTable(e.target.getAttribute('href'));
        }
    });
});

</script>


<script>
document.getElementById('search-input').addEventListener('keyup', function() {
    let searchTerm = this.value;
    if (searchTerm.length >= 2) { // Chỉ tìm kiếm khi có ít nhất 2 ký tự
        fetchSearchResults(searchTerm);
    }
});

function fetchSearchResults(searchTerm) {
    fetch('/dich-vu-di-dong/so-thue-bao/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ searchTerm: searchTerm })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('table-container').innerHTML = data.html;
    })
    .catch(error => console.error('Lỗi:', error));
}

    </script>

@endsection
