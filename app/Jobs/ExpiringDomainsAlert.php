<?php

namespace App\Jobs;

use App\Mail\ExipiringDomainsEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ExpiringDomainsAlert implements ShouldQueue
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
  
        $user = User::with(['domains' => function($query){
          $query->where('payed', 0)->whereMonth('deadline' , Carbon::today()->month);
        }])->get();
        
        $user->each(function($item){
          //try {
          //  $health = Ping::check($item->url);
          //}catch (\Exception $e){
          //  $health = 500;
          //}
          //$status = ($health == 200) ? true : false;
          //$item->update( ['status' => $status]);
          if(!is_null($item->email) && $item->domains->count() > 0){
            Mail::to($item->email)->send(new ExipiringDomainsEmail($item));
          }
        });
        logger("JOB COMPLETED: Email send");
      }catch (\Exception $e){
        logger('Error email sending: ' . $e);
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
