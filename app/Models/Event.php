<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function children()
    {
        return $this->hasMany('MenuItem')->with('children');
    }
}
