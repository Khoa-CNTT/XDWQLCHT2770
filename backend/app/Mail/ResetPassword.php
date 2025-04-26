<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $hash;

    public function __construct($customer, $hash)
    {
        $this->customer = $customer;
        $this->hash = $hash;
    }

    public function build()
    {
        $url = url('/api/reset-password?hash=' . $this->hash . '&email=' . $this->customer->email);
        return $this->subject('Reset Your Password')
                    ->view('emails.reset')
                    ->with(['url' => $url]);
    }
}