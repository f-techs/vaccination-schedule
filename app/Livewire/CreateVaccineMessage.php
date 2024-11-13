<?php

namespace App\Livewire;

use App\Models\VaccineMessage;
use Illuminate\Support\Str;
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
        $code =Str::uuid();
        VaccineMessage::create([
           'title'=>$this->title,
           'message_body'=>$this->message_body,
            'code'=>$code
        ]);
        $this->reset();
        session()->flash('message', 'Record successfully created!');
    }
    public function render()
    {
        return view('livewire.create-vaccine-message');
    }
}
