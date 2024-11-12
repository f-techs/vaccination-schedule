<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class ParentModel extends Model
{
    //
    protected $table='parents';
    protected $primaryKey='parent_id';

    protected $fillable = [
        'parent_name',
        'child_name',
        'mobile_number',
        'date_of_birth',
        'email',
        'language_id',
        'gender',
        'created_by'
    ];

    public function language(){
        return $this->belongsTo(Language::class, 'language_id');
}

public function messages(){
        return $this->hasMany(Message::class);
}

    public $timestamps=false;

}
