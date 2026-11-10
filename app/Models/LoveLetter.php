<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveLetter extends Model
{
    protected $table = 'love_letters';
    protected $fillable = ['title','greeting','body','signature','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
