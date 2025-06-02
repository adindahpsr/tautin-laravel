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
        $message = SelfDestructMessage::where('code', $code)->first();

        // If the message doesn't exist, show an error
        if (!$message) {
            return view('self-destruct-message', ['message' => 'Message not found or already deleted.']);
        }

        try {
            // Decrypt the message
            $decryptedMessage = decrypt($message->message);

            // Delete the message after retrieval
            $message->delete();

            // Display the decrypted message
            return view('self-destruct-message', ['message' => $decryptedMessage]);
        } catch (\Exception $e) {
            // If decryption fails or any other error occurs, don't delete the message
            return view('self-destruct-message', ['message' => 'An error occurred while retrieving the message.']);
        }
    }
}
