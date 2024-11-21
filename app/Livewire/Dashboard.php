<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\ParentModel;
use App\Models\VaccineMessage;
use Livewire\Component;

class Dashboard extends Component
{
    public $parentRecords;
    public $smsCount;
    public $emailCount;
    public $totalMessagesSent;
    public $messagesRead;
    public $messagesUnread;

    public function mount()
    {
        // Replace these with actual database queries
        $this->parentRecords = ParentModel::all()->count(); // Example count of parent records
        $this->smsCount = Message::with('messageType')->where('message_type_id', 1)->count(); // Example count of SMS sent
        $this->emailCount = Message::with('messageType')->where('message_type_id', 2)->count();; // Example count of emails sent
        $this->totalMessagesSent = $this->smsCount + $this->emailCount;
        $this->messagesRead = Message::where('status', 1)->count(); // Example count of messages read
        $this->messagesUnread = $this->totalMessagesSent - $this->messagesRead;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
