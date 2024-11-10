<?php

namespace App\Models;

use App\Models\Voice;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table='languages';
    protected $primaryKey='language_id';

    protected $fillable = [
        'name',
    ];

    public function voices()
    {
        return $this->hasMany(Voice::class);
    }

    public $timestamps=false;
}
