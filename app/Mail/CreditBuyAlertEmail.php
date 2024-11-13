<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreditBuyAlertEmail extends Mailable
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
        return $this->subject('Credit Buying')
            ->from('no-reply@vaccine-schedule-generator.online', 'F-TECHS CONSULT')
            ->view('emails.credit-alert-email');
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */



}
