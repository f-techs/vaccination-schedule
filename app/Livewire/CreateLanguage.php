<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;

class CreateLanguage extends Component
{
    public $language;

    public function save()
    {

        $this->validate([
            'language'=>'required'
        ]);

        Language::create([
            'name'=>strtoupper($this->language)
        ]);
        $this->reset();

        session()->flash('message', 'Record successfully created');


    }
    public function render()
    {
        return view('livewire.create-language');
    }
}
