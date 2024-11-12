<?php

namespace App\Events;

use App\Models\Message;
use App\Models\ParentModel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VaccineAlertEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $parent;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct(ParentModel $parent, Message $message)
    {
        //should be an object
        $this->parent = $parent;
        $this->message =$message;
    }


}
