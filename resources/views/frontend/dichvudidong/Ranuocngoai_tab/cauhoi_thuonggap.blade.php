<div class="w-full max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold text-blue-900 mb-4 text-center">Các câu hỏi thường gặp</h2>

    <div class="flex flex-col border-t border-gray-300">
        <!-- Dropdown 1 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq1')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tôi ra nước ngoài nhưng chưa đăng ký dịch vụ CVQT của MobiFone. Tôi phải làm gì để có thể đăng ký và sử dụng dịch vụ tại nước ngoài?</span>
                </span>
                <span id="icon1">🔽</span>
            </button>
            <div id="faq1" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Bạn nên đăng ký dịch vụ CVQT tại Việt Nam, trước khi ra nước ngoài để đảm bảo dịch vụ được cung cấp đầy đủ.
Trong trường hợp bạn đã ra nước ngoài nhưng chưa đăng ký dịch vụ CVQT, bạn có thể  gọi về tổng đài số +84904144144 để cung cấp một số thông tin định danh, tổng đài viên sẽ hỗ trợ mở dịch vụ CVQT cho bạn.
            </div>
        </div>

        <!-- Dropdown 2 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq2')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tôi đã đăng ký sử dụng dịch vụ CVQT của MobiFone. Tại sao tôi vẫn không thể thực hiện được cuộc gọi khi ở nước ngoài?</span>
                </span>
                <span id="icon2">🔽</span>
            </button>
            <div id="faq2" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                + Bạn cần kiểm tra lại đã bấm số điện thoại cần gọi theo đúng cú pháp hay chưa. Cú pháp đúng là "+" (hoặc đầu số gọi ra quốc tế của nước cần gọi)_Mã nước cần gọi đến_Số điện thoại.

+ Nếu bạn là thuê bao trả trước, bạn có thể thực hiện cuộc gọi ở các mạng có thỏa thuận cho phép thực hiện cuộc gọi với MobiFone. Kiểm tra nhà mạng cung cấp dịch vụ bằng cách truy cập www.roaming.mobifone.vn và nhập thông tin vào phần tra cứu giá cước. Thông tin của các nhà mạng, loại dịch vụ cung cấp, giá cước dịch vụ sẽ được hiển thị đầy đủ trong mục Dịch vụ CVQT thông thường cho bạn tham khảo.

+ Nếu bạn là thuê bao trả sau, tín hiệu mạng ở khu vực bạn đang đứng có thể bị yếu. Vui lòng di chuyển đến địa điểm khác có sóng di động mạnh hơn. Hoặc thực hiện truy cập chọn lại mạng thủ công theo hướng dẫn chi tiết tại www.roaming.mobofine.vn

+ Nếu vẫn tiếp tục gặp sự cố không thực hiện được cuộc gọi, vui lòng liên hệ với bộ phận chăm sóc khách hàng của MobiFone +84904144144 để được hỗ trợ.
            </div>
        </div>

        <!-- Dropdown 3 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq3')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tôi đi nước ngoài và đã trả tiền cước dịch vụ CVQT của tháng đó trong hóa đơn cuối tháng, tại sao tôi lại tiếp tục nhận được hóa đơn có phần cước dịch vụ CVQT vào tháng sau đó?</span>
                </span>
                <span id="icon3">🔽</span>
            </button>
            <div id="faq3" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Việc tính cước CVQT MobiFone phải dựa trên dữ liệu cước mà nhà mạng nước ngoài gửi cho MobiFone sau khi khách hàng phát sinh dịch vụ. Do theo quy định quốc tế, việc truyền nhận các dữ liệu cước này được phép chậm tối đa 30 ngày kể từ ngày phát sinh cước. Vì vậy, tổng cước phát sinh của khách hàng có thể được thể hiện trong hóa đơn của tháng khách hàng đi nước ngoài hoặc tháng kế tiếp.
            </div>
        </div>

        <!-- Dropdown 4 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq4')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tại sao máy điện thoại của tôi không hiển thị tên người gọi khi có cuộc gọi đến trong lúc tôi đang roaming tại nước ngoài?</span>
                </span>
                <span id="icon4">🔽</span>
            </button>
            <div id="faq4" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Tùy vào sự tương thích về mặt kỹ thuật giữa mạng MobiFone và mạng khác, khi bạn roaming tại nước ngoài, số của người gọi có thể hiện lên hoặc không. Nếu gặp hiện tượng này, bạn có thể liên hệ tổng đài +84904144144 để được hỗ trợ.
            </div>
        </div>

        <!-- Dropdown 5 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq5')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Khi đang CVQT, tôi muốn gọi điện về Việt Nam, tôi cần phải chú ý điều gì?</span>
                </span>
                <span id="icon5">🔽</span>
            </button>
            <div id="faq5" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Khi đang CVQT mà bạn muốn gọi điện về Việt Nam hoặc gọi đến số điện thoại ở một nước khác, bạn chú ý bấm đủ theo cấu trúc: "+" (hoặc đầu số gọi ra quốc tế của nước cần gọi)_Mã nước cần gọi đến_Số điện thoại 
