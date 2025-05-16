<?php

namespace App\Http\Controllers\Admin;

use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReportVerificationController extends Controller
{
    /**
     * Verify a report item.
     *
     * @param Request $request
     * @param string $type
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $type, $slug)
    {
        if ($type === 'lost') {
            $item = LostItem::where('slug', $slug)->firstOrFail();
            $item->status = 'hilang';
            $item->save();

            // Send WhatsApp notification
            $this->sendWhatsAppNotification(
                $item->userphone,
                "Halo {$item->username}!\nLaporan kehilangan kamu dengan judul \"{$item->title}\" sudah diverifikasi.\nTim kami akan menampilkannya di halaman pencarian supaya lebih mudah ditemukan.\nTerima kasih sudah melapor!"
            );

            return redirect()->route('verify')->with('success', 'Lost item report has been verified successfully');
        } else if ($type === 'found') {
            $item = FoundItem::where('slug', $slug)->firstOrFail();
            $item->status = 'disimpan';
            $item->save();

            return redirect()->route('verify')->with('success', 'Found item report has been verified successfully');
        }

        return redirect()->route('verify')->with('error', 'Invalid report type');
    }

    /**
     * Decline a report item.
     *
     * @param Request $request
     * @param string $type
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, $type, $slug)
    {
        $request->validate([
            'reason' => 'required|string|min:5',
        ]);

        $reason = $request->input('reason');

        if ($type === 'lost') {
            $item = LostItem::where('slug', $slug)->firstOrFail();

            // Send WhatsApp notification before deletion
            $this->sendWhatsAppNotification(
                $item->userphone,
                "Hai {$item->username}, Maaf, laporan kehilangan kamu dengan judul \"{$item->title}\" tidak dapat kami verifikasi.\nAlasan: {$reason} Silakan periksa kembali data laporanmu dan ajukan ulang jika diperlukan. Terima kasih atas pengertiannya!"
            );

            // Delete photo if exists
            if ($item->photo && $item->photo !== 'storage/lost-images/placeholder.png') {
                // Menghapus 'storage/' dari path dan menggunakan storage public
                $photoPath = str_replace('storage/', 'public/', $item->photo);

                Log::info('Attempting to delete lost item photo', ['original_path' => $item->photo, 'storage_path' => $photoPath]);

                if (Storage::exists($photoPath)) {
                    Storage::delete($photoPath);
                    Log::info('Photo deleted successfully', ['path' => $photoPath]);
                } else {
                    Log::warning('Photo not found for deletion', ['original_path' => $item->photo, 'storage_path' => $photoPath]);
                }
            }

            // Hard delete the item
            $item->forceDelete();

            return response()->json(['success' => true, 'message' => 'Lost item report has been declined and deleted']);
        } else if ($type === 'found') {
            $item = FoundItem::where('slug', $slug)->firstOrFail();

            // Delete photo if exists
            if ($item->photo && $item->photo !== 'storage/found-images/placeholder.png') {
                // Menghapus 'storage/' dari path dan menggunakan storage public
                $photoPath = str_replace('storage/', 'public/', $item->photo);

                Log::info('Attempting to delete found item photo', ['original_path' => $item->photo, 'storage_path' => $photoPath]);

                if (Storage::exists($photoPath)) {
                    Storage::delete($photoPath);
                    Log::info('Photo deleted successfully', ['path' => $photoPath]);
                } else {
                    Log::warning('Photo not found for deletion', ['original_path' => $item->photo, 'storage_path' => $photoPath]);
                }
            }

            // Hard delete the item
            $item->forceDelete();

            return response()->json(['success' => true, 'message' => 'Found item report has been declined and deleted']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid report type'], 400);
    }

    /**
     * Send WhatsApp notification using Fonnte API.
     *
     * @param string $phone
     * @param string $message
     * @return void
     */
    private function sendWhatsAppNotification($phone, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message
            ]);

            // Log the response or handle errors if needed
            if (!$response->successful()) {
                Log::error('WhatsApp notification failed', [
                    'phone' => $phone,
                    'response' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp notification error', [
                'phone' => $phone,
                'error' => $e->getMessage()
            ]);
        }
    }
}
