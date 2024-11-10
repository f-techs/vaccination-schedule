<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'gender',
        'created_by'
    ];

    public $timestamps=false;

}
