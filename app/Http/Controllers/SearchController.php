<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Fetch active categories
        $categories = Category::where('status', 'active')->get();

        // Base query for lost and found items
        $lostItemsQuery = DB::table('lost_items')
            ->select('id', 'title', 'slug', 'description', 'photo', 'status', 'lost_date as date', 'last_location as location', DB::raw("'lost' as type"), 'category_id');

        $foundItemsQuery = DB::table('found_items')
            ->select('id', 'title', 'slug', 'description', 'photo', 'status', 'found_date as date', 'found_location as location', DB::raw("'found' as type"), 'category_id');

        // Apply text search if query is provided
        if ($request->filled('query')) {
            $query = $request->input('query');
            $lostItemsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('last_location', 'like', "%{$query}%");
            });

            $foundItemsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('found_location', 'like', "%{$query}%");
            });
        }

        // Apply category filter if category is provided and not 'Semua'
        if ($request->filled('category') && $request->input('category') !== 'Semua') {
            $category = $request->input('category');
            $categoryId = Category::where('name', $category)->first()->id ?? null;

            if ($categoryId) {
                $lostItemsQuery->where('category_id', $categoryId);
                $foundItemsQuery->where('category_id', $categoryId);
            }
        }

        // Exclude 'diproses' status and combine queries
        $lostItemsQuery->where('status', '!=', 'diproses');
        $foundItemsQuery->where('status', '!=', 'diproses');

        $items = $lostItemsQuery->union($foundItemsQuery)
            ->orderBy('date', 'desc')
            ->get();

        return view('search', compact(['categories', 'items']));
    }
}
