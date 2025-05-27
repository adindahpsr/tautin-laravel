<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OneTimeLink;
use Illuminate\Support\Str;

class OneTimeLinkController extends Controller
{
    /**
     * Menyimpan one-time link dengan opsi enkripsi.
     */
    public function store(Request $request)
{
    $request->validate([
        'input' => 'required|url',
        'custom_code' => 'nullable|regex:/^[a-zA-Z0-9]+$/|unique:one_time_links,code|min:3|max:15',
        'encrypt' => 'nullable|boolean',
    ]);

    $clientIP = $request->ip();
    $shortCode = $request->filled('custom_code') ? $request->custom_code : Str::random(10);
    $shortenedUrl = url('one-link/' . $shortCode);

    $originalLink = $request->input('input');
    // $encrypt = $request->boolean('encrypt_link', false);
    $encrypt = $request->input('encrypt_link') === '1';


    if ($encrypt) {
        $encryptedLink = encrypt($originalLink);
        $linkToStore = null;
    } else {
        $encryptedLink = null;
        $linkToStore = $originalLink;
    }

    $oneTimeLink = OneTimeLink::create([
        'link' => $linkToStore,
        'encrypted_link' => $encryptedLink,
        'code' => $shortCode,
        'creator_ip' => $clientIP,
        'is_used' => false,
    ]);

    return response()->json([
        'success' => 'One-Time Link Generated!',
        'link' => $shortenedUrl,
    ]);
}

    /**
     * Redirect sekali pakai, auto delete setelah digunakan.
     */
    public function redirect($code)
    {
        $oneTimeLink = OneTimeLink::where('code', $code)->first();

        if (!$oneTimeLink) {
            return response()->view('one-time', ['message' => 'One-time link not found'], 404);
        }

        if ($oneTimeLink->is_used) {
            return response()->view('one-time', ['message' => 'This link has already been used and is no longer valid.'], 410);
        }

        // Tandai sebagai digunakan
        $oneTimeLink->update(['is_used' => true]);

        // Ambil link (dari kolom biasa atau enkripsi)
        try {
            $redirectUrl = $oneTimeLink->encrypted_link
                ? decrypt($oneTimeLink->encrypted_link)
                : $oneTimeLink->link;
        } catch (\Exception $e) {
            return response()->view('one-time', ['message' => 'Link is corrupted or invalid.'], 500);
        }

        // Hapus setelah digunakan
        $oneTimeLink->delete();

        return redirect()->away($redirectUrl);
    }
}
