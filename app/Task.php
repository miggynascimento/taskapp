<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['title', 'description'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function getCompletedAttribute($value)
    {
        return (boolean) $value;
    }
}
