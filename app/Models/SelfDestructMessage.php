<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfDestructMessage extends Model
{
    use HasFactory;

    // Daftar kolom yang bisa diisi massal (mass assignment)
    // Supaya Laravel bisa langsung simpan data tanpa error
    protected $fillable = ['code', 'message'];
}
