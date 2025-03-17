<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $foundItems = FoundItem::where('status', 'disimpan')->latest()->take(20)->get();

        return view('home', compact('foundItems'));
    }
}
