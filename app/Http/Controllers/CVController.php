<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;

class CVController extends Controller
{
    public function index(Request $request)
    {
        $nganhNghe = $request->input('nganh_nghe');
        $query = CV::query();
    
        if ($nganhNghe) {
            $query->where('ngành_nghề', 'LIKE', '%' . $nganhNghe . '%');
        }
    
        $cvList = $query->paginate(10);
        $nganhNgheList = CV::select('ngành_nghề')->distinct()->pluck('ngành_nghề');
    
        if ($request->ajax()) {
            return view('admin.cv.cv-list', compact('cvList'))->render();
        }
    
        return view('admin.cv.index', compact('cvList', 'nganhNgheList'));
    }
    
    
    
    

public function create()
    {
        return view('frontend.gioithieu.cv'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'họ_và_tên' => 'required|string|max:255',
            'cv_hồ_sơ' => 'required|file|mimes:pdf|max:2048',
            'trình_độ' => 'required|string|max:255',
            'email' => 'required|email|unique:cv',
            'số_điện_thoại' => 'required|string|max:15',
            'trường_học' => 'required|string|max:255',
            'ngành_nghề' => 'required|string|max:255',
            'biết_thông_tin_từ_đâu' => 'nullable|string|max:255',
            'tóm_tắt_kinh_nghiệm' => 'nullable|string',
        ]);
    
        $filePath = $request->file('cv_hồ_sơ')->store('uploads/cv', 'public');
    
        CV::create([
            'họ_và_tên' => $request->họ_và_tên,
            'cv_hồ_sơ' => $filePath,
            'trình_độ' => $request->trình_độ,
            'email' => $request->email,
            'số_điện_thoại' => $request->số_điện_thoại,
            'trường_học' => $request->trường_học,
            'ngành_nghề' => $request->ngành_nghề,
            'biết_thông_tin_từ_đâu' => $request->biết_thông_tin_từ_đâu,
            'tóm_tắt_kinh_nghiệm' => $request->tóm_tắt_kinh_nghiệm,
        ]);
    
        return redirect()->back()->with('success', 'CV đã được gửi thành công!');
    }
    
    

    public function markAsSeen($id)
{
    $cv = CV::findOrFail($id);
    if (!$cv->đã_xem) { // Chỉ đánh dấu nếu chưa xem
        $cv->đã_xem = true;
        $cv->save();
    }

    return redirect()->route('cv.index')->with('success', 'CV đã được đánh dấu là đã xem.');
}

public function markAsApproved($id)
{
    $cv = CV::findOrFail($id);
    if (!$cv->đã_duyệt) { // Chỉ đánh dấu nếu chưa duyệt
        $cv->đã_duyệt = true;
        $cv->save();
    }

    return redirect()->route('cv.index')->with('success', 'CV đã được đánh dấu là đã duyệt.');
}

}
