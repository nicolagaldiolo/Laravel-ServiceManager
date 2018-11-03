<?php

namespace App\Jobs;

use App\Mail\UserRegisterEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class UserRegisterAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $admin;
    public $userRegistered;
    public function __construct(User $admin, User $userRegistered)
    {
        $this->admin = $admin;
        $this->userRegistered = $userRegistered;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin->email)->locale($this->admin->lang)->send(new UserRegisterEmail($this->admin, $this->userRegistered));
    }
}
