<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    protected $table='credit_transactions';
    protected $primaryKey='credit_transaction_id';

    protected $fillable =[
     'client_phone', 'credit_type', 'credits_requested', 'client_email', 'code', 'credit_amount'
    ];

    public $timestamps = false;
}
