<?php

namespace App\Jobs;


use App\Mail\ActivateEmail;
use App\Mail\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
    //
    $mailable = isset($this->data['hash_active'])
            ? new ActivateEmail($this->data)
            : new ResetPassword($this->data);

        Mail::to($this->data['email'])->send($mailable);
    }
}
