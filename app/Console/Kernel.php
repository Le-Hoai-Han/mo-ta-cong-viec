<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('gui-chuc-mung-sinh-nhat')->dailyAt('00:00');
        $schedule->command('gui-tong-hop-an-pham-mkt-noi-bo')->cron('0 9 5 * *');
        $schedule->command('gui-email-pr-cho-toan-nhan-vien')->cron('0 9 10 * *');
        $schedule->command('pr-bo-phan-kinh-doanh')->cron('0 9 15 * *');
        $schedule->command('gui-tong-hop-template-email-cho-nv')->cron('0 9 25 * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
