<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    // protected $table = 'keywords';

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id','keyword','lesson_id','created_at','updated_at'
    ];


}
