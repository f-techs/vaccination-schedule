<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;

class CreateVoice extends Component
{
    public $languages;
    public $language;

    public function mount()
    {
        $this->languages=Language::all();
    }
    public function render()
    {
        return view('livewire.create-voice');
    }
}
