<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FoundItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    public function index() {
        $foundItems = FoundItem::where('status', 'disimpan')->latest()->paginate(20)->withQueryString();

        return view('found-items.index', compact('foundItems'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('found-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'found_location' => 'required|string|max:255',
            'found_date' => 'required|date|after_or_equal:' . now()->subYears(3)->format('Y-m-d'),
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('found-images', 'public');
        }

        // Simpan ke database
        FoundItem::create([
            'title' => $request->title,
            'slug' => 'found-items/' . Str::slug($request->title) . '-' . time(),
            'found_location' => $request->found_location,
            'found_date' => $request->found_date,
            'description' => $request->description,
            'photo' => 'storage/' . $photoPath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim!');
    }
}
