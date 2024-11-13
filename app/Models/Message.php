<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $primaryKey = 'message_id';

    protected $fillable = [
        'parent_id', 'voice_id', 'message_type_id', 'language_id', 'vaccine_date', 'vaccine_message_id', 'code', 'created_by'
    ];

    public $timestamps = false;

    public function voice(){
        return $this->belongsTo(Voice::class, 'voice_id');
    }

    public function parent(){
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    public function messageType(){
        return $this->belongsTo(MessageType::class, 'message_type_id');
    }
    public function language(){
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function vaccineMessages(){
        return $this->belongsTo(VaccineMessage::class, 'vaccine_message_id');
    }


}
