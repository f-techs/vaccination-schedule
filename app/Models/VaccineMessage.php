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
    ];
}
