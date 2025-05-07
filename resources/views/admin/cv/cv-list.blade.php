<!-- Danh sách CV -->
<div class="flex flex-wrap -mx-4 min-h-[300px]">
    @foreach($cvList as $cv)
    <div class="w-full sm:w-1/2 lg:w-1/3 px-4 mb-8">
        <div class="bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div class="p-6 bg-blue-500 text-white flex items-center">
                <img 
                    src="{{ asset('assets/images/default-avatar.png') }}" 
                    alt="Avatar" 
                    class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <h3 class="text-xl font-bold">{{ $cv->họ_và_tên }}</h3>
                    <p class="text-sm">ID: {{ $cv->id }}</p>
                </div>
            </div>

            <!-- Nội dung chi tiết -->
            <div class="p-6">
                <ul class="text-gray-700 space-y-2">
                    <li><strong>Email:</strong> {{ $cv->email }}</li>
                    <li><strong>Số điện thoại:</strong> {{ $cv->số_điện_thoại }}</li>
                    <li><strong>Trường học:</strong> {{ $cv->trường_học }}</li>
                    <li><strong>Ngành nghề:</strong> {{ $cv->ngành_nghề }}</li>
                    <li><strong>Trình độ:</strong> {{ $cv->trình_độ }}</li>
                    <li><strong>Kinh nghiệm:</strong> 
                        {{ Str::limit($cv->tóm_tắt_kinh_nghiệm, 50) }}
                        @if (strlen($cv->tóm_tắt_kinh_nghiệm) > 50)
                            <a href="#" class="text-blue-500 hover:underline">Xem thêm</a>
                        @endif
                    </li>
                </ul>
            </div>

            <!-- Trạng thái -->
            <div class="p-6 bg-gray-100 flex justify-between items-center">
                <a href="{{ asset('storage/' . $cv->cv_hồ_sơ) }}" 
                   target="_blank" 
                   class="text-blue-600 hover:underline text-sm">
                   Tải CV (PDF)
                </a>
                <div class="flex items-center space-x-2">
                    <span class="status-label {{ $cv->đã_xem ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $cv->đã_xem ? 'Đã xem' : 'Chưa xem' }}
                    </span>
                    <span class="status-label {{ $cv->đã_duyệt ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $cv->đã_duyệt ? 'Đã duyệt' : 'Chưa duyệt' }}
                    </span>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="p-6 flex space-x-4">
                <form action="{{ route('cv.markAsSeen', $cv->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="action-btn bg-blue-600 hover:bg-blue-700" 
                            {{ $cv->đã_xem ? 'disabled' : '' }}>
                        Đánh dấu đã xem
                    </button>
                </form>
                <form action="{{ route('cv.markAsApproved', $cv->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="action-btn bg-green-600 hover:bg-green-700" 
                            {{ $cv->đã_duyệt ? 'disabled' : '' }}>
                        Đánh dấu đã duyệt
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>