(VD: gọi về số điện thoại tại Việt Nam: +8490123456).
            </div>
        </div>

        <!-- Dropdown 6 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq6')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Sau khi trở về Việt Nam, các gói cước Data mà tôi đăng ký trước khi ra nước ngoài có còn hiệu lực không?</span>
                </span>
                <span id="icon6">🔽</span>
            </button>
            <div id="faq6" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Dịch vụ CVQT độc lập với các gói cước trong nước mà khách hàng đã đăng ký. Do đó, khi ra nước ngoài khách hàng không thể sử dụng được các gói cước, dịch vụ nội địa Việt Nam như Mobile Internet, Fast Connect…mà khách hàng đang sử dụng  trong nước. Sau khi về nước và hủy thành công dịch vụ CVQT, các gói Mobile Internet/Fast Connect, các dịch vụ GTGT sẽ được khôi phục sử dụng như bình thường. Dung lượng và thời hạn sử dụng của các gói cước, dịch vụ vẫn được giữ nguyên như trước khi sử dụng dịch vụ CVQT.
            </div>
        </div>

        <!-- Dropdown 7 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq7')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tôi đã đăng ký dịch vụ CVQT của MobiFone nhưng khi ra nước ngoài điện thoại lại không có sóng, tôi không thể nghe - gọi và sử dụng được dịch vụ viễn thông. Tôi phải làm gì?</span>
                </span>
                <span id="icon7">🔽</span>
            </button>
            <div id="faq7" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Bước 1: Tắt/Khởi động lại máy để nhà mạng nước ngoài cập nhật lại thông tin về vị trí, các dịch vụ hỗ trợ cho thuê bao. 
Bước 2: Nếu sau khi tắt/khởi động lại máy mà điện thoại vẫn không có sóng, bạn hãy tiến hành chọn mạng thủ công trên điện thoại. Hướng dẫn chi tiết cách thức cài đặt truy cập mạng thủ công, xem tại www.roaming.mobifone.vn.
            </div>
        </div>

        <!-- Dropdown 8 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq8')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Tôi đã đăng ký dịch vụ CVQT của MobiFone nhưng khi ra nước ngoài tôi không truy cập được data. Tôi phải làm gì?</span>
                </span>
                <span id="icon8">🔽</span>
            </button>
            <div id="faq8" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Để khắc phục tình trạng này, bạn vui lòng kiểm tra lại các bước sau:
Bước 1: Kiểm tra bạn đã đăng ký dịch vụ CVQT ALL chưa. Nếu chưa, soạn DK CVQT ALL gửi 999 hoặc bấm *093*2#OK.
Bước 2: Kiểm tra bạn đã bật data roaming ON và cài APN m-wap  trên điện thoại chưa? Nếu chưa, vui lòng xem hướng dẫn cài đặt truy cập GPRS chi tiết cho từng dòng điện thoại tại www.roaming.mobifone.vn
            </div>
        </div>

        <!-- Dropdown 9 -->
        <div class="border-b">
            <button onclick="toggleDropdown('faq9')" class="flex justify-between items-center w-full p-4 black-700 font-medium text-lg">
                <span class="flex items-center">
                    📄 <span class="ml-2">Khi ra nước ngoài, tôi cần làm gì để kiểm soát được dung lượng và cước phí sử dụng dịch vụ CVQT?</span>
                </span>
                <span id="icon9">🔽</span>
            </button>
            <div id="faq9" class="hidden p-4 text-gray-700">
                <!-- Nội dung sẽ được thêm ở đây -->
                Mặc dù cước dịch vụ CVQT cao hơn so với cước dịch vụ viễn thông trong nước, tuy nhiên bạn hoàn toàn có thể kiểm soát được dung lượng sử dụng và cước phí dịch vụ  bằng cách áp dụng các biện pháp sau:
+ Hủy dịch vụ chuyển cuộc gọi (Call Forwarding) nếu không cần thiết để tránh bị tính cước 2 lần (cước nhận cuộc gọi và cước thực hiện cuộc gọi). Cách hủy: Bấm ##21# 
+ Chủ động kiểm soát chặt chẽ các cuộc gọi đi, chỉ nhận các cuộc gọi cần thiết.
+ Kiểm soát việc sử dụng dịch vụ data: tải email, tự động update phần mềm, các ứng dụng chạy ngầm trên điện thoại… Nếu không có nhu cầu sử dụng dịch vụ data khi CVQT bạn có thể hủy dịch vụ CVQT data bằng cách soạn HUY CVQT DATA gửi 999 hoặc tắt data roaming trên điện thoại (hướng dẫn cài đặt truy cập GPRS chi tiết cho từng dòng điện thoại tại www.roaming.mobifone.vn).
+ Bạn có thể đăng ký một trong các gói cước ưu đãi của MobiFone để luôn chủ động kiểm soát được lưu lượng sử dụng và chi phí dịch vụ CVQT. Cú pháp kiểm tra dung lượng gói cước sử dụng: Soạn KT CVQT Mã gói gửi 999, hoặc truy cập App My MobiFone.
+ Mọi thắc mắc về gói cước ưu đãi và cước phí dịch vụ, bạn có thể gọi đến tổng đài 9090 (tại Việt Nam) hoặc  +84904144144 (tại nước ngoài) của MobiFone để được giải đáp và tư vấn!
            </div>
        </div>
    </div>
</div>


