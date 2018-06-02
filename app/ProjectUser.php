<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillabel = [
        'project_id',
        'user_id',
    ];
}
