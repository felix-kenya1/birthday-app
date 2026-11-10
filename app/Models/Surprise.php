<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surprise extends Model
{
    protected $table = 'surprises';
    protected $fillable = ['title','subtitle','message','icon','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
