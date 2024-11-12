<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    protected $table = 'message_types';
    protected $primaryKey = 'message_type_id';


    public function messages(){
        return $this->hasMany(Message::class);
    }
}
