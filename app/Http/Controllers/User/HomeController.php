<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $foundItems = FoundItem::with('category')
            ->where('status', 'disimpan')
            ->latest()
            ->take(20)
            ->get();

        $totalItems = FoundItem::where('status', 'disimpan')->count();
        $hasMoreItems = $totalItems > $foundItems->count();

        return view('user.home', compact('foundItems', 'hasMoreItems'));
    }
}
