<?php

namespace App\Livewire;

use App\Models\Language;
use Livewire\Component;
use App\Models\ParentModel;

class ParentIndex extends Component
{

   public $parents;
   public $languages;


   public function mount()
   {
     $this->parents = ParentModel::with('language')->get();
   }

   public function removeRow($id)
   {
       // Find and delete the record
       $record = ParentModel::find($id);
       if ($record) {
           $record->delete();
           session()->flash('message', 'Record successfully removed!');
       } else {
           session()->flash('error', 'Record not found'.$id);
       }

       // Refresh the parent records
       $this->parents = ParentModel::with('language')->get();
   }

   public function editRow($id)
    {
        return redirect()->route('parent.edit', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.parent-index');
    }
}
