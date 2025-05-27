<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'link',             // URL asli
        'encrypted_link',   // Link terenkripsi (opsional)
        'code',             // Kode unik untuk short link
        'creator_ip',       // IP pembuat
        'hits',             // Jumlah klik
        'expired_at',       // Expired time
        'qr_code',          // Base64 QR Code
    ];

    /**
     * Method boot digunakan untuk menambahkan behavior khusus saat model dibuat.
     */
    public static function boot()
    {
        parent::boot();

        // Saat model akan dibuat, pastikan 'code' belum digunakan
        static::creating(function ($model) {
            if (ShortLink::where('code', $model->code)->exists()) {
                throw new \Exception("Kode sudah dipakai, coba yang lain!");
            }
        });
    }
}
