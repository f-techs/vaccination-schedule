<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccineMessage extends Model
{
    protected $table = 'vaccine_messages';
    protected $primaryKey = 'vaccine_message_id';
    public $timestamps =false;
    protected $fillable = [
        'title',
        'message_body',
        'code'
    ];

    public function voices(){
        return $this->hasMany(Voice::class);
    }

    public function voiceMessages()
    {
        return $this->hasManyThrough(Message::class, Voice::class,
            'vaccine_message_id', 'voice_id', 'vaccine_message_id', 'voice_id'
        );
    }
}
