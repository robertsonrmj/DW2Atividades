<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tablelist extends Component{
    public $header;
    public $data;

    public function __construct($header,$data){
        $this->header = $header;
        $this->data = $data;
    }

    
    public function render()
    {
        return view('components.tablelist');
    }
}