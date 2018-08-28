<?php

namespace App\Console;

use App\Domains;
use App\Events\ExpiringDomainsAlert;
use App\Events\GenerateScreen;
use App\Events\UserRegister;
use App\Events\CheckServiceStatus;
use App\Jobs\ExpiringDomains;
use App\Providers;
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
        $schedule->call(function () {
            Domains::toExpire()->update(['payed' => 0]);
        })->everyMinute();
        */

        /*
        $schedule->call(function(){
            Domains::get()->each(function($item){
                event(new CheckServiceStatus($item));
            });
        })->everyTenMinutes();
        */

        /*
        $schedule->call(function(){
            Domains::->get()->each(function($item){
                event(new GenerateScreen($item));
            });

            Providers::->get()->each(function($item){
                event(new GenerateScreen($item));
            });

        })->everyTenMinutes();
        */


        //$schedule->call(function(){
        //    event(new ExpiringDomainsAlert());
        //})->everyMinute();

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
