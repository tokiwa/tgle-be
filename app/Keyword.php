<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    // protected $table = 'keywords';

    protected $guarded = ['id'];

    protected $fillable = [
        'userid','keyword','lessonid','created_at','updated_at','sessionid'
    ];


}
