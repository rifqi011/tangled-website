<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    public function create() {
        $categories = Category::where('status', 'active')->get();
        return view('lost-items.create', compact('categories'));
    }
}
