<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $foundItems = Cache::remember('home_found_items', now()->addMinutes(15), function () {
            return FoundItem::with('category')
                ->where('status', 'disimpan')
                ->latest()
                ->take(20)
                ->get();
        });

        return view('user.home', compact('foundItems'));
    }
}
