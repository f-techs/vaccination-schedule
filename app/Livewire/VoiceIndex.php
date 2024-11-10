<?php

namespace App\Livewire;

use App\Models\Voice;
use Livewire\Component;

class VoiceIndex extends Component
{
    public $voices;

    public function mount()
    {
        $this->voices = Voice::with('language')->get(); 
    }
    public function render()
    {
        return view('livewire.voice-index');
    }
}
