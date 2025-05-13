<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LostItem;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class LostItemController extends Controller
{
    public function index()
    {
        // Check if data has been updated
        $lastUpdated = Cache::get('lost_items_updated', 0);
        $cacheKey = 'lost_items_' . (request()->page ?? 1) . '_' . $lastUpdated;

        // Track this key for later clearing
        $keys = Cache::get('cached_keys_lost_items', []);
        if (!in_array($cacheKey, $keys)) {
            $keys[] = $cacheKey;
            Cache::put('cached_keys_lost_items', $keys, now()->addDays(30));
        }

        $lostItems = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return LostItem::with(['category', 'class'])
                ->where('status', '!=', 'diproses')
                ->latest()
                ->paginate(20)
                ->withQueryString();
        });

        return view('user.lost-items.index', compact('lostItems'));
    }

    public function create()
    {
        // Don't use cache when displaying form
        $categories = Category::where('status', 'active')->get();
        $classes = ClassModel::where('status', 'active')->get();

        return view('user.lost-items.create', compact('categories', 'classes'));
    }

    public function store(Request $request)
    {
        // Custom validation messages
        $messages = [
            'username.required' => 'Nama pelapor harus diisi.',
            'username.max' => 'Nama pelapor maksimal 255 karakter.',
            'userphone.required' => 'Nomor telepon harus diisi.',
            'userphone.max' => 'Nomor telepon maksimal 20 karakter.',
            'userphone.regex' => 'Nomor telepon harus dimulai dengan 62 dan berisi angka.',
            'class_id.required' => 'Kelas harus dipilih.',
            'title.required' => 'Nama barang harus diisi.',
            'title.max' => 'Nama barang maksimal 255 karakter.',
            'last_location.required' => 'Lokasi terakhir harus diisi.',
            'last_location.max' => 'Lokasi terakhir maksimal 255 karakter.',
            'lost_date.required' => 'Tanggal kehilangan harus diisi.',
            'lost_date.date' => 'Tanggal kehilangan harus berupa tanggal yang valid.',
            'lost_date.after_or_equal' => 'Tanggal kehilangan tidak boleh lebih dari 3 tahun yang lalu.',
            'description.required' => 'Deskripsi barang harus diisi.',
            'category_id.required' => 'Kategori barang harus dipilih.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];

        // Validation
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'userphone' => [
                'required',
                'string',
                'max:20',
                'regex:/^62\d+$/'
            ],
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'last_location' => 'required|string|max:255',
            'lost_date' => 'required|date|after_or_equal:' . now()->subYears(3)->format('Y-m-d'),
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian formulir.');
        }

        // Gambar default jika user tidak mengupload foto
        $photoPath = 'lost-images/placeholder.png';

        // Simpan gambar jika ada upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('lost-images', $filename, 'public');
        }

        LostItem::create([
            'username' => $request->username,
            'userphone' => $request->userphone,
            'class_id' => $request->class_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'last_location' => $request->last_location,
            'lost_date' => $request->lost_date,
            'description' => $request->description,
            'photo' => 'storage/' . $photoPath,
            'category_id' => $request->category_id,
        ]);

        // Clear related caches
        $this->clearAllCaches();

        return redirect()->route('home')->with('success', 'Laporan barang hilang berhasil dikirim!');
    }

    public function show($slug)
    {
        // Track single item cache keys
        $cacheKey = 'lost_item_' . $slug;
        $keys = Cache::get('cached_keys_lost_item', []);
        if (!in_array($cacheKey, $keys)) {
            $keys[] = $cacheKey;
            Cache::put('cached_keys_lost_item', $keys, now()->addDays(30));
        }

        $lostItem = Cache::remember($cacheKey, now()->addHours(1), function () use ($slug) {
            return LostItem::with(['class', 'category'])
                ->where('slug', $slug)
                ->where('status', '!=', 'diproses')
                ->firstOrFail();
        });

        return view('user.lost-items.show', compact('lostItem'));
    }

    /**
     * Clear all related caches when data changes
     */
    private function clearAllCaches()
    {
        // Clear all lost items pages cache
        $keys = Cache::get('cached_keys_lost_items', []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }

        // Clear all individual item caches
        $singleItemKeys = Cache::get('cached_keys_lost_item', []);
        foreach ($singleItemKeys as $key) {
            Cache::forget($key);
        }

        // Clear all search result caches
        $searchKeys = Cache::get('cached_keys_search', []);
        foreach ($searchKeys as $key) {
            Cache::forget($key);
        }

        // Force refresh of listing pages next time they're accessed
        Cache::put('lost_items_updated', time(), now()->addDays(30));

        // Also clear found items timestamp to sync with home page
        Cache::put('found_items_updated', time(), now()->addDays(30));

        // Clear home page cache to ensure new items appear
        Cache::forget('home_found_items');
    }
}
