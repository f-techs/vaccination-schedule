<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;

class LanguageIndex extends Component
{
    public $language;
    public $languages;


    public function mount()
    {
        $this->languages = Language::all();
    }
    public function removeRow($id)
    {
        $record = Language::find($id);
        $record->delete();
        session()->flash('message', 'Record Successfully Removed');
        $this->languages = Language::all();

    }
    public function render()
    {
        return view('livewire.language-index');
    }
}
