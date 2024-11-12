<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class MessageIndex extends Component
{
    public $schedules;

    protected $rules = [
      ''
    ];

    public function mount()
    {
       $this->schedules = Message::with(['parent', 'voice', 'messageType'])->get();
       // dd($this->schedules);
    }
    public function render()
    {
        return view('livewire.message-index');
    }
}
