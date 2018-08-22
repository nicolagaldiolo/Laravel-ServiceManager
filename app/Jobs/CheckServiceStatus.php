<?php

namespace App\Jobs;

use App\Domains;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Ping;

class CheckServiceStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $domains = Domains::get();
            $domains->each(function($item){
                try {
                    $health = Ping::check($item->url);
                }catch (\Exception $e){
                    $health = 500;
                }
                $status = ($health == 200) ? true : false;
                $item->update( ['status' => $status]);
            });
            logger("JOB COMPLETED: Check dominio effettuato");
        }catch (\Exception $e){
            logger('Errore Check dominio: ' . $e);
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        logger("JOB FAILED: " . $exception);
    }

}
