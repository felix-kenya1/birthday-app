<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $table = 'reasons';
    protected $fillable = ['title','short_text','reveal_text','icon','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
