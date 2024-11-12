<?php

namespace App\Livewire;

use App\Events\VaccineAlertEvent;
use App\Mail\VaccineAlertEmail;
use App\Models\Language;
use App\Models\Message;
use App\Models\MessageType;
use App\Models\ParentModel;
use App\Models\Voice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use PDOException;

class CreateMessage extends Component
{
    public $languages;
    public $language;
    public $messageTypes;
    public $message_type;
    public $parents=[];
    public $parent;
    public $selectedParentsIds=[];
    public $selectedParents = [];
    public $voices=[];
    public $voice;
    public $vaccine_date;

    protected $rules = [
        'language' =>'required',
        'parent'=>'required',
        'voice'=>'required',
        'vaccine_date'=>'required',
        'message_type'=>'required'
    ];

    public function save(){
        $this->validate();
        if($this->message_type == 2){
        try {
            foreach($this->selectedParentsIds as $row){
                $code =Str::uuid();
                $parent = ParentModel::find($row);

                $message =  Message::create([
                    'code'=>$code,
                    'parent_id'=>$row,
                    'vaccine_date'=>$this->vaccine_date,
                    'voice_id'=>$this->voice,
                    'message_type_id'=>$this->message_type,
                    'created_by'=>Auth::user()->id
                ]);
                //VaccineAlertEvent::dispatch($parent, $message);
                Mail::to($parent->email)->send(new VaccineAlertEmail($message->code));
            }
            session()->flash('message', 'Record successfully created!');
        }catch(PDOException $ex){
         dd($ex->getMessage())  ;
        }
        }elseif($this->message_type == 1){

        }

    }

    public function mount()
    {
        $this->languages =  Language::all();
        $this->messageTypes = MessageType::all();

    }

    public function updatedLanguage()
    {
        $this->parents = ParentModel::where('language_id', $this->language)->get();
       // dd($this->parents);
        $this->voices = Voice::where('language_id', $this->language)->get();
        $this->selectedParents=[];
        $this->reset(['parent', 'selectedParentsIds', 'selectedParents']);
    }
    public function updatedParent($value)
    {
        if (!in_array($value, $this->selectedParentsIds)) {
            $this->selectedParentsIds[] = $value;
        }
      $this->fetchSelectedParents();
    }

    public function fetchSelectedParents()
    {
        // Retrieve the selected parent objects based on the selected IDs
        $this->selectedParents = ParentModel::whereIn('parent_id', $this->selectedParentsIds)->get();
    }

    public function removeParent($parentId)
    {
        $this->selectedParentsIds = array_filter($this->selectedParentsIds, function ($value) use ($parentId) {
            return $value != $parentId;
        });
        $this->fetchSelectedParents();
    }

    public function render()
    {
        return view('livewire.create-message');
    }
}
