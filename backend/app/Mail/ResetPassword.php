<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data,)
    {
        $this->data = $data;

    }

    public function build()
    {
        return $this->subject('Đặt lại mật khẩu')
        ->view('emails.reset_password',['data' => $this->data]);
    }
}