<?php

namespace App\Console;

use App\Domain;
use App\Events\ToPayDomainsAlert;
use App\Events\GenerateScreen;
use App\Events\UserRegister;
use App\Events\CheckServiceStatus;
use App\Jobs\ToPayDomains;
use App\Providers;
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
        $schedule->call(function () {

            // Incremento la data di un anno dei servizi pagati
            Domain::updateDeadlineNextYear()->each(function($item){
                $years_gap = Carbon::now()->endOfMonth()->diffInYears($item->deadline->endOfMonth());
                $item->update(['deadline' => $item->deadline->addYear($years_gap + 1)]);
            });

            // Aggiorno la tabella domains settando i servizi da pagare
            Domain::expiring()->update(['payed' => 0]);

        })->everyMinute();
        */


        /*$schedule->call(function(){
            Domains::get()->each(function($item){
                event(new CheckServiceStatus($item));
            });
        })->everyTenMinutes();
        */

        /*
        $schedule->call(function(){
            Domain::get()->each(function($item){
                event(new GenerateScreen($item));
            });

            Providers::get()->each(function($item){
                event(new GenerateScreen($item));
            });

        })->everyThirtyMinutes();
        */


        //$schedule->call(function(){
        //    event(new ToPayDomainsAlert());
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
