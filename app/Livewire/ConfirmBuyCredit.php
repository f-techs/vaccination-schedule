<?php

namespace App\Livewire;

use App\Mail\CreditConfirmAlertEmail;
use App\Models\Credit;
use App\Models\CreditTransaction;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ConfirmBuyCredit extends Component
{
    public $creditType;
    public $code='';
    public $credits;
    public $transCode;

    public function save()
    {
        $this->validate([
            'creditType' =>'required',
            'code'=>'required',
            'credits'=>'required',
        ]);
  if($this->code == 'Kwame20436'){
      $credit = Credit::where('project_code', 'vaccine-alert')->first();
      if($this->creditType == 'sms'){
          $balance = $credit->sms;
          $credit->update([
              'sms'=>$this->credits + $balance
          ]);
      }elseif($this->creditType == 'email'){
          $balance = $credit->email;
          $credit->update([
              'email'=>$this->credits + $balance
          ]);
      }
      $trans = CreditTransaction::where('code', $this->transCode)->first();
      Mail::to($trans->client_email)->send(new CreditConfirmAlertEmail($this->transCode));
      session()->flash('message', 'Credit Updated');
      $this->reset();

  }
  }

  public function mount($code){
      //  dd($code);
        $this->transCode = $code;
  }

    public function render()
    {
        return view('livewire.confirm-buy-credit');
    }
}
