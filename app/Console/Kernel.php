<?php

namespace App\Console;

use App\Domains;
use App\Jobs\CheckServiceStatus;
use App\Jobs\ExpiringDomainsAlert;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            Domains::toExpire()->update(['payed' => 0]);
        })->everyThirtyMinutes();

        $schedule->job(new CheckServiceStatus)->everyThirtyMinutes();
        $schedule->job(new ExpiringDomainsAlert)->everyThirtyMinutes();
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
