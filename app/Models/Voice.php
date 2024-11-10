<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
 //
 protected $table='voices';
 protected $primaryKey='voice_id';

 protected $fillable = [
     'language_id',
     'title',
     'voice',
     'created_by'
 ];
 
 public function language()
 {
   return $this->belongsTo(Language::class);
 }
 public $timestamps=false;
}
