



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



@section('js')

<!-- Thư viện FontAwesome (dùng icon chat) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Script chat -->
<script>
    $(document).ready(function() {
        let phone = "{{ session('phone') }}"; // Lấy số điện thoại từ session

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
                    $('#messages').scrollTop($('#messages')[0].scrollHeight);
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
</script>



<!-- CSS -->
<style>
    /* Nút chat icon */
  /* Điều chỉnh vị trí của hộp chat */
.chat-box {
    position: fixed;
    bottom: 90px; /* Điều chỉnh khoảng cách từ dưới lên */
    right: 40px;  /* Đẩy hộp chat ra xa mép phải */
    width: 320px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    z-index: 1000;
}

/* Điều chỉnh vị trí nút chat icon */
.chat-icon {
    position: fixed;
    bottom: 20px; 
    right: 40px; /* Đẩy nút chat ra xa mép phải */
    width: 50px;
    height: 50px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}


    /* Ẩn hộp chat */
    .hidden {
        display: none;
    }

    /* Header chat */
    .chat-header {
        background: #007bff;
        color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* Đóng chat */
    .close-chat {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: white;
    }

    /* Tin nhắn */
    .messages {
        padding: 10px;
        max-height: 300px;
        overflow-y: auto;
    }

    /* Kiểu tin nhắn */
    .message {
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 5px;
    }

    /* Tin nhắn của user */
    .user-message {
        background: #007bff;
        color: white;
        text-align: right;
    }

    /* Tin nhắn của admin */
    .admin-message {
        background: #f1f1f1;
        text-align: left;
    }

    /* Ô nhập tin nhắn */
    .chat-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ddd;
    }

    .chat-input textarea {
        flex: 1;
        border: none;
        padding: 10px;
        resize: none;
        border-radius: 5px;
    }

    .chat-input button {
        margin-left: 10px;
        background: #007bff;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

@endsection
