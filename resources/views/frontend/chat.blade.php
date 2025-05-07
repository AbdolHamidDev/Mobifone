



@if (session('authenticated') && session('phone'))
    <!-- Nút chat icon -->
    <div id="chat-icon" class="chat-icon">
        <i class="fas fa-comment-dots"></i>
    </div>

    <!-- Hộp chat -->
    <div id="chat-box" class="chat-box hidden">
        <div class="chat-header">
            <h4>Chat với Admin</h4>
            <button id="close-chat" class="close-chat">&times;</button>
        </div>
        <div class="messages" id="messages">
            @if(isset($conversations) && $conversations->isNotEmpty())
                @foreach ($conversations as $conversation)
                    @foreach ($conversation->messages as $message)
                        <div class="message {{ $message->sender_phone == $phone ? 'user-message' : 'admin-message' }}">
                            <p><strong>{{ $message->sender_phone == $phone ? 'Bạn' : 'Admin' }}:</strong> {{ $message->message }}</p>
                        </div>
                    @endforeach
                @endforeach
            @else
                <p class="text-center text-muted">Chưa có tin nhắn nào.</p>
            @endif
        </div>

        <div class="chat-input">
            <textarea id="messageInput" class="form-control" placeholder="Nhập tin nhắn..."></textarea>
            <button id="sendButton" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
@endauth




@section('js')

<!-- Thư viện FontAwesome (dùng icon chat) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Script chat -->
<script>
    $(document).ready(function() {
        let phone = @json(session('phone'));
        // Ẩn chat nếu không đăng nhập
if (!phone) {
        $('#chat-icon').hide();
        $('#chat-box').hide();
    }
        // 🟢 Mở cửa sổ chat khi nhấn vào icon
        $('#chat-icon').on('click', function() {
            $('#chat-box').removeClass('hidden');
            loadMessages(); // Khi mở chat, tải tin nhắn ngay
        });

        // 🟢 Đóng cửa sổ chat
        $('#close-chat').on('click', function() {
            $('#chat-box').addClass('hidden');
        });

        // 🟢 Hàm load tin nhắn từ server
        function loadMessages() {
            $.ajax({
                url: '{{ route("chat.get") }}', // Route lấy tin nhắn từ database
                method: 'GET',
                success: function(messages) {
                    $('#messages').html(''); // Xóa nội dung cũ trước khi cập nhật

                    if (messages.length === 0) {
                        $('#messages').html('<p class="text-center text-muted">Chưa có tin nhắn nào.</p>');
                        return;
                    }

                    messages.forEach(function(message) {
                        let sender = (message.sender_phone === phone) ? 'Bạn' : 'Admin';
                        let cssClass = (message.sender_phone === phone) ? 'user-message' : 'admin-message';
                        $('#messages').append(`
                            <div class="message ${cssClass}">
                                <p><strong>${sender}:</strong> ${message.message}</p>
                            </div>
                        `);
                    });

                    // Cuộn xuống tin nhắn mới nhất
                    let messageContainer = $('#messages')[0];
if (messageContainer) {
    $('#messages').scrollTop(messageContainer.scrollHeight);
}
                },
                error: function(xhr) {
                    console.error("Không thể tải tin nhắn:", xhr.responseText);
                }
            });
        }

        // 🟢 Gửi tin nhắn AJAX
        $('#sendButton').on('click', function() {
            var message = $('#messageInput').val();
            if (message.trim() === '') {
                alert("Vui lòng nhập tin nhắn!");
                return;
            }

            $.ajax({
                url: '{{ route("chat.send") }}',
                method: 'POST',
                data: {
                    phone: phone,
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#messageInput').val('');
                    loadMessages(); // Tải lại tin nhắn sau khi gửi thành công
                },
                error: function(xhr) {
                    console.error("Lỗi khi gửi tin nhắn:", xhr.responseText);
                }
            });
        });

        // 🟢 Cập nhật tin nhắn mỗi 3 giây
        setInterval(loadMessages, 3000);
    });


    $(document).ready(function() {
    $('#chat-icon').on('click', function() {
        $('#chat-box').toggle(); // Hiện hoặc ẩn hộp chat
    });

    $('#close-chat').on('click', function() {
        $('#chat-box').hide(); // Ẩn hộp chat khi nhấn nút đóng
    });
});

</script>



<!-- CSS -->
<style>
 /* Nút chat icon */
 #chat-icon {
    position: fixed;
    top: 70vh; /* Đặt icon chat ở 70% chiều cao màn hình */
    right: 20px; /* Căn sát mép phải */
    width: 50px;
    height: 50px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
}

#chat-icon:hover {
    background-color: #0056b3;
}

/* Hộp chat (nhỏ gọn hơn) */
#chat-box {
    position: fixed;
    bottom: 80px;
    right: 0; /* Căn lề phải */
    width: 25vw; /* Giảm chiều rộng từ 30% → 25% */
    height: 60vh; /* Giảm chiều cao từ 80% → 60% */
    background: white;
    border-radius: 10px 0 0 10px; /* Bo góc bên trái */
    box-shadow: -4px 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    display: none; /* Ẩn mặc định */
    z-index: 1001;
}


/* Tiêu đề hộp chat */
.chat-header {
    background: #007bff;
    color: white;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
}

/* Nút đóng chat */
.close-chat {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

/* Nội dung chat */
.messages {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
    background: #f8f9fa;
}

/* Tin nhắn */
.message {
    padding: 5px;
    border-radius: 5px;
    margin-bottom: 5px;
}

.user-message {
    background: #007bff;
    color: white;
    align-self: flex-end;
    text-align: right;
}

.admin-message {
    background: #e9ecef;
    color: black;
    text-align: left;
}

/* Ô nhập tin nhắn */
.chat-input {
    display: flex;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ccc;
}

.chat-input textarea {
    flex: 1;
    resize: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
}

.chat-input button {
    margin-left: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
}

.chat-input button:hover {
    background: #0056b3;
}

</style>

@endsection
