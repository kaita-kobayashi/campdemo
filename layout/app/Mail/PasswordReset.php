<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    private $token = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewAssign = [
            'token' => $this->token,
        ];
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(__('mail.passwordReset'))
            ->view('emails.password_reset')
            ->with('data', $viewAssign);
    }
}
