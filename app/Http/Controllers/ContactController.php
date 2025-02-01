<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
{
    $contacts = Contact::paginate(10); // Lấy 10 liên hệ mỗi trang
    return view('admin.lienhe.index', compact('contacts')); // Truyền dữ liệu vào view
}


    // Lưu thông tin liên hệ
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'phone' => 'required|string|max:15',
        'reason' => 'nullable|string|max:255',
        'message' => 'required|string|max:2000', // Thêm validate cho nội dung
    ]);

    Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'reason' => $request->reason,
        'message' => $request->message, // Lưu nội dung
        'status' => false, // Mặc định chưa liên hệ
    ]);

    return back()->with('success', 'Thông tin liên hệ đã được gửi thành công!');
}


    // Cập nhật trạng thái liên hệ
    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = true; // Đánh dấu là đã liên hệ
        $contact->save();

        return back()->with('success', 'Trạng thái liên hệ đã được cập nhật!');
    }
}
