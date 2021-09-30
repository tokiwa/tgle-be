<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $guarded = ['id'];

    protected $fillable = [
        'academicyear','label','lessontitle','created_at','updated_at'
    ];

}
