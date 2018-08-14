<?php

namespace App\Jobs;

use App\Providers;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Browsershot\Browsershot;

class GenerateProvidersScreenshoot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $providers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Providers $providers)
    {
        $this->providers = $providers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $path = 'providers/' . uniqid() . ".png";
            //"Fit should be one of `contain`, `max`, `fill`, `stretch`, `crop`"

            Browsershot::url($this->providers->website)
                ->dismissDialogs()
                ->waitUntilNetworkIdle()
                ->windowSize(1920, 1080)
                ->fit('fill', 640, 480)
                ->save(public_path() . '/storage/' . $path);

            $this->providers->update(['screenshoot' => $path]); // setto il nuovo path a db
        }catch (\Exception $e){
            //logger('Errore creazione screenshoot domain: ' . $e);
        }
    }
}
