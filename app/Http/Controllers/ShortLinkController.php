<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class ShortLinkController extends Controller
{
    /**
     * Menyimpan short link baru ke database, dengan opsi custom code dan QR code.
     */
    public function store(Request $request)
    {
        $request->validate([
            'input' => 'required|url',
            'custom_code' => 'nullable|regex:/^[a-zA-Z0-9]+$/|unique:short_links,code|min:3|max:100',
            'expiry_time' => 'required|in:1,3,6,12,24',
            'encrypt' => 'nullable|boolean', // opsi enkripsi
        ]);

        $clientIP = $request->ip();
        $shortCode = $request->filled('custom_code') ? $request->custom_code : Str::random(6);
        $shortenedUrl = url('short-link/' . $shortCode);
        $expiredAt = now()->addHours((int) $request->input('expiry_time'));

        $originalLink = $request->input('input');
        $encrypt = $request->boolean('encrypt', false);

        if ($encrypt) {
            $encryptedLink = encrypt($originalLink);
            $linkToStore = null;  // kosongkan link biasa
        } else {
            $encryptedLink = null;
            $linkToStore = $originalLink;
        }

        $qrCodeBase64 = null;
        if ($request->has('generate_qr')) {
            $result = Builder::create()
                ->data($shortenedUrl)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->build();

            $qrCodeBase64 = base64_encode($result->getString());
        }

        $shortLink = ShortLink::create([
            'link' => $linkToStore,
            'encrypted_link' => $encryptedLink,
            'code' => $shortCode,
            'creator_ip' => $clientIP,
            'expired_at' => $expiredAt,
            'qr_code' => $qrCodeBase64,
            'hits' => 0,
        ]);

        return response()->json([
            'success' => 'Short link generated!',
            'link' => $shortenedUrl,
            'qr_code' => $qrCodeBase64 ? 'data:image/png;base64,' . $qrCodeBase64 : null,
        ]);
    }

    /**
     * Redirect ke link asli berdasarkan kode.
     */
    public function shortenLink($code)
    {
        $shortLink = ShortLink::where('code', $code)->first();

        if (!$shortLink) {
            return response()->json(['error' => 'Short link not found'], 404);
        }

        if ($shortLink->expired_at && now()->greaterThanOrEqualTo($shortLink->expired_at)) {
            return response()->json(['error' => 'Link has expired'], 410);
        }

        // Jika link terenkripsi, decrypt dulu, kalau tidak pakai link biasa
        if ($shortLink->encrypted_link) {
            try {
                $originalUrl = decrypt($shortLink->encrypted_link);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Link is corrupted or invalid'], 500);
            }
        } else {
            $originalUrl = $shortLink->link;
        }

        $shortLink->increment('hits');

        return redirect()->away($originalUrl);
    }
}
