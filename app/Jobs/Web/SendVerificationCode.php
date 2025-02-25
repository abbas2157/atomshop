<?php

namespace App\Jobs\Web;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\{Mail};
use App\Mail\Web\VerificationCode;

class SendVerificationCode implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private $user;
    private $verify_code;
    public function __construct($user, $verify_code)
    {
        $this->user = $user;
        $this->verify_code = $verify_code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new VerificationCode($this->user, $this->verify_code));
    }
}
