<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FoundItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoundItemController extends Controller
{
    public function index()
    {
        $foundItems = FoundItem::whereIn('status', ['disimpan', 'diambil'])->latest()->paginate(20)->withQueryString();

        return view('found-items.index', compact('foundItems'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('found-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Custom validation messages
        $messages = [
            'title.required' => 'Nama barang harus diisi.',
            'title.max' => 'Nama barang maksimal 255 karakter.',
            'found_location.required' => 'Lokasi penemuan harus diisi.',
            'found_location.max' => 'Lokasi penemuan maksimal 255 karakter.',
            'found_date.required' => 'Tanggal penemuan harus diisi.',
            'found_date.date' => 'Tanggal penemuan harus berupa tanggal yang valid.',
            'found_date.after_or_equal' => 'Tanggal penemuan tidak boleh lebih dari 3 tahun yang lalu.',
            'description.required' => 'Deskripsi barang harus diisi.',
            'category_id.required' => 'Kategori barang harus dipilih.',
            'photo.required' => 'Gambar barang harus diunggah.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'found_location' => 'required|string|max:255',
            'found_date' => 'required|date|after_or_equal:' . now()->subYears(3)->format('Y-m-d'),
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian formulir.');
        }

        // Upload gambar jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('found-images', 'public');
        }

        // Simpan ke databas~e
        FoundItem::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'found_location' => $request->found_location,
            'found_date' => $request->found_date,
            'description' => $request->description,
            'photo' => 'storage/' . $photoPath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim!');
    }
}
