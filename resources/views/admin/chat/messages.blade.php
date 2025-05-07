@extends('layouts.admin')

@section('content')
<x-layout.content-header title="tin nhắn" />

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chat với khách hàng {{ $conversation->phone }}</h4>
        </div>
        <div class="card-body">
            <!-- Khung tin nhắn -->
            <div class="messages p-4 border rounded-lg overflow-y-auto" id="messages">
                @foreach ($conversation->messages as $message)
                    <div class="d-flex {{ $message->sender_phone == 'Admin' ? 'justify-content-end' : 'justify-content-start' }}">
                        <div class="p-3 rounded-lg shadow-sm"
                            style="max-width: 70%;
                                background: {{ $message->sender_phone == 'Admin' ? '#007bff' : '#f1f1f1' }};
                                color: {{ $message->sender_phone == 'Admin' ? 'white' : 'black' }};">
                            <strong>{{ $message->sender_phone == 'Admin' ? 'Admin' : $conversation->phone }}:</strong> 
                            <p>{{ $message->message }}</p>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Thanh nhập tin nhắn -->
            <div class="d-flex align-items-center mt-3">
                <textarea id="messageInput" class="form-control me-2" placeholder="Nhập tin nhắn..."></textarea>
                <button id="sendButton" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let messagesBox = document.getElementById("messages");
        let sendButton = document.getElementById("sendButton");
        let messageInput = document.getElementById("messageInput");

        function scrollToBottom() {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }

        scrollToBottom();

        messageInput.addEventListener("keypress", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                sendButton.click();
            }
        });

        sendButton.addEventListener("click", function () {
            let message = messageInput.value.trim();
            if (!message) {
                alert("Vui lòng nhập tin nhắn!");
                return;
            }

            let tempMessage = `<div class="d-flex justify-content-end">
                <div class="p-3 rounded-lg shadow-sm bg-primary text-white" style="max-width: 70%;">
                    <strong>Admin:</strong> ${message}
                </div>
            </div>`;
            messagesBox.innerHTML += tempMessage;
            scrollToBottom();
            messageInput.value = '';

            fetch('{{ route("chat.admin.send") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ conversation_id: "{{ $conversation->id }}", message: message })
            }).then(response => response.json())
              .then(data => console.log("✅ Tin nhắn gửi thành công:", data))
              .catch(error => console.error("❌ Lỗi khi gửi tin nhắn:", error));
        });
    });
</script>
@endsection

<!-- CSS -->
<style>
    .messages {
        max-height: 300px;
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #ddd;
    }

    .message {
        padding: 5px;
        margin: 5px 0;
        border-radius: 5px;
    }

    .admin-message {
        background: #007bff;
        color: white;
        text-align: right;
    }

    .user-message {
        background: #f1f1f1;
        text-align: left;
    }
</style>