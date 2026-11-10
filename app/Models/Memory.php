<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $table = 'memories';
    protected $fillable = ['title','caption','media_type','media_path','thumbnail_path','alt_text','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean'];
}
