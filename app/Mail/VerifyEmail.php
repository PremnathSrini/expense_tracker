<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {

        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */

     public function build(){
        $verificationUrl = route('custom.verification',[
            'id' => $this->user->id,
            'hash' => sha1($this->user->email),
        ]);
        return $this->subject('Verify Your Email Address')
                        ->view('user.emails.verify_email')
                        ->with([
                            'user' => $this->user,
                            'verificationUrl' => $verificationUrl,
                        ]);
     }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.emails.verify_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
