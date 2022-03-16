<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstLogin extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token, string $email)
    {
        $this->token = $token;
        $this->email = $email;
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
            'email' => $this->email,
        ];
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(__('mail.firstLogin'))
            ->view('emails.first_login')
            ->with('data', $viewAssign);
    }
}
