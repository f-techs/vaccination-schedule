<?php

namespace App\Livewire;

use App\Models\VaccineMessage;
use Livewire\Component;

class VaccineMessageIndex extends Component
{
    public $vaccineMessages;
    public $title;
    public $message_body;


    public function mount()
    {
     $this->vaccineMessages = VaccineMessage::all();
    }
    public function render()
    {
        return view('livewire.vaccine-message-index');
    }
}
