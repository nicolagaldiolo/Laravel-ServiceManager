<?php

namespace App\Jobs;

use App\User;
use App\Mail\ExipiringDomainsEmail;
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
          $users = User::whereHas('customers.domains', function($q){
              $q->expiring();
          })->with([
              'customers' => function($q){
                  $q->whereHas('domains');
              },
              'customers.domains' => function($q){
                  $q->expiring();
              },
          ])->get();

          $users->each(function($item){
              if(!is_null($item->email)){
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
