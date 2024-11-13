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
     'vaccine_message_id',
     'voice',
     'created_by'
 ];

 public function language()
 {
   return $this->belongsTo(Language::class, 'language_id');
 }

 public function vaccineMessage(){
     return $this->belongsTo(VaccineMessage::class, 'vaccine_message_id');
 }

 public function messages()
 {
     return $this->hasMany(Message::class);
 }
 public $timestamps=false;
}
