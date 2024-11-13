<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Voice;
use Livewire\Component;

class VaccineAlertPage extends Component
{
    public $code;
    public $messageTitle;
    public $messageBody;
    public $languages;
    public $language;
    public $messageVoice;
    public $voices=[];
    public $voice;
    public $vaccineMessage;
    public $updatedVoice;

    public function mount($code)
    {
        $record = Message::with(['parent', 'voice', 'messageType', 'language', 'vaccineMessages'])
            ->where('code', $code)->first();
        //dd($record);
        if($record){
            $this->vaccineMessage = $record->vaccine_message_id;
            $this->languages = Voice::with('language')->where('vaccine_message_id', $record->vaccineMessages->vaccine_message_id)->get();
       $this->messageTitle =$record->vaccineMessages->title;
       $this->messageBody =$record->vaccineMessages->message_body;
       $this->messageVoice = $record->voice->voice;
       $this->updatedVoice = $record->voice->voice;
       $this->language=$record->language->language_id;
        }
      // dd($this->voices);

    }

    public function updatedLanguage($language)
    {
        //dd($voice);
        $voiceRecord = Voice::where(['vaccine_message_id'=> $this->vaccineMessage, 'language_id' => $language])->first();
        //$this->messageVoice=$voiceRecord->voice;
        $this->updatedVoice = $voiceRecord->voice;
       // dd($this->messageVoice);

    }


    public function render()
    {
        return view('livewire.vaccine-alert-page');
    }
}
