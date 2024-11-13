<?php

namespace App\Livewire;

use App\Mail\CreditBuyAlertEmail;
use App\Mail\VaccineAlertEmail;
use App\Models\CreditTransaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class BuyCredit extends Component
{
    public $totalAmount=0.00;
    public $credits=0;
    public $clientPhone;
    public $creditType;

    public function save()
    {
        $this->validate([
            'creditType' => 'required',
            'clientPhone'=>'required|digits:10',
            'credits'=>'required|integer'
        ]);
        $buyCredit = CreditTransaction::create([
           'credit_type'=>$this->creditType,
           'credits_requested'=>$this->credits,
           'client_phone'=>$this->clientPhone,
           'credit_amount'=>$this->totalAmount,
           'code'=>Str::uuid(),
        ]);
        if($buyCredit){
//            try {
                Mail::to('ftechs20436@gmail.com')->send(new CreditBuyAlertEmail($buyCredit->code));
                session()->flash('message', 'Request Sent Successfully. Credit will be updated Soon');
//            }catch (\Exception $e){
//                session()->flash('emailSendingError', 'Oops! Something went wrong. Refresh and Try Again');
//            }

        }
    }
    public function updateCredit(){
        if($this->credits > 0){
            $this->totalAmount = round($this->credits * 0.30, 2);
        }

    }


    public function render()
    {
        return view('livewire.buy-credit');
    }
}
