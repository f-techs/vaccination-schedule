<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreditConfirmAlertEmail extends Mailable
{
    use Queueable, SerializesModels;
  //public $parent;
   public $code;
    /**
     * Create a new message instance.
     */
    public function __construct(String $code)
   {
       $this->code = $code;
       // $this->message=$message;
  }
    public function build()
    {
        return $this->subject('Credit Confirmation')
            ->from('no-reply@f-techsconsult.com', 'Credit Confirmation')
            ->view('emails.credit-confirmation-email');
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */



}
