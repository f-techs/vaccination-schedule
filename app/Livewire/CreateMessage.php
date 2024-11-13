<?php

namespace App\Livewire;

use App\Events\VaccineAlertEvent;
use App\Mail\VaccineAlertEmail;
use App\Models\Language;
use App\Models\Message;
use App\Models\MessageType;
use App\Models\ParentModel;
use App\Models\VaccineMessage;
use App\Models\Voice;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;


class CreateMessage extends Component
{
    public $languages;
    public $language;
    public $messageTypes;
    public $message_type;
    public $parents=[];
    public $parent;
    public $vaccineMessages;
    public $message;
    public $selectedParentsIds=[];
    public $selectedParents = [];
    public $emailExpMessage;
  //  public $voices=[];
  //  public $voice;

    public $vaccine_date;
    public $success;
    public $totalMessages;

//    protected $rules = [
//        'message'=>'required',
//        'parent'=>'required',
//        'message_type'=>'required'
//    ];

    public function save(){
        $this->validate([
           'message'=>'required',
            'parent'=>'required',
            'message_type'=>'required',
            'vaccine_date'=>'required'
        ]);
        $this->success = 0;
        $this->totalMessages =  count($this->selectedParentsIds);
        if($this->message_type == 2){
            $validParents = ParentModel::whereIn('parent_id', $this->selectedParentsIds)->get();
            foreach($validParents as $row){
                $code =Str::uuid();
               // $parent = ParentModel::find($row);
                $voice = Voice::where(['language_id'=>$row->language_id, 'vaccine_message_id'=>$this->message])->first();
                $message =  Message::create([
                    'code'=>$code,
                    'parent_id'=>$row->parent_id,
                    'vaccine_message_id'=>$this->message,
                    'vaccine_date'=>$this->vaccine_date,
                    'language_id'=>$row->language_id,
                    'voice_id'=>$voice->voice_id,
                    'message_type_id'=>$this->message_type,
                    'created_by'=>Auth::user()->id
                ]);
                if($message){
                    try {
                        Mail::to($row->email)->send(new VaccineAlertEmail($message->code));
                        $this->success=$this->success + 1;
                    }catch(Exception $ex){
                        session()->flash('emailSendingError', 'Oops! Issue with the Email Server. It could be Network problem. Refresh and Try Again');
                    }
                }
            }
            session()->flash('message', 'Process Completed');
        }elseif($this->message_type == 1){

        }

    }

    public function mount()
    {
        $this->languages =  Language::all();
        $this->messageTypes = MessageType::all();
        $this->vaccineMessages=VaccineMessage::all();
        $this->parents = ParentModel::all();

    }

    public function updatedLanguage()
    {
       // $this->parents = ParentModel::where('language_id', $this->language)->get();
       // dd($this->parents);
        $this->voices = Voice::where('language_id', $this->language)->get();
        $this->selectedParents=[];
        $this->reset(['parent', 'selectedParentsIds', 'selectedParents']);
    }
    public function updatedParent($value)
    {
        $parent = ParentModel::find($value);
        $parentName = $parent->parent_name;
        //dd($parent);
        $voiceExist = Voice::where(['language_id'=>$parent->language_id, 'vaccine_message_id'=>$this->message])->first();
       if ($voiceExist){
           if (!in_array($value, $this->selectedParentsIds)) {
               $this->selectedParentsIds[] = $value;
           }
           $this->fetchSelectedParents();
       }else{
           session()->flash('danger', "There is no voice for the selected message in {$parentName}'s preferred language");
       }


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
