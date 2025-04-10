<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upskill extends Model
{
    use SoftDeletes;

    protected $table = 'upskill'; // 👈 Specify the correct table name

    protected $fillable = [
        'name', 'email', 'phone', 'message',
    ];
    
}
