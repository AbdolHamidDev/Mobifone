<div class="w-full max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold text-blue-900 mb-4 text-center">Các gói cước ưu đãi</h2>
    
    <!-- Dùng flex-col thay vì grid để tránh bị che -->
    <div class="flex flex-col gap-6"> 
        
        <!-- Item 1 -->
        <div class="block">
            <button onclick="toggleDropdown('dropdown1')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Đăng ký dịch vụ Chuyển vùng quốc tế</span>
                </span>
                <span id="icon1">🔽</span>
            </button>
            <div id="dropdown1" class="hidden p-4">
                <div class="flex gap-4">
                    @php
                        $cvqt = \App\Models\GoiCuoc::where('ten_goicuoc', 'CVQT')->first();
                    @endphp
                    @if($cvqt)
                        <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $cvqt->id) }}" 
                        class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                            <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                            <span class="ml-2 text-gray-700 font-medium">DK {{ $cvqt->ten_goicuoc }} ({{ $cvqt->mo_ta }})</span>
                        </a>
                    @endif

                    @php
                        $cvqtAll = \App\Models\GoiCuoc::where('ten_goicuoc', 'CVQT ALL')->first();
                    @endphp
                    @if($cvqtAll)
                        <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $cvqtAll->id) }}" 
                        class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                            <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                            <span class="ml-2 text-gray-700 font-medium">DK {{ $cvqtAll->ten_goicuoc }} ({{ $cvqtAll->mo_ta }})</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

      <!-- Item 2 -->
<div class="block">
    <button onclick="toggleDropdown('dropdown2')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
        <span class="flex items-center">
            📄 <span class="ml-2">Gói cước Thoại, SMS, Data</span>
        </span>
        <span id="icon2">🔽</span>
    </button>
    <div id="dropdown2" class="hidden p-4">
        <div class="flex flex-wrap gap-4">
            @php
                // Lấy ngẫu nhiên các gói cước chuyển vùng quốc tế
                $randomGoicuoc = \App\Models\Goicuoc::where('loai_goicuoc', 'chuyen_vung_quoc_te')
                    ->where('status', 1)
                    ->inRandomOrder()
                    ->limit(8) // Giới hạn tối đa 8 gói như code gốc
                    ->get();
            @endphp
            
            @foreach($randomGoicuoc as $goicuoc)
                <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goicuoc->id) }}" 
                   class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                    <span class="ml-2 text-gray-700 font-medium">{{ $goicuoc->ten_goicuoc }}</span>
                </a>
            @endforeach
            
            @if($randomGoicuoc->isEmpty())
                <div class="p-4 text-gray-500">Hiện không có gói cước nào</div>
            @endif
        </div>
    </div>
</div>

      <!-- Item 3 -->
<div class="block">
    <button onclick="toggleDropdown('dropdown3')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
        <span class="flex items-center">
            📄 <span class="ml-2">Gói cước theo khu vực</span>
        </span>
        <span id="icon3">🔽</span>
    </button>
    <div id="dropdown3" class="hidden p-4">
        <div class="flex flex-wrap gap-4">
            @php
                // Lấy ngẫu nhiên 12 gói data bất kỳ (giữ nguyên số lượng như code gốc)
                $goidatasRegion = \App\Models\GoiData::where('status', 1)
                    ->inRandomOrder()
                    ->limit(12)
                    ->get();
            @endphp
            @foreach($goidatasRegion as $goidata)
                <a href="{{ url('/dich-vu-di-dong/goi-data/' . $goidata->id) }}" 
                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                    <span class="ml-2 text-gray-700 font-medium">{{ $goidata->ten_data }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

    </div>
</div>