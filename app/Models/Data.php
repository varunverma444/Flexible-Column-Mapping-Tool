<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
        'user_id',
        'column1',
        'column2',
        'column3',
        'column4',
        'column5',
    ];
}
