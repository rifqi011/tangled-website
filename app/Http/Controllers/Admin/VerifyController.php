<?php

namespace App\Http\Controllers\Admin;

use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    public function index()
    {
        $tab = request('tab', 'lost');
        $lostItems = LostItem::with(['class', 'category'])->where('status', 'diproses')->latest('lost_date')->get();
        $foundItems = FoundItem::with('category')->where('status', 'diproses')->latest('found_date')->get();

        return view('admin.verify.index', compact('lostItems', 'foundItems', 'tab'));
    }

    public function show($type, $slug)
    {
        $item = $this->getItem($type, $slug);
        return view('admin.verify.show', compact('item', 'type'));
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
}
