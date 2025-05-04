<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('layouts.admin.guest');
    }
}
