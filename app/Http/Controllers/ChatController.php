<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageEvent;
use App\Events\MessageSent;

class ChatController extends Controller
{
    // 🟢 Hiển thị danh sách cuộc trò chuyện của người dùng dựa vào số điện thoại OTP
    public function index()
    {
        $phone = session('phone'); // Lấy số điện thoại từ session OTP
        $conversation = Conversation::where('phone', $phone)->with('messages')->first();

        return view('chat.index', compact('conversation', 'phone'));
    }

    // 🟢 Admin xem tất cả cuộc hội thoại có tin nhắn
    public function adminIndex()
    {
        $conversations = Conversation::has('messages')->get();
        return view('admin.chat.list', compact('conversations'));
    }

    // 🟢 Lấy tin nhắn trong cuộc hội thoại cho Admin
    public function getMessages($conversation_id)
    {
        $conversation = Conversation::with('messages')->findOrFail($conversation_id);
        return view('admin.chat.messages', compact('conversation'));
    }

    // 🟢 Người dùng gửi tin nhắn đến Admin
    public function sendMessage(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
        'message' => 'required|string'
    ]);

    $conversation = Conversation::firstOrCreate(['phone' => $request->phone]);

    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_phone' => $request->phone,
        'message' => $request->message,
        'is_read' => false
    ]);

    broadcast(new MessageSent($message))->toOthers(); // Phát sự kiện

    return response()->json(['message' => $message], 201);
}

    // 🟢 Admin gửi tin nhắn đến người dùng
    public function adminSendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string'
        ]);

        // Lấy cuộc trò chuyện
        $conversation = Conversation::findOrFail($request->conversation_id);

        // Lưu tin nhắn từ Admin
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_phone' => 'Admin',
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json(['message' => $message], 201);
    }

    // 🟢 Lấy tin nhắn của người dùng
    public function getUserMessages()
    {
        $phone = session('phone');

        if (!$phone) {
            return response()->json(['error' => 'Bạn chưa đăng nhập OTP!'], 403);
        }

        // Lấy cuộc trò chuyện của số điện thoại hiện tại
        $conversation = Conversation::where('phone', $phone)->with('messages')->first();

        return response()->json($conversation ? $conversation->messages : []);
    }

    // 🟢 Lấy tin nhắn của Admin
    public function getAdminMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->take(50)->get();
        return response()->json($messages);
    }
    
    public function show($id)
    {
        $conversation = Conversation::with('messages')->findOrFail($id);
    
        // Cập nhật tin nhắn chưa đọc thành "Đã xem"
        Message::where('conversation_id', $id)
               ->where('is_read', false)
               ->update(['is_read' => true]);
    
        // Cập nhật lại danh sách cuộc trò chuyện
        $conversations = Conversation::with(['messages' => function ($query) {
            $query->latest();
        }])->get();
    
        // Tính lại số tin nhắn chưa đọc
        foreach ($conversations as $conv) {
            $conv->unread_count = Message::where('conversation_id', $conv->id)
                                         ->where('is_read', false)
                                         ->count();
        }
    
        return view('admin.chat.messages', compact('conversation', 'conversations'));
    }
    
}
