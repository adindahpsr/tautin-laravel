<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimeLink extends Model
{
    use HasFactory;

    // Nama tabel di database (optional, tapi bagus buat eksplisit)
    protected $table = 'one_time_links';

    // Kolom-kolom yang boleh diisi secara mass-assignment (fillable)
    protected $fillable = [
        'link',
        'encrypted_link',
        'code',
        'creator_ip',
        'is_used',
    ];
}
