<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
      <!-- Panel bên trái - chiếm 50% -->
      <div class="flex flex-col gap-6 h-full">
        <!-- Phần chọn quốc gia -->
        <div class="relative bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-lg border border-white/20 transition-all duration-300 hover:shadow-md">
          <label for="select-map" class="block text-lg font-semibold text-gray-800 mb-3">
            <span class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
              Chọn quốc gia
            </span>
          </label>
          <div class="relative">
            <select id="select-map" class="w-full px-4 py-3 pr-10 text-gray-800 bg-white/90 border border-gray-200/80 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/70 focus:border-blue-500 transition-all duration-300 appearance-none hover:border-blue-300/80 cursor-pointer">
              <option value="" disabled selected>-- Chọn quốc gia --</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500/80" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>
  
        <!-- Thông tin quốc gia -->
        <div id="country-info" class="flex-1 bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/20 flex flex-col">
          <div class="flex justify-between items-start mb-4">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
              </svg>
              Thông tin quốc gia
            </h3>
            <div id="country-flag" class="w-16 h-16 flex items-center justify-center rounded-xl shadow-md border border-gray-300 bg-gradient-to-r from-blue-100 to-blue-300 relative overflow-hidden">
                <div class="globe-container">
                    <svg class="globe-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                        <path d="M2 12h20M12 2a15 15 0 010 20a15 15 0 010-20" stroke-width="2"></path>
                    </svg>
                </div>
            </div>           
          </div>
          
          <div id="wiki-info" class="flex-1 overflow-y-auto pr-2 mb-4">
            <div class="animate-pulse space-y-4">
              <div class="h-4 bg-gray-200/50 rounded w-3/4"></div>
              <div class="h-4 bg-gray-200/50 rounded w-full"></div>
              <div class="h-4 bg-gray-200/50 rounded w-5/6"></div>
            </div>
          </div>
          
          <div id="country-stats" class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
            <div class="bg-blue-50/80 p-4 rounded-xl border border-blue-100">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-sm font-medium text-blue-700">Dân số</span>
              </div>
              <p id="population" class="text-xl font-bold text-blue-900 mt-1">--</p>
            </div>
            
            <div class="bg-green-50/80 p-4 rounded-xl border border-green-100">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium text-green-700">Diện tích</span>
              </div>
              <p id="area" class="text-xl font-bold text-green-900 mt-1">--</p>
            </div>
            
            <div class="bg-purple-50/80 p-4 rounded-xl border border-purple-100">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium text-purple-700">Tiền tệ</span>
              </div>
              <p id="currency" class="text-xl font-bold text-purple-900 mt-1">--</p>
            </div>
            
            <div class="bg-amber-50/80 p-4 rounded-xl border border-amber-100">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="text-sm font-medium text-amber-700">GDP</span>
              </div>
              <p id="gdp" class="text-xl font-bold text-amber-900 mt-1">--</p>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Bản đồ - chiếm 50% -->
      <div class="relative h-full min-h-[500px] lg:min-h-[600px]">
        <div id="map-container" class="h-full rounded-2xl overflow-hidden border-2 border-gray-200/80 shadow-xl transition-all duration-300 hover:shadow-2xl">
          <div id="map" class="w-full h-full"></div>
          
          <!-- Controls -->
          <div class="absolute bottom-6 left-6 flex flex-col space-y-3">
            <button id="zoom-in" class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-lg shadow-md border border-gray-200/60 flex items-center justify-center text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
              </svg>
            </button>
            <button id="zoom-out" class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-lg shadow-md border border-gray-200/60 flex items-center justify-center text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
          
          <!-- Thông tin hướng dẫn -->
          <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-gray-200/60 text-sm text-gray-600 flex items-center transition-all duration-300 hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd" />
            </svg>
            Kéo để di chuyển, cuộn để phóng to/thu nhỏ
          </div>
          
          <!-- Loading indicator -->
          <div id="map-loading" class="absolute inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300">
            <div class="flex flex-col items-center">
              <div class="w-12 h-12 border-4 border-blue-500/30 border-t-blue-500 rounded-full animate-spin mb-3"></div>
              <p class="text-gray-600 font-medium">Đang tải bản đồ...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Hiệu ứng spotlight theo vị trí chuột
    document.getElementById('map-container').addEventListener('mousemove', function(e) {
      this.style.setProperty('--x', e.offsetX + 'px');
      this.style.setProperty('--y', e.offsetY + 'px');
    });
  </script>