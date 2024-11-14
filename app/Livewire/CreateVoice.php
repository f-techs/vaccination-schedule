<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\VaccineMessage;
use App\Models\Voice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateVoice extends Component
{

    use WithFileUploads;

    public $message;
    public $vaccineMessages;
    public $title;
    public $language;
    public $voice;
    public $languages;
    public $message_body;

//    protected $rules = [
//        'message' => 'required|string|max:255',
//        'language' => 'required|string|max:255',
//        'voice' => 'required|max:10240', // Adjust as necessary
//    ];

    public function save()
    {
        $checkUniqueness = Voice::where(['vaccine_message_id'=>$this->message, 'language_id'=>$this->language])->get()->count();
        if($checkUniqueness < 1){
        $this->validate([
            'message' => 'required',
            'language' => 'required|string|max:255',
            'voice' => 'required|max:10240',
        ]);

        // Generate a unique file name
        $filename = Str::uuid() . '.' . $this->voice->getClientOriginalExtension();

        // Store the file in a specific folder
        $path = $this->voice->storeAs('voices', $filename, 'public');

        // Save record to the database
        Voice::create([
            'language_id' => $this->language,
            'vaccine_message_id'=>$this->message,
            'voice' => $path, // Store path in database
            'created_by'=>Auth::user()->id
        ]);
        $this->reset();
        $this->languages=Language::all();
        $this->vaccineMessages=VaccineMessage::all();

        session()->flash('message', 'Voice recorded and saved successfully!');
        }else{
            session()->flash('record-exist', 'Voice already exist in the language selected for this message');
        }
    }





    public function mount($vaccineMsg)
    {
        $record = VaccineMessage::where('code', $vaccineMsg)->first();
        $this->message=$record->vaccine_message_id ?? '';
        $this->languages=Language::all();
        $this->vaccineMessages=VaccineMessage::all();
       // $this->listeners = ['fileUpload' => 'handleFileUpload'];
    }

//    public function handleFileUpload($field, $file)
//    {
//        if ($field === 'voice') {
//            $this->voice = $file; // Ensure 'voice' field is updated
//        }
//    }
    public function render()
    {
        return view('livewire.create-voice');
    }
}
