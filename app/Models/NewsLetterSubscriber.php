<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscriber extends Model
{
    protected $table = "news_letter_subscribers";
    protected $fillable = [
        'name',
        'email',
    ];
}
