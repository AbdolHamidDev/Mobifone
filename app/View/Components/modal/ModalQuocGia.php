<?php

namespace App\View\Components\modal;

use Illuminate\View\Component;

class ModalQuocGia extends Component
{
    public $id;
    public $title;

    public function __construct($id = 'modal-quoc-gia', $title = 'Thêm Quốc Gia')
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.modal.quocgia.quoc-gia');
    }
}
