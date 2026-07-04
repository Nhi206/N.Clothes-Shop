<?php

namespace App\Console;

use App\Console\Commands\CleanupExpiredDesigns;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CleanupExpiredDesigns::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('design:cleanup')->daily();
    }
}
