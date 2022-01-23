<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobReaction extends Model
{
    protected $table = "job_reactions";

    protected $fillable = [
        "name",
        "email",
        "role",
    ];
}
