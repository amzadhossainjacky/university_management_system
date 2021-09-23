<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterCourse extends Model
{
    //
    protected $fillable = [
        'rc_userId','rc_courseId','rc_status','rc_complete'
    ];
}
