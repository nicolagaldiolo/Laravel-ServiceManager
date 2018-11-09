<?php

namespace App\Jobs;

use App\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Ping;

class CheckService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $health = 0;
        try {
            $health = Ping::check($this->service->url);
        }catch (\Exception $e){
            //logger('Errore Check servizio: ' . $e);
        }
        $status = ($health == 200) ? true : false;
        $this->service->update( ['health' => $status]);

    }
}
