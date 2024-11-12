<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\ParentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VaccineAlertEmail extends Mailable
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
        return $this->subject('Vaccination Schedule Alert')
            ->from('no-reply@vaccine-schedule-generator.online', 'Vaccination Alert')
            ->view('emails.vaccine-alert-email');
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */



}
