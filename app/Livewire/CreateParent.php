<?php

namespace App\Livewire;

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

    protected $rules = [
        'parent_name' => 'required|string|max:255',
        'child_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'mobile_number' => 'required|digits:10',
        'email' => 'required|email|max:255|unique:parents',
    ];

    public function save()
    {
        $this->validate();

        ParentModel::create([
            'parent_name' => $this->parent_name,
            'child_name' => $this->child_name,
            'date_of_birth' => $this->date_of_birth,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
            'created_by'=>Auth::user()->id
        ]);
        $this->reset();
        session()->flash('message', 'Record successfully created!');

    }

    public function render()
    {
        return view('livewire.create-parent');
    }
}
