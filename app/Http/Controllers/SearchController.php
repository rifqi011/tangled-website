<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        $categories = Category::where('status', 'active')->get();

        return view('search', compact('categories'));
    }
}
