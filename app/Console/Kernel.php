<?php

namespace App\Console;

use App\Events\CustomerRenewalReminder;
use App\Service;
use App\Events\ToPayServicesAlert;
use App\Events\GenerateScreen;
use App\Events\UserRegister;
use App\Events\CheckServiceStatus;
use App\Jobs\ToPayServices;
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


        $schedule->call(function(){
            Service::get()->each(function($item){
                event(new CheckServiceStatus($item));
            });
        })->hourly();

        $schedule->call(function(){

            event(new ToPayServicesAlert());
            event(new CustomerRenewalReminder());

        })->weeklyOn(1, '1:00');

        $schedule->call(function(){
            Service::get()->each(function($item){
                event(new GenerateScreen($item));
            });

            Provider::get()->each(function($item){
                event(new GenerateScreen($item));
            });

        })->weeklyOn(1, '3:00');

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
