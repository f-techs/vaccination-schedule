<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Voice;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateVoice extends Component
{

    use WithFileUploads;

    public $message;
    public $title;
    public $language;
    public $voice;
    public $languages;
    public $message_body;

    protected $rules = [
        'title' => 'required|string|max:255',
        'language' => 'required|string|max:255',
        'voice' => 'required|max:10240', // Adjust as necessary
    ];

    public function save()
    {
        $this->validate();

        // Generate a unique file name
        $filename = Str::uuid() . '.' . $this->voice->getClientOriginalExtension();

        // Store the file in a specific folder
        $path = $this->voice->storeAs('voices', $filename, 'public');

        // Save record to the database
        Voice::create([
            'title' => $this->title,
            'language_id' => $this->language,
            'message_body'=>$this->message_body,
            'voice' => $path, // Store path in database
            'created_by'=>Auth::user()->id
        ]);
        $this->reset();
        $this->languages=Language::all();

        session()->flash('message', 'Voice recorded and saved successfully!');
    }





    public function mount()
    {
        $this->languages=Language::all();
        $this->listeners = ['fileUpload' => 'handleFileUpload'];
    }

    public function handleFileUpload($field, $file)
    {
        if ($field === 'voice') {
            $this->voice = $file; // Ensure 'voice' field is updated
        }
    }
    public function render()
    {
        return view('livewire.create-voice');
    }
}
