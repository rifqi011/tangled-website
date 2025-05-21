<?php

namespace App\Http\Controllers\Admin;

use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    public function index(Request $request)
    {
        $tab = request('tab', 'lost');
        $perPage = 20;
        $search = $request->query('search', '');

        if ($tab === 'lost') {

            $lostItems = LostItem::with(['class', 'category'])
                ->where('status', 'diproses')
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('last_location', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
                })
                ->latest('lost_date')
                ->paginate($perPage)
                ->withQueryString();

            $foundItems = collect();
        } else {
            $foundItems = FoundItem::with('category')
                ->where('status', 'diproses')
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('found_location', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
                })
                ->latest('found_date')
                ->paginate($perPage)
                ->withQueryString();

            $lostItems = collect();
        }

        return view('admin.verify.index', compact('lostItems', 'foundItems', 'tab', 'search'));
    }

    public function show($type, $slug)
    {
        $item = $this->getItem($type, $slug);
        return view('admin.verify.show', compact('item', 'type'));
    }

    private function getItem($type, $slug)
    {
        if ($type === 'lost') {
            return LostItem::with(['class', 'category'])
                ->where('slug', $slug)
                ->where('status', 'diproses')
                ->firstOrFail();
        } elseif ($type === 'found') {
            return FoundItem::with('category')
                ->where('slug', $slug)
                ->where('status', 'diproses')
                ->firstOrFail();
        }

        abort(404);
    }
}
