<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAula extends Model
{
    protected $table = 'StatusAula';    
    protected $fillable = ['desc'];
}
