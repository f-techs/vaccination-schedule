<?php

namespace App\Livewire;

use App\Models\VaccineMessage;
use Livewire\Component;

class EditVaccineMessage extends Component
{
    public $id;
    public $title;
    public $message_body;
    public $messageId;

    public function mount($id)
    {
        $message=VaccineMessage::findOrfail($id);
        $this->messageId = $message->vaccine_message_id;
        $this->title=$message->title;
        $this->message_body=$message->message_body;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'message_body' => 'required',
        ]);

        $message = VaccineMessage::find($this->messageId);
        $message->update([
            'title' => $this->title,
            'message_body' => $this->message_body,
        ]);

        session()->flash('message', 'Record successfully updated!');

        return redirect()->route('vaccine-messages');
    }
    public function render()
    {
        return view('livewire.edit-vaccine-message');
    }
}
