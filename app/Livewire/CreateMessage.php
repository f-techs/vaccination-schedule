<?php

namespace App\Livewire;

use App\Events\VaccineAlertEvent;
use App\Mail\VaccineAlertEmail;
use App\Models\Credit;
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

use Zenoph\Notify\Enums\AuthModel;
use Zenoph\Notify\Enums\SMSType;
use Zenoph\Notify\Request\SMSRequest;


class CreateMessage extends Component
{
    public $languages;
    public $language;
    public $messageTypes;
    public int $message_type;
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
    public int $success;
    public int $totalMessages;
    public int $credit;

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
       // dd(gettype($this->message_type));
        if($this->message_type == 2){
            $this->credit = Credit::where('project_code', 'vaccine-alert')->first()->email;
        }elseif ($this->message_type == 1){
            $this->credit = Credit::where('project_code', 'vaccine-alert')->first()->sms;
        }
      if($this->credit > 0){
          $validParents = ParentModel::whereIn('parent_id', $this->selectedParentsIds)->get();
          foreach ($validParents as $row){
                    $code = Str::uuid();
                    $voice = Voice::where(['language_id' => $row->language_id, 'vaccine_message_id' => $this->message])->first();
                    $message = Message::create([
                        'code' => $code,
                        'parent_id' => $row->parent_id,
                        'vaccine_message_id' => $this->message,
                        'vaccine_date' => $this->vaccine_date,
                        'language_id' => $row->language_id,
                        'voice_id' => $voice->voice_id,
                        'message_type_id' => $this->message_type,
                        'created_by' => Auth::user()->id
                    ]);
                    if($message && $this->message_type==2 && $this->credit != 0){
                        try {
                                    Mail::to($row->email)->send(new VaccineAlertEmail($message->code));
                                    $this->success = $this->success + 1;
                                    $this->credit = $this->credit - 1;
                                } catch (Exception $ex) {
                                    session()->flash('messagingError', 'Oops! Something went wrong. Refresh and Try Again');
                            }
                    }elseif($message && $this->message_type==1 && $this->credit != 0){
                        try {
                                    $messageUrl = route('vaccine.alert', ['code'=>$message->code]);
                                    $request = new SMSRequest();
                                    $request->setHost('api.smsonlinegh.com');
                                    $request->setAuthModel(AuthModel::API_KEY);
                                    $request->setAuthApiKey(env('SMS_API_KEY'));
                                    $request->setSender('VAXNOTIFY');
                                    $request->setMessage("Hello {$row->parent_name}! This is to remind you of your child's vaccination. click on this link {$messageUrl} for more details");
                                    $destsArr = array($row->mobile_number, $row->guardian_mobile);
                                    $request->addDestinationsFromCollection($destsArr);
                                    $request->setSMSType(SMSType::GSM_DEFAULT);
                                    //$request->addDestination($row->mobile_number);
                                    $request->submit();
                                    $this->success = $this->success + 1;
                                    $this->credit = $this->credit - 2;
                                }catch (Exception $ex) {
                                   //dd ($ex->getMessage());
                                  session()->flash('messagingError', 'Oops! Something went wrong. Refresh and Try Again');
                                }
                    }
          }
          session()->flash('message', 'Process Completed');
          $creditBalance = Credit::where('project_code', 'vaccine-alert')->first();
          if($this->message_type==2){
              $creditBalance->update([
                        'email'=>$this->credit
                    ]);
          }elseif($this->message_type==1){
              $creditBalance->update([
                  'sms'=>$this->credit
              ]);
          }
                $this->resetExcept(['success', 'totalMessages']);
                $this->resetData();
      }else{
          session()->flash('no-credit', 'There is no enough credit');
      }


//        $validParents = ParentModel::whereIn('parent_id', $this->selectedParentsIds)->get();
//                foreach ($validParents as $row) {
//                    $code = Str::uuid();
//                    $voice = Voice::where(['language_id' => $row->language_id, 'vaccine_message_id' => $this->message])->first();
//                    $message = Message::create([
//                        'code' => $code,
//                        'parent_id' => $row->parent_id,
//                        'vaccine_message_id' => $this->message,
//                        'vaccine_date' => $this->vaccine_date,
//                        'language_id' => $row->language_id,
//                        'voice_id' => $voice->voice_id,
//                        'message_type_id' => $this->message_type,
//                        'created_by' => Auth::user()->id
//                    ]);
//                    if ($message) {
//                        if($this->message_type == 2){
//                            $this->credit = Credit::where('project_code', 'vaccine-alert')->first()->email;
//                            if($this->credit > 0)
//                            {
//                                try {
//                                    Mail::to($row->email)->send(new VaccineAlertEmail($message->code));
//                                    $this->success = $this->success + 1;
//                                    $this->credit = $this->credit - 1;
//                                } catch (Exception $ex) {
//                                    session()->flash('emailSendingError', 'Oops! Issue with the Email Server. It could be Network problem. Refresh and Try Again');
//                                }
//                            }else{
//                                session()->flash('no-credit', 'There is no enough credit');
//                            }
//                        }else{
//                            $this->credit = Credit::where('project_code', 'vaccine-alert')->first()->sms;
//                            $messageUrl = route('vaccine.alert', ['code'=>$message->code]);
//                            if($this->credit > 0){
//                                try {
//                                    $request = new SMSRequest();
//                                    $request->setHost('api.smsonlinegh.com');
//
//                                    $request->setAuthModel(AuthModel::API_KEY);
//                                    $request->setAuthApiKey(env('SMS_API_KEY'));
//
//                                    $request->setSender('VAXNOTIFY');
//                                    $request->setMessage("Hello {$row->parent_name}! This is to remind you of your child's vaccination. click on this link {$messageUrl} for more details");
//                                    $request->setSMSType(SMSType::GSM_DEFAULT);
//                                    $request->addDestination($row->mobile_number);
//                                    // send message
//                                    $request->submit();
//                                    $this->success = $this->success + 1;
//                                    $this->credit = $this->credit - 1;
//                                }catch (Exception $ex) {
//                                    dd ($ex->getMessage());
//                                }
//                            }else{
//                                session()->flash('no-credit', 'There is no enough credit');
//                            }
//                        }
//
//                    }
//                }
//                session()->flash('message', 'Process Completed');
//                $credit = Credit::where('project_code', 'vaccine-alert')->first();
//                if($this->message_type == 2){
//                    $credit->update([
//                        'email'=>$this->credit
//                    ]);
//                }else{
//                    $credit->update([
//                        'sms'=>$this->credit
//                    ]);
//                }
//                $this->reset();
//                $this->resetData();

    }

    public function mount()
    {
        $this->resetData();

    }

    public function resetData()
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
