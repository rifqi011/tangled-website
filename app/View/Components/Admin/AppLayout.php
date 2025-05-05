<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('layouts.admin.app');
    }
}
