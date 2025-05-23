<?php

namespace App\Http\Controllers\Admin;

use App\Models\LostItem;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use App\Http\Controllers\Controller;

class LostItemFoundController extends Controller
{
    protected $whatsAppService;

    /**
     * Create a new controller instance.
     *
     * @param WhatsAppService $whatsAppService
     * @return void
     */
    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $perPage = 20;

        $lostItems = LostItem::with(['class', 'category'])
            ->where('status', 'hilang')
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

        return view('admin.lostitemsfound.index', compact('lostItems', 'search'));
    }

    public function show($slug)
    {
        $item = $this->getItem($slug);

        return view('admin.lostitemsfound.show', compact('item'));
    }

    public function found(Request $request, $slug)
    {
        $item = LostItem::where('slug', $slug)->firstOrFail();
        $item->status = 'disimpan';
        $item->save();

        $this->whatsAppService->sendNotification(
            $item->userphone,
            "Kabar baik, {$item->username}!\nBarang kamu yang hilang dengan judul \"{$item->title}\" sudah ditemukan dan bisa langsung diambil di ruang Kesiswaan.\nSilakan konfirmasi waktu pengambilan atau hubungi tim kami jika ada pertanyaan. Terima kasih!"
        );

        return redirect()->route('lost-item-found')->with('success', 'Item has been marked as found.');
    }

    private function getItem($slug)
    {
        return LostItem::with(['class', 'category'])
            ->where('slug', $slug)
            ->where('status', 'hilang')
            ->firstOrFail();
    }
}
