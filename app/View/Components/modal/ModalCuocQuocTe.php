<?php

namespace App\View\Components\modal;

use Illuminate\View\Component;

class ModalCuocQuocTe extends Component
{
    public $id, $title, $size;

    public function __construct($id = 'modal-cuoc-quoc-te', $title = 'Thêm Mới Cước Quốc Tế', $size = 'modal-lg')
    {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.modal.cuocquocte.modal-cuoc-quoc-te');
    }
}
