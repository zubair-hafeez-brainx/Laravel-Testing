<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * For getting the nested childrens
     */
    public function children()
    {
        return $this->hasMany('MenuItem')->with('children');
    }
}
