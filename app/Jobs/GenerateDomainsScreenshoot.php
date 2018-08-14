<?php

namespace App\Jobs;

use App\Domains;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Browsershot\Browsershot;

class GenerateDomainsScreenshoot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $domains;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Domains $domains)
    {
        $this->domains = $domains;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $path = 'domains/' . uniqid() . ".png";
            //"Fit should be one of `contain`, `max`, `fill`, `stretch`, `crop`"

            Browsershot::url($this->domains->url)
                ->dismissDialogs()
                ->waitUntilNetworkIdle()
                ->windowSize(1920, 1080)
                ->fit('fill', 640, 480)
                ->save(public_path() . '/storage/' . $path);

            $this->domains->update(['screenshoot' => $path]); // setto il nuovo path a db
        }catch (\Exception $e){
            //logger('Errore creazione screenshoot domain: ' . $e);
        }
    }
}
