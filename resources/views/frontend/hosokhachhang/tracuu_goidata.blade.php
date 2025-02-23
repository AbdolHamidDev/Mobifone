@extends('layouts.frontend')

@section('content')
<div class="container" style="padding-top: 15vh;">
  <h2>Tra cứu Gói Data Đã Đăng Ký</h2>
  <div id="goidata-content">
    <table id="goidata-table" class="table table-bordered">
        <thead>
          <tr>
            <th>Mã Gói</th>
            <th>Tên Gói</th>
            <th>Giá</th>
            <th>Ngày Đăng Ký</th>
            <th>Hành Động</th>
          </tr>
        </thead>
      </table>
      
      <script>
      $(function() {
          $('#goidata-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ route('khachhang.apiSubscriptions2') }}',
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'ten_data', name: 'ten_data' },
                  { data: 'gia', name: 'gia' },
                  { data: 'created_at', name: 'created_at' },
                  { 
                      data: 'id',
                      render: function(data) {
                          return `
                              <button onclick="huyGoiData(${data})" class="btn btn-danger">Hủy</button>
                          `;
                      }
                  }
              ]
          });
      });
      
      function huyGoiData(id) {
          if (confirm('Bạn có chắc chắn muốn hủy gói data này không?')) {
              $.ajax({
                  url: `/khachhang/goidata/huy/${id}`,
                  type: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                      alert(response.message);
                      $('#goidata-table').DataTable().ajax.reload();
                  },
                  error: function(xhr) {
                      alert(xhr.responseJSON.message || 'Đã xảy ra lỗi!');
                  }
              });
          }
      }
      </script>
      
  </div>
</div>
@endsection
