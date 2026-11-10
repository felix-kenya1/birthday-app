<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEntry extends Model
{
    protected $table = 'timeline_entries';
    protected $fillable = ['eyebrow','title','description','event_date','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean','event_date'=>'date'];
}
