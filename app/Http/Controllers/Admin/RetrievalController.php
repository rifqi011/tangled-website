<?php

namespace App\Http\Controllers\Admin;

use App\Models\FoundItem;
use App\Models\Retrieval;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RetrievalController extends Controller
{
    public function index()
    {
        $foundItems = FoundItem::with('category')
            ->where('status', 'disimpan')
            ->latest('found_date')
            ->get();

        return view('admin.retrieval.index', compact('foundItems'));
    }

    public function show($slug)
    {
        $item = FoundItem::with('category')
            ->where('slug', $slug)
            ->where('status', 'disimpan')
            ->firstOrFail();

        return view('admin.retrieval.show', compact('item'));
    }
    public function create($slug)
    {
        $item = FoundItem::with('category')
            ->where('slug', $slug)
            ->where('status', 'disimpan')
            ->firstOrFail();

        $classes = ClassModel::all();

        if ($item->status === 'disimpan') {
            return view('admin.retrieval.create', compact('item', 'classes'));
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'found_item_id' => 'required|exists:found_items,id',
            'username' => 'required|string|max:255',
            'userphone' => 'required|string|max:20',
            'class_id' => 'required|exists:classes,id',
            'retrieval_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the retrieval record
        $retrieval = Retrieval::create([
            'found_item_id' => $request->found_item_id,
            'username' => $request->username,
            'userphone' => $request->userphone,
            'class_id' => $request->class_id,
            'retrieval_date' => $request->retrieval_date ?? now(),
            'notes' => $request->notes,
        ]);

        // Update the found item status to 'diambil'
        $foundItem = FoundItem::findOrFail($request->found_item_id);
        $foundItem->update(['status' => 'diambil']);

        return redirect()->route('retrieval')
            ->with('success', 'Item successfully retrieved by ' . $request->username);
    }
}
