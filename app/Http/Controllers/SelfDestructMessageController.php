<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelfDestructMessage;
use Illuminate\Support\Str;

class SelfDestructMessageController extends Controller
{
    /**
     * Simpan pesan yang bakal self-destruct setelah dibaca.
     * Pesan dienkripsi dan disimpan dengan kode acak.
     */
    public function store(Request $request)
    {
        // Validasi input: field message harus ada dan bertipe string
        $request->validate([
            'message' => 'required|string',
        ]);

        // Generate kode unik sepanjang 8 karakter
        $code = Str::random(8);

        // Simpan pesan ke database dalam kondisi terenkripsi
        SelfDestructMessage::create([
            'code' => $code,
            'message' => encrypt($request->message), // Enkripsi supaya aman
        ]);

        // Kembalikan link akses ke pesan
        return response()->json([
            'link' => url('/self-destruct/' . $code),
        ]);
    }

    /**
     * Tampilkan pesan berdasarkan kode, dan langsung hapus setelah dibaca.
     */
    public function show($code)
    {
        // Cari pesan berdasarkan kode
        $message = SelfDestructMessage::where('code', $code)->first();

        // Kalau nggak ketemu, tampilkan pesan error
        if (!$message) {
            return view('self-destruct-message', ['message' => 'Pesan tidak ditemukan atau sudah dihapus.']);
        }

        // Dekripsi pesan
        $decryptedMessage = decrypt($message->message);

        // Tampilkan pesan yang sudah didekripsi ke user
        $view = view('self-destruct-message', ['message' => $decryptedMessage]);

        $message->delete();

        return $view;
    }
}
