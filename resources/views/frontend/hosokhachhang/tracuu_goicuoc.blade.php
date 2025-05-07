@extends('layouts.frontend')
 <!-- Tailwind CSS -->
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 <!-- Font Awesome -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
 @section('content')
 <div class="container" style="padding-top: 15vh;">

    <!-- THANH ĐIỀU HƯỚNG -->
    <div class="breadcrumb">
        <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
        <span class="divider">/</span>
        <span class="current">Tra cứu gói cước</span>
    </div>
   <!-- Tiêu đề -->
   <h2 class="text-4xl font-extrabold text-center text-blue-700 mb-10">
     📊 Tra cứu Gói Cước Đã Đăng Ký
   </h2>
   
   <!-- Hộp dữ liệu với hiệu ứng mềm mại -->
   <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200" x-data="tableData()" x-init="fetchData()">
     
     <!-- Thanh tìm kiếm với viền nổi bật -->
     <div class="p-5 border-b bg-gray-50">
       <input 
         type="text" 
         x-model="searchQuery" 
         @input="filterData" 
         placeholder="🔍 Tìm kiếm gói cước..." 
         class="w-full px-4 py-3 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
       >
     </div>
 
  <!-- Bảng gói cước -->
  <div class="overflow-x-auto">
    <table class="min-w-full border-separate border-spacing-y-2">
      <thead class="bg-blue-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-semibold">Mã Gói</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Tên Gói</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Giá (VNĐ)</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Ngày Đăng Ký</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Thời Gian Còn Lại</th>
          <th class="px-6 py-3 text-left text-sm font-semibold">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="item in filteredData" :key="item.id">
          <tr :class="item.thoi_gian_con_lai <= 0 ? 'bg-gray-200 text-gray-500' : ''">
            <td class="px-6 py-4" x-text="item.id"></td>
            <td class="px-6 py-4 font-medium" x-text="item.ten_goicuoc"></td>
            <td class="px-6 py-4" x-text="formatCurrency(item.gia)"></td>
            <td class="px-6 py-4" x-text="formatDate(item.created_at)"></td>
            <td class="px-6 py-4">
                <template x-if="item.thoi_gian_con_lai > 0">
                    <span x-text="item.thoi_gian_con_lai + ' ngày'"></span>
                </template>
                <template x-if="item.thoi_gian_con_lai <= 0">
                    <span class="text-red-600 font-semibold">Hết hiệu lực</span>
                </template>
            </td>
            <td class="px-6 py-4">
                <button 
                    @click="huyGoiCuoc(item.id)" 
                    :disabled="item.thoi_gian_con_lai <= 0"
                    :class="item.thoi_gian_con_lai <= 0 ? 'opacity-50 cursor-not-allowed' : 'text-red-500 hover:text-red-700'"
                >
                    ❌ Hủy
                </button>
            </td>
        </tr>
        </template>
      </tbody>
       </table>
     </div>
 
     <!-- Phân trang nâng cao -->
     <div class="p-5 border-t flex justify-between items-center bg-gray-50">
       <div class="text-sm text-gray-600">
         Hiển thị <span x-text="filteredData.length"></span> trên <span x-text="data.length"></span> kết quả
       </div>
       <div class="flex space-x-2">
         <button 
           @click="prevPage" 
           :disabled="currentPage === 1" 
           class="px-4 py-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300 disabled:opacity-50"
         >
           ⬅️ Trước
         </button>
         <button 
           @click="nextPage" 
           :disabled="currentPage * pageSize >= data.length" 
           class="px-4 py-2 text-sm font-semibold bg-gray-200 rounded-lg hover:bg-gray-300 disabled:opacity-50"
         >
           Sau ➡️
         </button>
       </div>
     </div>
   </div>
 </div>
 
 @endsection
 
 

 @section('js')
 <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
 <script>
     function tableData() {
         return {
             data: [],
             filteredData: [],
             searchQuery: '',
             currentPage: 1,
             pageSize: 10,
             totalPages: 1,
 
             async fetchData() {
                 try {
                     const response = await fetch('{{ route("khachhang.apiSubscriptions") }}');
                     if (!response.ok) throw new Error('Network response was not ok');
                     
                     const result = await response.json();
                     this.data = Array.isArray(result?.data) ? result.data : [];
                     this.totalPages = Math.ceil(this.data.length / this.pageSize);
                     this.filterData();
                 } catch (error) {
                     console.error('Fetch error:', error);
                     this.data = [];
                     this.filterData();
                 }
             },
 
             filterData() {
                 const filtered = this.data.filter(item => 
                     item.ten_goicuoc?.toLowerCase().includes(this.searchQuery.toLowerCase())
                 );
                 
                 const start = (this.currentPage - 1) * this.pageSize;
                 this.filteredData = filtered.slice(start, start + this.pageSize);
             },
 
             nextPage() {
                 if (this.currentPage < this.totalPages) {
                     this.currentPage++;
                     this.filterData();
                 }
             },
             
             prevPage() {
                 if (this.currentPage > 1) {
                     this.currentPage--;
                     this.filterData();
                 }
             },
 
             formatCurrency(value) {
                 const num = Number(String(value).replace(/[^\d]/g, ''));
                 return isNaN(num) ? '0 ₫' : new Intl.NumberFormat('vi-VN').format(num) + ' ₫';
             },
 
             formatDate(dateString) {
                 if (!dateString) return 'Không có ngày';
                 
                 try {
                     const date = new Date(dateString);
                     return isNaN(date) ? 'Ngày không hợp lệ' : 
                         date.toLocaleDateString('vi-VN');
                 } catch {
                     return 'Ngày không hợp lệ';
                 }
             },
 
             async huyGoiCuoc(id) {
    const row = this.data.find(item => item.id === id);
    if (!row) return;
    
    const { value: reason } = await Swal.fire({
        title: `Xác nhận hủy gói: ${row.ten_goicuoc || 'Không rõ'}`,
        html: '<p>Hãy cho chúng tôi biết lý do hủy:</p>',
        input: 'text',
        inputPlaceholder: 'Lý do hủy...',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Giữ lại',
        confirmButtonText: 'Xác nhận hủy'
    });

    if (reason) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const response = await fetch('{{ route("khachhang.storeCancellation") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    registration_id: id,
                    phone_number: row.phone_number || 'Không rõ',
                    package_name: row.ten_goicuoc || 'Không rõ',
                    package_price: parseFloat(row.gia?.replace(/[^\d.]/g, '')) || 0,
                    type: row.type || 'goicuoc',
                    cancel_reason: reason,
                    cancel_by: 'Khách hàng'
                })
            });

            if (!response.ok) throw new Error();
            
            // Cập nhật ngay lập tức trên giao diện
            row.thoi_gian_con_lai = 0;
            this.filterData();
            
            Swal.fire('Thành công!', 'Gói đã được hủy.', 'success');
        } catch {
            Swal.fire('Lỗi!', 'Không thể hủy gói.', 'error');
        }
    }
}
         };
     }
 </script>
 @endsection