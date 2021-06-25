<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    protected $fillable = ['name','email','amount','currency','transaction_id','payment_status','receipt_url','transaction_complete_details'];

}
