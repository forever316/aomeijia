<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdatePrice::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $date = date('Y-m-d');
        $filePath = "D:\phpstudy\PHPTutorial\WWW\getrich\storage\logs\{$date}\updatePrice.log";
        $schedule->command('update:price')->everyMinute()->appendOutputTo($filePath)->name('update_Price')->withoutOverlapping();
    }
}
