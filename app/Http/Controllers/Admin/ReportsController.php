<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'lost');
        $search = $request->query('search', '');
        $perPage = 20;

        if ($tab === 'lost') {
            $lostItems = LostItem::with(['class', 'category'])
                ->when($search, function ($query) use ($search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
                })
                ->latest('lost_date')
                ->paginate($perPage)
                ->withQueryString();

            $foundItems = collect(); // Empty collection when on lost tab
        } else {
            $foundItems = FoundItem::with(['category', 'retrievals'])
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

            $lostItems = collect(); // Empty collection when on found tab
        }

        return view('admin.reports.index', compact('lostItems', 'foundItems', 'tab', 'search'));
    }

    public function show($type, $slug)
    {
        $item = $this->getItem($type, $slug);
        return view('admin.reports.show', compact('item', 'type'));
    }

    public function edit($type, $slug)
    {
        $item = $this->getItem($type, $slug);
        $categories = Category::all();
        $classes = ClassModel::all();

        return view('admin.reports.edit', [
            'item' => $item,
            'type' => $type,
            'categories' => $categories,
            'classes' => $classes,
            'statuses' => $this->getStatuses($type)
        ]);
    }

    public function update(Request $request, $type, $slug)
    {
        $item = $this->getItem($type, $slug);

        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in($this->getStatuses($type))],
        ]);

        $item->update($validated);

        return redirect()->route('reports')->with('success', 'Status updated successfully');
    }

    public function destroy($type, $slug)
    {
        if ($type === 'found') {
            $item = FoundItem::with('retrievals')->where('slug', $slug)->firstOrFail();

            if (!$item->retrievals->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete item with existing retrievals'
                ], 403);
            }
        }

        $item = $this->getItem($type, $slug);
        $item->delete();

        return response()->json(['success' => true]);
    }

    private function getItem($type, $slug)
    {
        if ($type === 'lost') {
            return LostItem::with(['class', 'category'])->where('slug', $slug)->firstOrFail();
        } elseif ($type === 'found') {
            return FoundItem::with('category')->where('slug', $slug)->firstOrFail();
        }

        abort(404);
    }

    private function getStatuses($type)
    {
        return $type === 'lost'
            ? ['diproses', 'hilang', 'disimpan', 'diambil']
            : ['diproses', 'disimpan', 'diambil'];
    }
}
