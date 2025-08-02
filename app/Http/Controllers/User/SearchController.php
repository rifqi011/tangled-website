<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $category = $request->input('category', 'Semua');
        $itemType = $request->input('item_type', 'Semua');
        $startDate = $request->input('start_date', '');
        $endDate = $request->input('end_date', '');

        // Fetch active categories
        $categories = Category::where('status', 'active')->get();

        // Get category ID if a specific category is selected
        $categoryId = null;
        if ($category !== 'Semua') {
            $categoryModel = Category::where('name', $category)->first();
            $categoryId = $categoryModel->id ?? null;
        }

        $results = collect();

        // Create optimized subqueries using Eloquent instead of DB facade
        if ($itemType === 'Semua' || $itemType === 'lost') {
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

            // Apply text search if query is provided
            if (!empty($query)) {
                $lostItemsQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('last_location', 'like', "%{$query}%");
                });
            }

            // Apply category filter if a specific category is selected
            if ($categoryId) {
                $lostItemsQuery->where('category_id', $categoryId);
            }

            // Apply date range filter
            if (!empty($startDate)) {
                $lostItemsQuery->whereDate('lost_date', '>=', $startDate);
            }
            if (!empty($endDate)) {
                $lostItemsQuery->whereDate('lost_date', '<=', $endDate);
            }

            if ($itemType === 'lost') {
                $items = $lostItemsQuery->orderBy('lost_date', 'desc')->get();
                return view('user.search', compact(['categories', 'items']));
            }
        }

        if ($itemType === 'Semua' || $itemType === 'found') {
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
                $foundItemsQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('found_location', 'like', "%{$query}%");
                });
            }

            // Apply category filter if a specific category is selected
            if ($categoryId) {
                $foundItemsQuery->where('category_id', $categoryId);
            }

            // Apply date range filter
            if (!empty($startDate)) {
                $foundItemsQuery->whereDate('found_date', '>=', $startDate);
            }
            if (!empty($endDate)) {
                $foundItemsQuery->whereDate('found_date', '<=', $endDate);
            }

            if ($itemType === 'found') {
                $items = $foundItemsQuery->orderBy('found_date', 'desc')->get();
                return view('user.search', compact(['categories', 'items']));
            }
        }

        // If showing both types, use union query
        if ($itemType === 'Semua') {
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

            // Apply date range filter
            if (!empty($startDate)) {
                $lostItemsQuery->whereDate('lost_date', '>=', $startDate);
                $foundItemsQuery->whereDate('found_date', '>=', $startDate);
            }
            if (!empty($endDate)) {
                $lostItemsQuery->whereDate('lost_date', '<=', $endDate);
                $foundItemsQuery->whereDate('found_date', '<=', $endDate);
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
            $items = DB::table(DB::raw("({$lostSql} UNION {$foundSql}) as items"))
                ->mergeBindings($lostItemsQuery->getQuery())
                ->mergeBindings($foundItemsQuery->getQuery())
                ->orderBy('date', 'desc')
                ->get();
        } else {
            $items = collect();
        }

        return view('user.search', compact(['categories', 'items']));
    }
}
