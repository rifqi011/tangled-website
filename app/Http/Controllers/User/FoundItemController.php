<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoundItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class FoundItemController extends Controller
{
    public function index()
    {
        $cacheKey = 'found_items_' . request()->page ?? 1;

        $foundItems = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return FoundItem::with('category')
                ->where('status', 'disimpan')
                ->latest()
                ->paginate(20)
                ->withQueryString();
        });

        return view('user.found-items.index', compact('foundItems'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();

        return view('user.found-items.create', compact('categories'));
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

        // Simpan ke database
        FoundItem::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'found_location' => $request->found_location,
            'found_date' => $request->found_date,
            'description' => $request->description,
            'photo' => 'storage/' . $photoPath,
            'category_id' => $request->category_id,
        ]);

        // Clear related caches after adding new item
        $this->clearAllCaches();

        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show($slug)
    {
        $foundItem = FoundItem::with('category')
            ->where('slug', $slug)
            ->where('status', '!=', 'diproses')
            ->firstOrFail();

        return view('user.found-items.show', compact('foundItem'));
    }

    /**
     * Clear all related caches when data changes
     */
    private function clearAllCaches()
    {
        // Clear all found items pages cache
        $keys = Cache::get('cached_keys_found_items', []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }

        // Clear home page cache
        Cache::forget('home_found_items');

        // Clear all individual item caches
        $singleItemKeys = Cache::get('cached_keys_found_item', []);
        foreach ($singleItemKeys as $key) {
            Cache::forget($key);
        }

        // Clear all search result caches
        $searchKeys = Cache::get('cached_keys_search', []);
        foreach ($searchKeys as $key) {
            Cache::forget($key);
        }

        // Force refresh of home page and listing pages
        Cache::put('found_items_updated', time(), now()->addDays(30));
    }
}
