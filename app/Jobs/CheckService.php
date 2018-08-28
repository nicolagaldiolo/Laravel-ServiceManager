<?php

namespace App\Jobs;

use App\Domains;
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

    public $domain;

    public function __construct(Domains $domain)
    {
        $this->domain = $domain;
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
            $health = Ping::check($this->domain->url);
        }catch (\Exception $e){
            logger('Errore Check dominio: ' . $e);
        }
        $status = ($health == 200) ? true : false;
        $this->domain->update( ['status' => $status]);

    }
}
