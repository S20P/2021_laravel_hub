<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MicrobiltStore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['RqUID','api_type','response'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'response' => 'json',
    ];

}
