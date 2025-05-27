<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShortLink;
use Carbon\Carbon;

class DeleteExpiredLinks extends Command
{
    protected $signature = 'links:delete-expired';
    protected $description = 'Hapus semua link yang sudah expired';

    public function handle()
    {
        $deleted = ShortLink::where('expired_at', '<', Carbon::now())->delete();

        $this->info("Berhasil menghapus $deleted link yang sudah kadaluarsa.");
    }
}
