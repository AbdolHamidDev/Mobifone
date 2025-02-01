@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Số thuê bao'])

<div class="container mt-4">
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Thêm Số Thuê Bao</button>

    <div class="table-responsive shadow-sm">
        <table id="dataTable" class="table table-bordered display">
            <thead>
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
                <tr>
                    <td>{{ $so->so_thue_bao }}</td>
                    <td>{{ $so->loai_thue_bao == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}</td>
                    <td>{{ $so->khu_vuc }}</td>
                    <td>{{ $so->loai_so == 'so_vip' ? 'Số VIP' : 'Số Thường' }}</td>
                    <td>{{ $so->phi_giu_so > 0 ? number_format($so->phi_giu_so) . 'đ' : 'Miễn phí' }}</td>
                    <td>{{ number_format($so->phi_hoa_mang) }}đ</td>
                    <td class="text-center">
                        @if ($so->trang_thai === 'giu_so')
                            <span class="badge bg-success"><i class="fa fa-check-circle"></i> Giữ số</span>
                        @elseif ($so->trang_thai === 'chua_su_dung')
                            <span class="badge bg-warning"><i class="fa fa-clock"></i> Đang chờ sử dụng</span>
                        @elseif ($so->trang_thai === 'hoa_mang')
                            <span class="badge bg-primary"><i class="fa fa-signal"></i> Hòa mạng thành công</span>
                        @else
                            <span class="badge bg-secondary">Không xác định</span>
                        @endif
                    </td>
                    
                    
                    <td>
                        @if ($so->trang_thai === 'chua_su_dung')
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $so->id }}">Sửa</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $so->id }}">Xóa</button>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Không khả dụng</button>
                        @endif
                    </td>
                </tr>
             

            <!-- Modal Sửa -->
<div class="modal fade" id="editModal{{ $so->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('so-thue-bao.update', $so->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Số Thuê Bao</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="so_thue_bao" class="form-label">Số thuê bao</label>
                        <input type="text" class="form-control" name="so_thue_bao" value="{{ $so->so_thue_bao }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="loai_thue_bao" class="form-label">Loại thuê bao</label>
                        <select class="form-select" name="loai_thue_bao" required>
                            <option value="tra_truoc" {{ $so->loai_thue_bao == 'tra_truoc' ? 'selected' : '' }}>Trả trước</option>
                            <option value="tra_sau" {{ $so->loai_thue_bao == 'tra_sau' ? 'selected' : '' }}>Trả sau</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="khu_vuc" class="form-label">Khu vực hòa mạng</label>
                        <input type="text" class="form-control" name="khu_vuc" value="{{ $so->khu_vuc }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loai_so" class="form-label">Loại số</label>
                        <select class="form-select" name="loai_so" required>
                            <option value="so_thuong" {{ $so->loai_so == 'so_thuong' ? 'selected' : '' }}>Số Thường</option>
                            <option value="so_vip" {{ $so->loai_so == 'so_vip' ? 'selected' : '' }}>Số VIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phi_giu_so" class="form-label">Phí giữ số</label>
                        <input type="number" class="form-control" name="phi_giu_so" value="{{ $so->phi_giu_so }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phi_hoa_mang" class="form-label">Phí hòa mạng</label>
                        <input type="number" class="form-control" name="phi_hoa_mang" value="{{ $so->phi_hoa_mang }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>


                <!-- Modal Xóa -->
                <div class="modal fade" id="deleteModal{{ $so->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('so-thue-bao.destroy', $so->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Xóa Số Thuê Bao</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa số <strong>{{ $so->so_thue_bao }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('so-thue-bao.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Số Thuê Bao</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="so_thue_bao" class="form-label">Số thuê bao</label>
                        <input type="text" class="form-control" name="so_thue_bao" required>
                    </div>
                    <div class="mb-3">
                        <label for="loai_thue_bao" class="form-label">Loại thuê bao</label>
                        <select class="form-select" name="loai_thue_bao" required>
                            <option value="tra_truoc">Trả trước</option>
                            <option value="tra_sau">Trả sau</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="khu_vuc" class="form-label">Khu vực hòa mạng</label>
                        <input type="text" class="form-control" name="khu_vuc" value="Toàn quốc" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loai_so" class="form-label">Loại số</label>
                        <select class="form-select" name="loai_so" required>
                            <option value="so_thuong">Số Thường</option>
                            <option value="so_vip">Số VIP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phi_giu_so" class="form-label">Phí giữ số</label>
                        <input type="number" class="form-control" name="phi_giu_so" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="phi_hoa_mang" class="form-label">Phí hòa mạng</label>
                        <input type="number" class="form-control" name="phi_hoa_mang" required>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<style>
    input[readonly] {
    background-color: #e9ecef; /* Màu nền nhạt */
    cursor: not-allowed; /* Con trỏ chuột thể hiện không thể chỉnh sửa */
}

    </style>


@section('js')
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục",
                "zeroRecords": "Không tìm thấy kết quả",
                "info": "Hiển thị _PAGE_ trên _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ mục)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            },
            "pageLength": 10, // Số mục hiển thị trên mỗi trang
            "ordering": true,
            "responsive": true
        });
    });
</script>
@endsection