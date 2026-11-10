<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inquiry extends Model { protected $fillable=['name','email','subject','message','status','admin_notes','read_at']; protected $casts=['read_at'=>'datetime']; }
