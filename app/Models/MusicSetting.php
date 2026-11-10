<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicSetting extends Model
{
    protected $table = 'music_settings';
    protected $fillable = ['track_title','artist','audio_path','cover_path','enabled','autoplay'];
    protected $casts = ['enabled'=>'boolean','autoplay'=>'boolean'];
}
