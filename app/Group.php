<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $guarded = ['id'];

    protected $fillable = [
        'userid','lessonid','groupid','created_at','updated_at'
    ];
}
