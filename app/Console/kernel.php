<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Tambahkan use Command kamu di sini
use App\Console\Commands\DeleteExpiredLinks;

class Kernel extends ConsoleKernel
{
    /**
     * Daftarkan command buatan sendiri di sini.
     */
    protected $commands = [
        DeleteExpiredLinks::class,
    ];

    /**
     * Jadwalkan perintah untuk dijalankan secara berkala.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Hapus link yang sudah expired tiap jam
        $schedule->command('links:delete-expired')->hourly();
    }

    /**
     * Daftarkan perintah artisan untuk aplikasi.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
