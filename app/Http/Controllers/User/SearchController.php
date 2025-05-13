<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Generate a cache key based on request parameters and latest update timestamps
        $query = $request->input('query', '');
        $category = $request->input('category', 'Semua');
        $lastFoundUpdate = Cache::get('found_items_updated', 0);
        $lastLostUpdate = Cache::get('lost_items_updated', 0);
        $lastUpdate = max($lastFoundUpdate, $lastLostUpdate);

        $cacheKey = 'search_results_' . md5($query . '_' . $category . '_' . $lastUpdate);

        // Track this key for later clearing
        $keys = Cache::get('cached_keys_search', []);
        if (!in_array($cacheKey, $keys)) {
            $keys[] = $cacheKey;
            Cache::put('cached_keys_search', $keys, now()->addDays(30));
        }

        // Fetch active categories (don't use cache here to ensure we get latest)
        $categories = Category::where('status', 'active')->get();

        // Get search results with caching
        $items = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($request, $query, $category) {
            // Get category ID if a specific category is selected
            $categoryId = null;
            if ($category !== 'Semua') {
                $categoryModel = Category::where('name', $category)->first();
                $categoryId = $categoryModel->id ?? null;
            }

            // Create optimized subqueries using Eloquent instead of DB facade
            $lostItemsQuery = LostItem::select([
                'id',
                'title',
                'slug',
                'description',
                'photo',
                'status',
                DB::raw('lost_date as date'),
                DB::raw('last_location as location'),
                DB::raw("'lost' as type"),
                'category_id'
            ])
                ->where('status', '!=', 'diproses');

            $foundItemsQuery = FoundItem::select([
                'id',
                'title',
                'slug',
                'description',
                'photo',
                'status',
                DB::raw('found_date as date'),
                DB::raw('found_location as location'),
                DB::raw("'found' as type"),
                'category_id'
            ])
                ->where('status', '!=', 'diproses');

            // Apply text search if query is provided
            if (!empty($query)) {
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

            // Apply category filter if a specific category is selected
            if ($categoryId) {
                $lostItemsQuery->where('category_id', $categoryId);
                $foundItemsQuery->where('category_id', $categoryId);
            }

            // Convert to SQL for union
            $lostSql = $lostItemsQuery->toSql();
            $foundSql = $foundItemsQuery->toSql();

            // Merge bindings
            $bindings = array_merge(
                $lostItemsQuery->getBindings(),
                $foundItemsQuery->getBindings()
            );

            // Execute union query with proper ordering
            return DB::table(DB::raw("({$lostSql} UNION {$foundSql}) as items"))
                ->mergeBindings($lostItemsQuery->getQuery())
                ->mergeBindings($foundItemsQuery->getQuery())
                ->orderBy('date', 'desc')
                ->get();
        });

        return view('user.search', compact(['categories', 'items']));
    }
}
