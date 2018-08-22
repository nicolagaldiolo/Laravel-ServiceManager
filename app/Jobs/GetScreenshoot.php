<?php

namespace App\Jobs;

use App\Domains;
use App\Providers;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Browsershot\Browsershot;

class GetScreenshoot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $object;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() // ho un unico Job che uso per il modello Domains e Providers
    {
        try {

            if($this->object instanceof Domains){
                $folder = 'domains/';
                $url = $this->object->url;
            }

            if($this->object instanceof Providers){
                $folder = 'providers/';
                $url = $this->object->website;
            }

            $path = $folder . uniqid() . ".png";
            //"Fit should be one of `contain`, `max`, `fill`, `stretch`, `crop`"

            Browsershot::url($url)
                ->dismissDialogs()
                ->waitUntilNetworkIdle()
                ->windowSize(1920, 1080)
                ->fit('fill', 640, 480)
                ->save(public_path() . '/storage/' . $path);

            $this->object->update(['screenshoot' => $path]); // setto il nuovo path a db

        }catch (\Exception $e){
            logger('Errore creazione screenshoot: ' . $e);
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
        logger($exception);
    }
}
