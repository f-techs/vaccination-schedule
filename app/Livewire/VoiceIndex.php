<?php

namespace App\Livewire;

use App\Models\ParentModel;
use App\Models\Voice;
use Livewire\Component;

class VoiceIndex extends Component
{
    public $voices;

    public function mount()
    {
        $this->voices = Voice::with(['language', 'vaccineMessage'])->get();
      //  dd($this->voices);
    }

    public function removeRow($id)
    {
        // Find and delete the record
        $record = Voice::find($id);
        if ($record) {
            $record->delete();
            session()->flash('message', 'Record successfully removed!');
        } else {
            session()->flash('error', 'Record not found'.$id);
        }

        // Refresh the parent records
        $this->voices = Voice::with('language')->get();
    }
    public function render()
    {
        return view('livewire.voice-index');
    }
}
