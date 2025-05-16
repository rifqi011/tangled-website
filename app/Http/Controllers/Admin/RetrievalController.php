<?php

namespace App\Http\Controllers\Admin;

use App\Models\FoundItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetrievalController extends Controller
{
    public function index() {
        $foundItems = FoundItem::with('category')
            ->where('status', 'disimpan')
            ->latest('found_date')
            ->get();
        
        return view('admin.retrieval.index', compact('foundItems'));
    }

    public function show($slug) {
        $item = FoundItem::with('category')
            ->where('slug', $slug)
            ->where('status', 'disimpan')
            ->firstOrFail();

        return view('admin.retrieval.show', compact('item'));
    }
}
