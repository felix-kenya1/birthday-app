<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthdayWish extends Model
{
    protected $table = 'birthday_wishes';
    protected $fillable = ['title','body','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
