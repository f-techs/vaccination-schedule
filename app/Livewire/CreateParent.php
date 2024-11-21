<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Auth;

class CreateParent extends Component
{
    public $parent_name;
    public $child_name;
    public $date_of_birth;
    public $mobile_number;
    public $email;
    public $gender;
    public $languages=null;
    public $language;
    public $guardian_name;

    public $guardian_mobile;


    protected $rules = [
        'parent_name' => 'required|string|max:255',
        'child_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'language' => 'required',
        'mobile_number' => 'required|digits:10',
        'email' => 'required|email|max:255|unique:parents',
        'gender' => 'required',
        'guardian_name'=>'required',
        'guardian_mobile'=>'required'
    ];

    public function save()
    {
        $this->validate();

        ParentModel::create([
            'parent_name' => $this->parent_name,
            'child_name' => $this->child_name,
            'date_of_birth' => $this->date_of_birth,
            'mobile_number' => $this->mobile_number,
            'gender'=>$this->gender,
            'language_id'=>$this->language,
            'email' => $this->email,
            'guardian_name'=>$this->guardian_name,
            'guardian_mobile'=>$this->guardian_mobile,
            'created_by'=>Auth::user()->id
        ]);
        $this->reset();
        session()->flash('message', 'Record successfully created!');
        $this->languages=Language::all();
    }

    public function mount()
    {
        $this->languages=Language::all();
    }
    public function render()
    {
        return view('livewire.create-parent');
    }
}
