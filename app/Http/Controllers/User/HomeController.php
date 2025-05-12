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
        // Check for updates before using cache
        $lastFoundUpdate = Cache::get('found_items_updated', 0);
        $lastLostUpdate = Cache::get('lost_items_updated', 0);
        $lastUpdate = max($lastFoundUpdate, $lastLostUpdate);

        $cacheKey = 'home_found_items_' . $lastUpdate;

        $foundItems = Cache::remember($cacheKey, now()->addMinutes(15), function () {
            return FoundItem::with('category')
                ->where('status', 'disimpan')
                ->latest()
                ->take(20)
                ->get();
        });

        $totalItems = FoundItem::where('status', 'disimpan')->count();
        $hasMoreItems = $totalItems > $foundItems->count();

        return view('user.home', compact('foundItems', 'hasMoreItems'));
    }
}
