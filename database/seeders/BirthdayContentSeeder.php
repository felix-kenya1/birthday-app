<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{LoveLetter,Reason,TimelineEntry,BirthdayWish,Surprise,FutureDream,MusicSetting};

class BirthdayContentSeeder extends Seeder
{
    public function run(): void
    {
        if (!LoveLetter::exists()) LoveLetter::create(['title'=>'Some feelings are too big for a text.','greeting'=>'DEAR YOU,','body'=>'On your birthday, I want you to see yourself the way I see you: wonderfully unique, deeply precious, and worthy of every good thing life has to offer. Replace this sample with your own words.','signature'=>'With all my heart, your person ♡']);
        if (!Reason::exists()) foreach ([['Your light','The way you brighten a room.','You make ordinary days feel beautiful just by being yourself.'],['Your heart','The kindness you carry.','Your softness is strength.'],['Your magic','The little things only you do.','Your laugh and your expressions are my favourite.']] as $i=>$r) Reason::create(['title'=>$r[0],'short_text'=>$r[1],'reveal_text'=>$r[2],'sort_order'=>$i]);
        if (!TimelineEntry::exists()) TimelineEntry::create(['eyebrow'=>'RIGHT NOW','title'=>'A beautiful chapter','description'=>'Add the details of your own story here.']);
        if (!BirthdayWish::exists()) BirthdayWish::create(['title'=>'A birthday prayer','body'=>'May your days be filled with peace, courage, genuine happiness, and opportunities that remind you how capable you are.']);
        if (!Surprise::exists()) Surprise::create(['title'=>'Open when you need a reminder','subtitle'=>'A little truth for your heart','message'=>'You are allowed to take up space, dream loudly, rest deeply, and become everything you hope to be.']);
        if (!FutureDream::exists()) FutureDream::create(['title'=>'More beautiful pages','body'=>'To places we have not seen, stories we have not told, and ordinary afternoons that become treasured memories.']);
        if (!MusicSetting::exists()) MusicSetting::create(['track_title'=>'Your birthday soundtrack','enabled'=>false,'autoplay'=>false]);
    }
}
