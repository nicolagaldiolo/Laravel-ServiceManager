<?php

namespace App\Console;

use App\Service;
use App\Events\ToPayDomainsAlert;
use App\Events\GenerateScreen;
use App\Events\UserRegister;
use App\Events\CheckServiceStatus;
use App\Jobs\ToPayDomains;
use App\Provider;
use Carbon\Carbon;
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

        /*
        $schedule->call(function(){
            Service::get()->each(function($item){
                event(new CheckServiceStatus($item));
            });
        })->everyTenMinutes();
        */

        /*
        $schedule->call(function(){
            Service::get()->each(function($item){
                event(new GenerateScreen($item));
            });

            Provider::get()->each(function($item){
                event(new GenerateScreen($item));
            });

        })->everyThirtyMinutes();
        */

        /*
        $schedule->call(function(){
            event(new ToPayDomainsAlert());
        })->everyTenMinutes();
        */

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
