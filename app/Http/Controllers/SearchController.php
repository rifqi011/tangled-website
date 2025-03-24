<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->get();

        $items = DB::table('lost_items')
            ->select('id', 'title', 'slug', 'description', 'photo', 'status', 'lost_date as date', 'last_location as location', DB::raw("'lost' as type"))
            ->where('status', '!=', 'diproses')
            ->union(
                DB::table('found_items')
                    ->select('id', 'title', 'slug', 'description', 'photo', 'status', 'found_date as date', 'found_location as location', DB::raw("'found' as type"))
                    ->where('status', '!=', 'diproses')
            )
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();

        return view('search', compact(['categories', 'items']));
    }
}
