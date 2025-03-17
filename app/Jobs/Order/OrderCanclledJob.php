<?php

namespace App\Jobs\Order;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\{Mail};
use App\Mail\Order\OrderCanclledMail;

class OrderCanclledJob implements ShouldQueue
{
    use Queueable;

    public $order;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new OrderCanclledMail($this->user, $this->order));
    }
}
