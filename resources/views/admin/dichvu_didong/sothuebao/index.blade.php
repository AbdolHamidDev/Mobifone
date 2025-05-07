@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách số thuê bao" />

<div class="container mx-auto mt-4">
    <div class="table-responsive shadow rounded overflow-hidden bg-white">
        <div class="p-3">
            <div class="d-flex justify-content-center gap-2 mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus me-1"></i> Thêm Số Thuê Bao
                </button>
                
                <button class="btn btn-success" onclick="document.getElementById('importFileInput').click()">
                    <i class="fas fa-file-import me-1"></i> Nhập Excel
                </button>
                <input type="file" id="importFileInput" style="display:none" onchange="importSoThueBao(event)">
                
                <a href="{{ route('so-thue-bao.export') }}" class="btn btn-secondary">
                    <i class="fas fa-file-export me-1"></i> Xuất Excel
                </a>
            </div>
        </div>

        <table id="dataTable" class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Số thuê bao</th>
                    <th>Loại thuê bao</th>
                    <th>Khu vực hòa mạng</th>
                    <th>Loại số</th>
                    <th>Phí giữ số</th>
                    <th>Phí hòa mạng</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soThueBaos as $so)
                <tr id="row-{{ $so->id }}">
                    <td>{{ $so->so_thue_bao }}</td>
                    <td>{{ $so->loai_thue_bao == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}</td>
                    <td>{{ $so->khu_vuc }}</td>
                    <td>{{ $so->loai_so == 'so_vip' ? 'Số VIP' : 'Số Thường' }}</td>
                    <td>{{ $so->phi_giu_so > 0 ? number_format($so->phi_giu_so) . 'đ' : 'Miễn phí' }}</td>
                    <td>{{ number_format($so->phi_hoa_mang) }}đ</td>
                    <td>
                        @include('admin.dichvu_didong.sothuebao.status-badge', ['status' => $so->trang_thai])
                    </td>
                    <td>
                        @if ($so->trang_thai === 'chua_su_dung')
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                    data-bs-target="#editModal" 
                                    onclick="loadEditData({{ $so->id }})">
                                <i class="fas fa-edit me-1"></i> Sửa
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $so->id }})">
                                <i class="fas fa-trash-alt me-1"></i> Xóa
                            </button>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="fas fa-ban me-1"></i> Không khả dụng
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm -->
@include('admin.dichvu_didong.sothuebao.modal-add')

<!-- Modal Sửa -->
@include('admin.dichvu_didong.sothuebao.modal-edit')

@endsection

@section('js')
<script>
    // Khởi tạo DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                lengthMenu: "Hiển thị _MENU_ mục",
                zeroRecords: "Không tìm thấy kết quả",
                info: "Hiển thị _PAGE_ trên _PAGES_",
                infoEmpty: "Không có dữ liệu",
                infoFiltered: "(lọc từ _MAX_ mục)",
                search: "Tìm kiếm:",
                paginate: {
                    next: "Tiếp",
                    previous: "Trước"
                }
            },
            pageLength: 10
        });
    });

    // Xử lý import file
    function importSoThueBao(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        const formData = new FormData();
        formData.append('file', file);

        fetch('{{ route('so-thue-bao.import') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(handleResponse)
        .catch(handleError);
    }

    // Xử lý xóa
    function confirmDelete(id) {
        if (!confirm('Bạn có chắc chắn muốn xóa số thuê bao này?')) return;
        
        fetch(`{{ route('so-thue-bao.destroy', '') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(handleResponse)
        .catch(handleError);
    }

        // Tải dữ liệu để edit
        function loadEditData(id) {
    // Tạo URL đúng cách bằng cách nối chuỗi thông thường
    const editUrl = `/admin/so-thue-bao/${id}/edit`;
    
    fetch(editUrl, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Không tìm thấy dữ liệu');
        }
        return response.json();
    })
    .then(data => {
        // Điền dữ liệu vào form edit
        document.getElementById('edit_so_thue_bao').value = data.so_thue_bao;
        document.getElementById('edit_loai_thue_bao').value = data.loai_thue_bao;
        document.getElementById('edit_loai_so').value = data.loai_so;
        document.getElementById('edit_khu_vuc').value = data.khu_vuc;
        document.getElementById('edit_phi_giu_so').value = data.phi_giu_so;
        document.getElementById('edit_phi_hoa_mang').value = data.phi_hoa_mang;
        
        // Cập nhật action form sử dụng route helper trong Blade
        document.getElementById('editForm').action = `{{ route('so-thue-bao.update', '') }}/${id}`;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Không thể tải dữ liệu: ' + error.message);
    });
}

    // Xử lý response chung
    function handleResponse(response) {
        return response.json().then(data => {
            if (data.success) {
                alert('Thao tác thành công');
                location.reload();
            } else {
                throw new Error(data.message || 'Có lỗi xảy ra');
            }
        });
    }

    // Xử lý lỗi chung
    function handleError(error) {
        console.error('Error:', error);
        alert('Đã xảy ra lỗi: ' + error.message);
    }
</script>
@endsection