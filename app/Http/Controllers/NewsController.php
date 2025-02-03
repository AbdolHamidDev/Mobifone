<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;


class NewsController extends Controller
{
    // Danh sách tin tức theo danh mục
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.tintuc.danhsach', compact('news'));
    }

    // Chi tiết bài viết
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }

    // Form thêm bài viết
    public function create()
    {
        return view('admin.tintuc.them');
    }

    // Lưu bài viết
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:tin-khuyen-mai,tin-tuc-su-kien,thong-cao-bao-chi',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image')?->store('news', 'public');

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('news.index', $request->category)->with('success', 'Bài viết đã được thêm.');
    }

    // Form chỉnh sửa bài viết
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.tintuc.sua', compact('news'));
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:tin-khuyen-mai,tin-tuc-su-kien,thong-cao-bao-chi',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image')?->store('news', 'public') ?? $news->image;

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index', $news->category)->with('success', 'Bài viết đã được cập nhật.');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return back()->with('success', 'Bài viết đã được xóa.');
    }


    public function kiemDuyet($id)
    {
        $news = News::findOrFail($id);
        $news->kiemduyet = !$news->kiemduyet; // Đổi trạng thái kiểm duyệt
        $news->save();
    
        return redirect()->route('news.index')->with('success', 'Trạng thái kiểm duyệt đã được cập nhật.');
    }
    
    public function kichHoat($id)
    {
        $news = News::findOrFail($id);
        $news->kichhoat = !$news->kichhoat; // Đổi trạng thái kích hoạt
        $news->save();
    
        return redirect()->route('news.index')->with('success', 'Trạng thái kích hoạt đã được cập nhật.');
    }

}

