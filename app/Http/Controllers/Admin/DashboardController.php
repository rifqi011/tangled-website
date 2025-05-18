<?php

namespace App\Http\Controllers\Admin;

use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Retrieval;

class DashboardController extends Controller
{
    public function index()
    {
        // Count total items
        $totalReports = LostItem::count() + FoundItem::count();
        $totalUnverifiedReports = LostItem::where('status', 'diproses')->count()
            + FoundItem::where('status', 'diproses')->count();
        $totalRetrievals = Retrieval::count();
        $totalLostItemsFound = LostItem::where('status', 'disimpan')->count();

        // Get 5 most recent items
        $recentLostItems = LostItem::with('class')->latest()->take(5)->get();
        $recentFoundItems = FoundItem::latest()->take(5)->get();

        // Get top 5 classes with most reports (lost items)
        $topClassesLost = LostItem::select('name', DB::raw('count(*) as total'))
            ->join('classes', 'lost_items.class_id', '=', 'classes.id')
            ->groupBy('class_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // Get top 5 categories with most reports (lost items and found items)
        $topCategoriesReported = Category::all()->sortByDesc(function ($category) {
            return LostItem::where('category_id', $category->id)->count()
                + FoundItem::where('category_id', $category->id)->count();
        })->take(5);

        return view('admin.dashboard', compact(
            'totalReports',
            'totalUnverifiedReports',
            'totalRetrievals',
            'totalLostItemsFound',
            'recentLostItems',
            'recentFoundItems',
            'topClassesLost',
            'topCategoriesReported'
        ));
    }
}
