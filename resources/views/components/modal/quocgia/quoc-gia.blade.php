<!-- Modal Thêm Quốc Gia -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="form-quocgia" class="modal-content rounded-xl overflow-hidden border-0 shadow-xl">
            @csrf
            <input type="hidden" id="quocgia_id">
            
            <!-- Modal Header (Giữ nguyên như trước) -->
            <div class="modal-header bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-700 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="modal-title text-xl font-semibold">Thêm/Sửa Quốc Gia</h5>
                        <p class="text-blue-100 text-sm font-light mt-1">Chọn quốc gia từ danh sách hoặc nhập thông tin mới</p>
                    </div>
                </div>
                <button type="button" class="btn-close text-white opacity-80 hover:opacity-100 transition-opacity" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6 space-y-5">
                <!-- Dropdown Chọn Quốc Gia (QUAN TRỌNG: Giữ nguyên ID gốc) -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Chọn Quốc Gia <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <!-- Đây là phần quan trọng: GIỮ NGUYÊN ID "select-quoc-gia" -->
                        <select class="block w-full px-4 py-3 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" id="select-quoc-gia">
                            <option value="">-- Chọn quốc gia --</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- (Các phần khác giữ nguyên như trước) -->
                <div id="flag-display" class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg border border-gray-200 hidden transition-all duration-200">
                    <div class="flex-shrink-0">
                        <img id="flag-img" src="" class="w-16 h-12 object-cover border rounded-md shadow-sm" alt="Flag">
                    </div>
                    <div>
                        <span id="flag-name" class="block text-lg font-semibold text-gray-800"></span>
                        <span class="block text-sm text-gray-500 mt-1">Quốc gia được chọn</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Tên Quốc Gia</label>
                        <div class="relative">
                            <input type="text" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" id="ten_quoc_gia" readonly>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Mã Quốc Gia</label>
                        <div class="relative">
                            <input type="text" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" id="ma_quoc_gia" readonly>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <!-- Modal Body -->
 <div class="modal-body p-6">
    {{ $slot }}
</div>
            <!-- Modal Footer (Giữ nguyên như trước) -->
            <div class="modal-footer bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <div id="duplicate-warning" class="flex items-center text-red-600 hidden animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">Quốc gia này đã có trong danh sách!</span>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all" data-bs-dismiss="modal">
                        Hủy bỏ
                    </button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all flex items-center" id="btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Lưu thông tin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>