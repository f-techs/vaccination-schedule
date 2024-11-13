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
       $this->schedules = Message::with(['parent', 'voice', 'messageType', 'language', 'vaccineMessages'])->get();
       // dd($this->schedules);
    }

    public function removeRow($row)
    {
        $record = Message::find($row);
        $record->delete();
        $this->schedules = Message::with(['parent', 'voice', 'messageType', 'language', 'vaccineMessages'])->get();
        session()->flash('message', 'Record Successfully Removed');

    }
    public function render()
    {
        return view('livewire.message-index');
    }
}
