<?php

namespace App\Livewire;

use Livewire\Component;

class VaccineAlertPage extends Component
{
    public $code;
    public $message;

    public function mount()
    {

    }


    public function render()
    {
        return view('livewire.vaccine-alert-page');
    }
}
