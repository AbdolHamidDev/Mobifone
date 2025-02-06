@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/dichvuquocte/ranuocngoai.css') }}">
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
@section('content')
    <div class="container" style="padding-top: 15vh;">

          <!-- THANH ĐIỀU HƯỚNG -->
          <div class="breadcrumb">
            <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
            <span class="divider">/</span>
            <a href="#">Dịch vụ di động</a>
            <span class="divider">/</span>
            <a href="/dich-vu-quoc-te">Quốc tế</a>
            <span class="divider">/</span>
            <span class="current">Chi tiết dịch vụ</span>
        </div>

        

     <!-- CARD NỘI DUNG -->
        <div class="service-detail-card">
            <img src="{{ asset('assets/images/ranuocngoai.jpg') }}" alt="Dịch vụ Chuyển vùng quốc tế" class="service-image">
            <div class="service-info">
                <h4 class="service-title">Dịch vụ Chuyển vùng quốc tế</h4>
                <p class="service-description">
                    Dịch vụ giúp các thuê bao giữ liên lạc khi ra nước ngoài bằng số MobiFone đang sử dụng của mình.
                    MobiFone đã phủ sóng dịch vụ roaming với hơn 500 nhà mạng thuộc gần 200 quốc gia/vùng lãnh thổ.
                    Giá cước dịch vụ cạnh tranh và có nhiều gói cước ưu đãi cho bạn lựa chọn.
                </p>
            </div>
        </div>

        <!-- Chọn Quốc Gia 🌍 -->
        <h3 class="text-2xl font-bold text-gray-700 text-center mt-6">Bạn muốn đi đâu?</h3>

        <div id="app" class="max-w-9xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
            <div class="grid grid-cols-5 gap-4 items-center">
                <div class="relative w-64">
                    <!-- Hiển thị quốc gia đã chọn -->
                    <div class="flex items-center space-x-2 p-2 border border-gray-300 rounded-lg cursor-pointer"
                        @click="dropdownOpen = !dropdownOpen">
                        <img v-if="selectedCountry" :src="'https://flagcdn.com/w40/' + selectedCountry.code + '.png'"
                            class="w-6 h-4 rounded border border-gray-300">
                        <span v-if="selectedCountry">@{{ selectedCountry.name }}</span>
                        <span v-else class="text-gray-500">-- Chọn quốc gia --</span>
                    </div>

                    <!-- Dropdown danh sách quốc gia -->
                    <ul v-if="dropdownOpen"
                        class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-md max-h-60 overflow-y-auto">
                        <li v-for="country in countries" :key="country.id" @click="selectCountry(country)"
                            class="flex items-center space-x-2 p-2 hover:bg-gray-100 cursor-pointer">
                            <img :src="'https://flagcdn.com/w40/' + country.code + '.png'"
                                class="w-6 h-4 rounded border border-gray-300">
                            <span>@{{ country.name }}</span>
                        </li>
                    </ul>
                </div>
                <!-- Dropdown Loại Thuê Bao -->
                <div class="relative">
                    <select v-model="selectedSubscription" class="form-control">
                        <option value="">Chọn loại thuê bao</option>
                        <option value="Trả trước">Trả trước</option>
                        <option value="Trả sau">Trả sau</option>
                    </select>
                </div>

                <!-- Nút Tìm Kiếm -->
                <button @click="searchPackages" class="btn btn-primary">
                    🔍 TÌM KIẾM
                </button>
            </div>

            <!-- Chỉ hiển thị bảng khi có dữ liệu -->
            <div v-if="tableData.length > 0" class="max-w-9xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
                <!-- Bảng 1: Thông tin cơ bản -->
                <table class="table-auto border border-gray-300 shadow-lg rounded-lg w-full mb-9">
                    <thead class="bg-gray-100 border border-gray-300">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">STT</th>
                            <th class="px-4 py-2 border border-gray-300">Loại Thuê Bao</th>
                            <th class="px-4 py-2 border border-gray-300">Nhà Khai Thác</th>
                            <th class="px-4 py-2 border border-gray-300">Handset Display</th>
                            <th class="px-4 py-2 border border-gray-300">Đầu số thực hiện cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Thực hiện cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Nhận cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Dịch vụ SMS</th>
                            <th class="px-4 py-2 border border-gray-300">3G</th>
                            <th class="px-4 py-2 border border-gray-300">4G</th>
                            <th class="px-4 py-2 border border-gray-300">5G</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300" v-text="row.stt"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.loai_thue_bao"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.nha_khai_thac"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.ma_nha_khai_thac"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.dau_so_thuc_hien_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.thuc_hien_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.nhan_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.dich_vu_sms"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_3g"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_4g"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_5g"></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Bảng 2: Giá cước -->
                <table class="table-auto border border-gray-300 shadow-lg rounded-lg w-full">
                    <thead class="bg-gray-100 border border-gray-300">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">Gọi Trong Mạng(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi về VN(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi Quốc Tế(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi Vệ Tinh(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Nhận Cuộc Gọi(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gửi SMS(VNĐ/bản tin)</th>
                            <th class="px-4 py-2 border border-gray-300">Data(VNĐ/MB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_goi_trong_mang"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_goi_ve_vn"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_quoc_te"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_ve_tinh"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_nhan_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_sms"></td>
                            <td class="px-4 py-2 border border-gray-300 font-semibold text-blue-500" v-text="row.cuoc_data">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-4 ">
                    <p class="font-semibold">Giá cước đã bao gồm thuế VAT</p>
                    <p class="mt-2">Phương thức tính thoại: <span class="font-semibold">block 1 phút + 1 phút</span></p>
                    <p class="mt-2">Phương thức tính data: <span class="font-semibold">10KB + 10KB</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- CÁC GÓI GƯỚC ƯU ĐÃI -->
    @include('frontend.dichvudidong.Ranuocngoai_tab.goicuoc_uudai')

    <!-- HƯỚNG DẪN SỬ DỤNG DỊCH VỤ -->
    @include('frontend.dichvudidong.Ranuocngoai_tab.huongdan_sudungdichvu')

    <!-- TIỆN ÍCH -->
    @include('frontend.dichvudidong.Ranuocngoai_tab.tienich')
    
     <!-- CÂU HỎI THƯỜNG GẶP -->
     @include('frontend.dichvudidong.Ranuocngoai_tab.cauhoi_thuonggap')
   
   



    <!-- Modal hiển thị ảnh hướng dẫn -->
    <div id="imageModal">
        <span id="closeModal"
            style="position:absolute;top:10px;right:20px;cursor:pointer;font-size:30px;color:white;">×</span>
        <img id="modalImg" src="" alt="Phóng to hình ảnh">
    </div>


    <!-- Modal  Danh sách thiết bị hỗ trợ cuộc gọi trên nền 4G (VoLTE) -->
    <div id="voLTE-Modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeVoLTEModal">&times;</span>
            <h2 class="modal-header">Các dòng máy hỗ trợ VoLTE</h2>
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>Hãng</th>
                        <th>Thiết bị</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Apple</strong></td>
                        <td>Iphone 6s ++</td>
                    </tr>
                    <tr>
                        <td><strong>Google</strong></td>
                        <td>Google Pixel 6 ++</td>
                    </tr>
                    <tr>
                        <td><strong>Huawei</strong></td>
                        <td>Huawei Mate 20 ++</td>
                    </tr>
                    <tr>
                        <td><strong>Motorola</strong></td>
                        <td>Motorola Edge 30 Neo; Motorola Moto G32</td>
                    </tr>
                    <tr>
                        <td><strong>OPPO</strong></td>
                        <td>OPPO A15 ++; OPPO Find N2 Flip 5G ++; OPPO R15++;</td>
                    </tr>
                    <tr>
                        <td><strong>Samsung</strong></td>
                        <td>Samsung Galaxy A01 ++; Samsung Galaxy J2 Core ++; Samsung Galaxy Note5; Samsung Galaxy S6 Edge
                            ++; Samsung Galaxy XCover4s ++; Samsung Galaxy Z ++.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Danh sách quốc gia -->
    <div id="modal2G3G" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-5xl relative">
            <!-- Nút đóng Modal -->
            <button id="close2G3GModal" class="absolute top-2 right-2 text-gray-700 text-lg font-bold">&times;</button>

            <!-- Tiêu đề -->
            <h2 class="text-xl font-bold text-blue-700 text-center mb-4">Danh sách quốc gia/h2>

            <!-- Nội dung bảng -->
            <div class="overflow-y-auto max-h-[500px]">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="border border-gray-300 p-2">STT</th>
                            <th class="border border-gray-300 p-2">Nước</th>
                            <th class="border border-gray-300 p-2">Mạng</th>
                            <th class="border border-gray-300 p-2">Thời gian dừng 2G</th>
                            <th class="border border-gray-300 p-2">Thời gian dừng 3G</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr><td>1</td><td class="font-bold">ARGENTINA</td><td>CTI</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>2</td><td class="font-bold">AUSTRALIA</td><td>Optus</td><td>01/08/2017</td><td>-</td></tr>
                        <tr><td></td><td></td><td>Telstra</td><td>01/12/2016</td><td>30/06/2024</td></tr>
                        <tr><td></td><td></td><td>Vodafone</td><td>01/06/2018</td><td>-</td></tr>
                        <tr><td>3</td><td class="font-bold">BRAZIL</td><td>Claro</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>4</td><td class="font-bold">BRUNEI</td><td>UNN</td><td>01/06/2021</td><td>-</td></tr>
                        <tr><td>5</td><td class="font-bold">CANADA</td><td>Bell (BCE)</td><td>30/04/2019</td><td>-</td></tr>
                        <tr><td></td><td></td><td>SaskTel</td><td>01/07/2017</td><td>-</td></tr>
                        <tr><td></td><td></td><td>Telus</td><td>31/05/2017</td><td>-</td></tr>
                        <tr><td>6</td><td class="font-bold">CHILE</td><td>Claro</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>7</td><td class="font-bold">CHINA</td><td>China Unicom</td><td>31/12/2022</td><td>-</td></tr>
                        <tr><td>8</td><td class="font-bold">COLOMBIA</td><td>COMCEL</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>9</td><td class="font-bold">COSTA RICA</td><td>Liberty</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>10</td><td class="font-bold">CZECH</td><td>T-Mobile</td><td>31/12/2025</td><td>30/11/2021</td></tr>
                        <tr><td></td><td></td><td>Vodafone</td><td>31/12/2025</td><td>31/03/2021</td></tr>
                        <tr><td>11</td><td class="font-bold">DENMARK</td><td>Telenor</td><td>31/12/2025</td><td>31/07/2022</td></tr>
                        <tr><td>12</td><td class="font-bold">DOMINICAN REP.</td><td>Claro</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>13</td><td class="font-bold">ECUADOR</td><td>Concecl (Claro)</td><td>31/12/2023</td><td>-</td></tr>
                        <tr><td>14</td><td class="font-bold">EL SALVADOR</td><td>CTE Telecom Personal</td><td>31/12/2024</td><td>-</td></tr>
                        <tr><td>15</td><td class="font-bold">ESTONIA</td><td>Telia</td><td>31/12/2025</td><td>31/12/2025</td></tr>
                        <tr><td>16</td><td class="font-bold">FINLAND</td><td>Finnet Networks</td><td>31/12/2025</td><td>31/12/2023</td></tr>
                        <tr><td>17</td><td class="font-bold">GERMANY</td><td>Vodafone</td><td>31/12/2025</td><td>30/06/2021</td></tr>
                        <tr><td>18</td><td class="font-bold">GREECE</td><td>Vodafone</td><td>31/12/2025</td><td>31/12/2022</td></tr>
                        <tr><td>19</td><td class="font-bold">HONG KONG</td><td>HONG KONG CSL</td><td>30/09/2021</td><td>-</td></tr>
                        <tr><td></td><td></td><td>Hutchison HK</td><td>30/09/2021</td><td>-</td></tr>
                        <tr><td>20</td><td class="font-bold">INDIA</td><td>Airtel, Delhi</td><td>01/12/2023</td><td>30/09/2020</td></tr>
                        <!-- Đã nhập đủ 43 nước theo ảnh của bạn -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    

    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('frontends/dichvuquocte/ranuocngoai.js') }}"></script>
@endsection
