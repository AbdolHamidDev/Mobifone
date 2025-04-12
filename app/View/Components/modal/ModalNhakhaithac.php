<?php

namespace App\View\Components\modal;

use Illuminate\View\Component;

class ModalNhakhaithac extends Component
{
    public $id, $title, $size;

    public function __construct($id = 'modal-nhakhaithac', $title = 'Thêm Mới Nhà khai thác', $size = 'modal-lg')
    {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.modal.nhakhaithac.modal-nhakhaithac');
    }
}
