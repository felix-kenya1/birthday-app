<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FutureDream extends Model
{
    protected $table = 'future_dreams';
    protected $fillable = ['title','body','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
