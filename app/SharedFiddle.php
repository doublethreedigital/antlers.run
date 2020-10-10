<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedFiddle extends Model
{
    protected $fillable = [
        'code', 'template', 'front_matter',
    ];
}
