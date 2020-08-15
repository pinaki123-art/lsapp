<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}


//$project->user 

//hasOne
//hasMany
//belongsTo
//belongsToMany

//morphMany
//morphToMany

