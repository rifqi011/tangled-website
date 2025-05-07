<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function show($type, $id)
    {
        $item = $this->getItem($type, $id);
        return view('admin.reports.show', compact('item', 'type'));
    }

    public function edit($type, $id)
    {
        $item = $this->getItem($type, $id);
        $categories = Category::all();
        $classes = $type === 'lost' ? ClassModel::all() : null;
        return view('admin.reports.edit', compact('item', 'type', 'categories', 'classes'));
    }

    public function update(Request $request, $type, $id)
    {
        $item = $this->getItem($type, $id);

        $validated = $request->validate([
            'status' => 'required|in:diproses,disimpan,selesai' . ($type === 'lost' ? ',hilang' : ''),
            'category_id' => 'required|exists:categories,id',
            'class_id' => $type === 'lost' ? 'required|exists:classes,id' : 'nullable',
        ]);

        $item->update($validated);

        return redirect()->route('reports')->with('success', 'Report updated successfully');
    }

    public function destroy($type, $id)
    {
        $item = $this->getItem($type, $id);
        $item->delete();

        return response()->json(['success' => true]);
    }

    private function getItem($type, $id)
    {
        if ($type === 'lost') {
            return LostItem::with(['class', 'category'])->findOrFail($id);
        } elseif ($type === 'found') {
            return FoundItem::with('category')->findOrFail($id);
        }

        abort(404);
    }
}
