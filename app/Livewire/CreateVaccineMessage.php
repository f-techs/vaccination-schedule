<?php

namespace App\Livewire;

use App\Models\VaccineMessage;
use Livewire\Component;

class CreateVaccineMessage extends Component
{
    public $title;
    public $message_body;

    protected $rules = [
        'title'=>'required',
        'message_body'=>   'required',
    ];

    public function save()
    {
        $this->validate();
        VaccineMessage::create([
           'title'=>$this->title,
           'message_body'=>$this->message_body
        ]);
        $this->reset();
        session()->flash('message', 'Record successfully created!');
    }
    public function render()
    {
        return view('livewire.create-vaccine-message');
    }
}
