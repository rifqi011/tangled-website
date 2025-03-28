<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LostItem;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    public function index() {
        $lostItems = LostItem::where('status', '!=', 'diproses')->latest()->paginate(20)->withQueryString();

        return view('lost-items.index', compact('lostItems'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $classes = ClassModel::where('status', 'active')->get();
        return view('lost-items.create', compact('categories', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'userphone' => 'required|string|max:20',
            'class_id' => 'required|exists:classes,id',
            'last_location' => 'required|string|max:255',
            'lost_date' => 'required|date|after_or_equal:' . now()->subYears(3)->format('Y-m-d'),
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Gambar default jika user tidak mengupload foto
        $photoPath = 'storage/lost-images/placeholder.png';

        // Simpan gambar jika ada upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('lost-images', 'public');
        }

        LostItem::create([
            'username' => $request->username,
            'userphone' => $request->userphone,
            'class_id' => $request->class_id,
            'title' => $request->title,
            'slug' => 'lost-items/' . Str::slug($request->title) . '-' . time(),
            'last_location' => $request->last_location,
            'lost_date' => $request->lost_date,
            'description' => $request->description,
            'photo' => 'storage/' . $photoPath,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('home')->with('success', 'Laporan barang hilang berhasil dikirim!');
    }
}
