<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $user;
     public $verificationCode;

     /**
      * Create a new message instance.
      */
     public function __construct($user,$verificationCode )
     {
        $this->user = $user;
         $this->verificationCode = $verificationCode;
     }

   /* public function __construct($user)
    {
        $this->user = $user;
    }*/

    public function build()
    {





        return $this->from('noreply@NUTRIPAL.com', 'NUTRIPAL')
        ->subject('Your Email Verification Code')
        ->text('email.verification_plain')  // Send plain text instead of a view
        ->with([
            'verificationCode' => $this->verificationCode,
            'user' => $this->user
        ]);


      /*  return $this->from('noreply@mailtrap.io', 'Example App')
                    ->subject('Verify Your Email Address')
                    ->view('verify')  // The view where your email content is stored
                    ->with([
                        'verificationUrl' => route('verification.verify', [
                            'id' => $this->user->id,
                            'hash' => sha1($this->user->email)
                        ])
                    ]);*/
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Verification Mail',
        );
    }

    
    /**
     * Get the message content definition.
     */
     public function content(): Content
    {
        return new Content(
            view: 'email.verification_plain',
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
