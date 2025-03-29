<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="flex justify-end items-center gap-3 text-sm text-gray-600 animate-fadeInUp pr-6">
                        <!-- Breadcrumb với responsive -->
                        <div class="flex items-center flex-wrap gap-2">
                            <!-- Icon Home -->
                            <a href="#"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-200 flex items-center font-medium group">
                                <i class="fas fa-home mr-2 group-hover:text-blue-600 transition-colors duration-200"></i>
                                <span class="hidden sm:inline">{{ $name }}</span>
                            </a>

                            <!-- Separator -->
                            <span class="text-gray-400 hidden sm:inline">/</span>

                            <!-- Current Page với animation và responsive -->
                            <span
                                class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg bg-blue-500/20 backdrop-blur-md shadow-md hover:bg-blue-500/40 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                                <span class="truncate max-w-[120px] sm:max-w-none">{{ $key }}</span>
                            </span>
                        </div>

                        <!-- Sử dụng helper asset() của Laravel -->
                        <div class="ml-auto sm:ml-4 flex items-center">
                            <div class="relative group">
                                <!-- Glow effect -->
                                <div
                                    class="absolute inset-0 rounded-full bg-blue-400 opacity-0 group-hover:opacity-30 blur-md transition-opacity duration-300">
                                </div>

                                <!-- Avatar using Laravel asset helper -->
                                <img src="{{ asset('assets/images/me.jpg') }}" alt="User avatar"
                                    onerror="this.src='{{ asset('assets/images/default-avatar.jpg') }}'"
                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-full object-cover border-2 border-white shadow-md group-hover:border-blue-200 transition-all duration-300 cursor-pointer">

                                <!-- Status indicator -->
                                <div
                                    class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border border-white">
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
