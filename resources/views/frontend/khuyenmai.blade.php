


<script src="https://cdn.tailwindcss.com"></script>

<style>
    .active-tab {
        font-weight: bold;
        border-bottom: 3px solid #00c3ff;
        cursor: pointer;
    }
    .tab-item {
        padding: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .tab-item:hover {
        color: #00c3ff;
    }
    .news-card img {
        border-radius: 8px;
    }
    .hidden {
        display: none;
    }
</style>

<section class="news-section" id="news">
    <div class="wrapper mx-auto px-6 py-12 max-w-5xl bg-white shadow-lg rounded-lg">
        <div class="text-center mb-6">
            <h6 class="text-primary font-semibold">Thông tin mới</h6>
            <h4 class="text-2xl font-bold">Tin tức và khuyến mãi</h4>
        </div>
        <div class="tabs-container">
            <div class="tab-menu flex justify-center space-x-6 border-b-2 pb-2">
                <div class="tab-item active-tab" data-tab="promo-news">Tin khuyến mãi</div>
                <div class="tab-item" data-tab="event-news">Tin tức sự kiện</div>
                <div class="tab-item" data-tab="press-news">Thông cáo báo chí</div>
            </div>
            <div class="tab-contents mt-6">
                <!-- Tin khuyến mãi -->
                <div class="tab-content" id="promo-news" style="display: block;">
                    @foreach ($newsPromotion as $item)
                        @if ($item->kiemduyet && $item->kichhoat)
                            <div class="news-card flex items-center gap-4 p-4 border-b cursor-pointer">
                                <img class="w-32 h-24 object-cover rounded-md" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                <div class="flex flex-col justify-between">
                                    <h5 class="text-lg font-bold">{{ $item->title }}</h5>
                                    <p class="text-sm text-gray-600">{!! \Illuminate\Support\Str::limit($item->content, 150) !!}</p>
                                    <a href="{{ route('frontend.news.detail', $item->id) }}" 
                                       class="mt-2 text-blue-500 hover:underline font-semibold">
                                        Xem chi tiết →
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Tin tức sự kiện -->
                <div class="tab-content" id="event-news" style="display: none;">
                    @foreach ($newsEvent as $item)
                        @if ($item->kiemduyet && $item->kichhoat)
                            <div class="news-card flex items-center gap-4 p-4 border-b cursor-pointer">
                                <img class="w-32 h-24 object-cover rounded-md" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                <div class="flex flex-col justify-between">
                                    <h5 class="text-lg font-bold">{{ $item->title }}</h5>
                                    <p class="text-sm text-gray-600">{!! \Illuminate\Support\Str::limit($item->content, 150) !!}</p>
                                    <a href="{{ route('frontend.news.detail', $item->id) }}" 
                                       class="mt-2 text-blue-500 hover:underline font-semibold">
                                        Xem chi tiết →
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Thông cáo báo chí -->
                <div class="tab-content" id="press-news" style="display: none;">
                    @foreach ($newsPress as $item)
                        @if ($item->kiemduyet && $item->kichhoat)
                            <div class="news-card flex items-center gap-4 p-4 border-b cursor-pointer">
                                <img class="w-32 h-24 object-cover rounded-md" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                <div class="flex flex-col justify-between">
                                    <h5 class="text-lg font-bold">{{ $item->title }}</h5>
                                    <p class="text-sm text-gray-600">{!! \Illuminate\Support\Str::limit($item->content, 150) !!}</p>
                                    <a href="{{ route('frontend.news.detail', $item->id) }}" 
                                       class="mt-2 text-blue-500 hover:underline font-semibold">
                                        Xem chi tiết →
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".tab-item");
        const tabContents = document.querySelectorAll(".tab-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", function() {
                const targetTab = this.getAttribute("data-tab");

                tabs.forEach(t => t.classList.remove("active-tab"));
                this.classList.add("active-tab");

                tabContents.forEach(content => {
                    content.style.display = content.id === targetTab ? "block" : "none";
                });
            });
        });
    });
</script>

