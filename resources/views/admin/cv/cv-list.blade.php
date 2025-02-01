<!-- Danh sách CV dạng thẻ hiện đại -->
<div class="flex flex-wrap -mx-4 min-h-[300px] justify-start items-stretch">
    @foreach($cvList as $cv)
    <div class="w-full sm:w-1/2 lg:w-1/3 px-4 mb-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header với ảnh đại diện -->
            <div class="bg-gradient-to-r from-blue-500 to-green-400 p-6 text-white">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white rounded-full overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('assets/images/default-avatar.png') }}"  alt="Avatar" class="w-10 h-10 object-cover rounded-full">
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold">{{ $cv->họ_và_tên }}</h3>
                        <p class="text-sm">ID: {{ $cv->id }}</p>
                    </div>
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
                        <span class="short-text">{{ Str::limit($cv->tóm_tắt_kinh_nghiệm, 50) }}</span>
                        <span class="full-text hidden">{{ $cv->tóm_tắt_kinh_nghiệm }}</span>
                        @if (strlen($cv->tóm_tắt_kinh_nghiệm) > 50)
                            <a href="#" class="toggle-view text-blue-500 hover:underline">Xem thêm</a>
                        @endif
                    </li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="p-6 bg-gray-100 flex justify-between items-center">
                <a href="{{ asset('storage/' . $cv->cv_hồ_sơ) }}" 
                   class="text-blue-600 hover:underline text-sm" 
                   target="_blank">
                   Tải CV (PDF)
                </a>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 text-xs rounded-full {{ $cv->đã_xem ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $cv->đã_xem ? 'Đã xem' : 'Chưa xem' }}
                    </span>
                    <span class="px-3 py-1 text-xs rounded-full {{ $cv->đã_duyệt ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $cv->đã_duyệt ? 'Đã duyệt' : 'Chưa duyệt' }}
                    </span>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="p-6 flex space-x-4">
                <form action="{{ route('cv.markAsSeen', $cv->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 disabled:opacity-50"
                            {{ $cv->đã_xem ? 'disabled' : '' }}>
                        Đánh dấu đã xem
                    </button>
                </form>
                <form action="{{ route('cv.markAsApproved', $cv->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 disabled:opacity-50"
                            {{ $cv->đã_duyệt ? 'disabled' : '' }}>
                        Đánh dấu đã duyệt
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>