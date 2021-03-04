<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    protected $fillable =[
        'id',
        'name',
        'note',
        'due_date',
        'status'
    ];
}
