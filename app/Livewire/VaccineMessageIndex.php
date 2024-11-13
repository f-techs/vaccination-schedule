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

    public function editRow($id)
    {
        return redirect()->route('vaccine-message.edit', ['id' => $id]);
    }

    public function addVoice($code){
        return redirect()->route('voice.create', ['vaccineMsg' => $code]);
    }
    public function removeRow($id)
    {
        // Find and delete the record
        $record = VaccineMessage::find($id);
        if ($record) {
            $record->delete();
            session()->flash('message', 'Record successfully removed!');
        } else {
            session()->flash('error', 'Record not found'.$id);
        }

        // Refresh the parent records
        $this->vaccineMessages = VaccineMessage::all();
    }



    public function render()
    {
        return view('livewire.vaccine-message-index');
    }
}
