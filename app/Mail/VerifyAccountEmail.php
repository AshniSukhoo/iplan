<?php

namespace Iplan\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Iplan\Entity\VerificationToken;

class VerifyAccountEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Account Verification Token.
     *
     * @var VerificationToken
     */
    public $verificationToken;
    
    /**
     * Email Subject/Title
     *
     * @var string
     */
    protected $title = 'Welcome to Iplan';
    
    /**
     * VerifyAccountEmail constructor.
     *
     * @param \Iplan\Entity\VerificationToken $verificationToken
     */
    public function __construct(VerificationToken $verificationToken)
    {
        $this->verificationToken = $verificationToken;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@iplan.mu')
                    ->subject($this->title)
                    ->view('emails.verify-account-email')
                    ->with([
                        'title' => $this->title
                    ]);
    }
}
