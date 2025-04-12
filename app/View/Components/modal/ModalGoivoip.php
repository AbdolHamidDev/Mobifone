<?php

namespace App\View\Components\modal;

use Illuminate\View\Component;
use App\Models\QuocGia;

class ModalGoivoip extends Component
{
    public $id, $title, $size, $quocGias;

    public function __construct($id = 'modal-goi-voip', $title = 'Thêm Mới Gói VoIP', $size = 'modal-lg')
    {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->quocGias = QuocGia::all(); // Truy vấn dữ liệu ngay tại đây
    }

    public function render()
    {
        return view('components.modal.goivoip.modal-goi-voip', ['quocGias' => $this->quocGias]);
    }
}
