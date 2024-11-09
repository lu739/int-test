<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BindLog extends Model
{
    protected $fillable = [
        'lead_id',
        'message',
        'is_success'
    ];
}
