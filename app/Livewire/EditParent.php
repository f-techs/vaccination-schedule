<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;
use App\Models\ParentModel;

class EditParent extends Component
{
    // public $id;
    public $parentId;
    public $parent_name, $child_name, $mobile_number, $date_of_birth, $email;
    public $languages=null;
    public $language;

    public function mount($id)
    {
        $parent = ParentModel::findOrFail($id); // Fetch the record by ID
        $this->languages =  Language::all();
        $this->parentId = $parent->parent_id;
        $this->parent_name = $parent->parent_name;
        $this->child_name = $parent->child_name;
        $this->mobile_number = $parent->mobile_number;
        $this->date_of_birth = $parent->date_of_birth;
        $this->email = $parent->email;
        $this->language = $parent->language_id;
    }

    public function update()
    {
        $this->validate([
            'parent_name' => 'required|string|max:255',
            'child_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|max:255',
        ]);

        $parent = ParentModel::find($this->parentId);
        $parent->update([
            'parent_name' => $this->parent_name,
            'child_name' => $this->child_name,
            'mobile_number' => $this->mobile_number,
            'date_of_birth' => $this->date_of_birth,
            'language_id'=>$this->language,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Record successfully updated!');

        return redirect()->route('parents');
    }
    public function render()
    {
        return view('livewire.edit-parent');
    }
}
