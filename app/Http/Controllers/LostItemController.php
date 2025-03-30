<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LostItem;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LostItemController extends Controller
{
    public function index()
    {
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

        return redirect()->route('home')->with('success', 'Laporan barang hilang berhasil dikirim!');
    }

    // show
    public function show($slug)
    {
        $lostItem = LostItem::with(['class', 'category'])
            ->where('slug', $slug)
            ->where('status', '!=', 'diproses')
            ->firstOrFail();

        return view('lost-items.show', compact('lostItem'));
    }
}
