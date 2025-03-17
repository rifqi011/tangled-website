<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('found-items.create', compact('categories'));
    }
}
