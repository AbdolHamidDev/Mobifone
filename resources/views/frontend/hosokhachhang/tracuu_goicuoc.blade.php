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
        data: [], // Dữ liệu từ API
        filteredData: [], // Dữ liệu đã lọc
        searchQuery: '', // Từ khóa tìm kiếm
        currentPage: 1, // Trang hiện tại
        pageSize: 10, // Số lượng item mỗi trang

        // Fetch dữ liệu từ API
        async fetchData() {
        try {
            const response = await fetch('{{ route("khachhang.apiSubscriptions") }}');
            const result = await response.json();

            // Đảm bảo this.data là một mảng
            if (result && Array.isArray(result.data)) {
            this.data = result.data; // Nếu API trả về { data: [...] }
            } else if (Array.isArray(result)) {
            this.data = result; // Nếu API trả về trực tiếp một mảng
            } else {
            console.error('Dữ liệu trả về không hợp lệ:', result);
            this.data = []; // Gán mảng rỗng nếu dữ liệu không hợp lệ
            }

            this.filterData(); // Lọc dữ liệu sau khi fetch
        } catch (error) {
            console.error('Lỗi khi fetch dữ liệu:', error);
            this.data = []; // Gán mảng rỗng nếu có lỗi
        }
        },

        // Lọc dữ liệu dựa trên searchQuery
        filterData() {
        this.filteredData = this.data.filter(item => {
            return item.ten_goicuoc.toLowerCase().includes(this.searchQuery.toLowerCase());
        }).slice((this.currentPage - 1) * this.pageSize, this.currentPage * this.pageSize);
        },

        // Chuyển trang
        nextPage() {
        this.currentPage++;
        this.filterData();
        },
        prevPage() {
        this.currentPage--;
        this.filterData();
        },

        formatCurrency(value) {
    // Loại bỏ tất cả ký tự không phải số (giữ nguyên số 0)
    const cleanValue = String(value).replace(/[^\d]/g, '');

    // Chuyển thành số nguyên
    const numberValue = parseInt(cleanValue, 10);

    if (isNaN(numberValue)) {
        return '0 ₫';
    }

    // Định dạng tiền tệ với Intl
    return new Intl.NumberFormat('vi-VN').format(numberValue) + ' ₫';
    },


    formatDate(dateString) {
    if (!dateString) {
        return 'Không có ngày';
    }

    // Loại bỏ dấu cách thừa
    dateString = dateString.trim();

    // 1. Cố gắng chuyển thành Date trực tiếp (hỗ trợ ISO, timestamp, RFC)
    let date = new Date(dateString);
    
    // 2. Nếu parse thất bại (NaN), thử khắc phục bằng regex
    if (isNaN(date.getTime())) {
        // Bắt mọi kiểu phổ biến: yyyy-mm-dd, dd-mm-yyyy, yyyy/mm/dd, dd/mm/yyyy
        const regex = /(\d{1,4})[\/\-](\d{1,2})[\/\-](\d{1,4})/;
        const match = dateString.match(regex);

        if (match) {
        let [_, p1, p2, p3] = match;
        let year, month, day;

        // Xác định định dạng: yyyy-mm-dd hoặc dd-mm-yyyy
        if (p1.length === 4) {
            // yyyy-mm-dd hoặc yyyy/dd/mm
            year = p1;
            month = p2;
            day = p3;
        } else {
            // dd-mm-yyyy hoặc dd/mm/yyyy
            day = p1;
            month = p2;
            year = p3;
        }

        // Tạo đối tượng Date
        date = new Date(`${year}-${month}-${day}T00:00:00`);
        } else {
        return 'Ngày không hợp lệ';
        }
    }

    // 3. Trả về ngày định dạng dd/mm/yyyy chuẩn Việt Nam
    if (isNaN(date.getTime())) {
        return 'Ngày không hợp lệ';
    }

    return date.toLocaleDateString('vi-VN', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
    },


        // Hủy gói cước
        async huyGoiCuoc(id) {
        const row = this.data.find(item => item.id === id);
        const packagePrice = parseFloat(row.gia?.replace(/[^\d.]/g, '')) || 0;

        const { value: reason } = await Swal.fire({
    title: '<i class="fas fa-box-open"></i> Xác nhận hủy gói: ' + (row.ten_goicuoc ?? 'Không rõ'),
    html: '<p>Rất tiếc khi bạn muốn hủy gói cước này. <i class="fas fa-heart-broken text-red-500"></i><br>Hãy cho chúng tôi biết lý do:</p>',
    icon: 'warning',
    input: 'text',
    inputPlaceholder: 'Nhập lý do hủy...',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: '<i class="fas fa-ban"></i> Xác nhận hủy',
    cancelButtonText: '<i class="fas fa-undo-alt"></i> Giữ lại',
    });


        if (reason) {
            try {
            const response = await fetch('{{ route("khachhang.storeCancellation") }}', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                registration_id: id,
                phone_number: row.phone_number ?? 'Không rõ',
                package_name: row.ten_goicuoc ?? 'Không rõ',
                package_price: packagePrice,
                type: row.type ?? 'goicuoc',
                cancel_reason: reason || 'Không rõ',
                cancel_by: 'Khách hàng',
                }),
            });

            if (response.ok) {
                Swal.fire('Thành công!', 'Gói cước đã được hủy.', 'success');
                this.fetchData(); // Làm mới dữ liệu
            } else {
                throw new Error('Lỗi khi hủy gói cước');
            }
            } catch (error) {
            Swal.fire('Lỗi!', 'Không thể hủy gói cước.', 'error');
            }
        }
        },
    };
    }
</script>
@endsection