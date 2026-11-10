<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\{LoveLetter,Reason,Memory,TimelineEntry,BirthdayWish,Surprise,FutureDream,MusicSetting,SiteSetting};

class BirthdayController extends Controller
{
    public function welcome(): View { return view('public.welcome'); }
    public function show(): View
    {
        return view('public.birthday', [
            'section'=>'birthday',
            'siteSettings'=>SiteSetting::query()->pluck('value', 'key'),
            'letter'=>LoveLetter::where('is_published',true)->orderBy('sort_order')->first(),
            'reasons'=>Reason::where('is_published',true)->orderBy('sort_order')->get(),
            'memories'=>Memory::where('is_published',true)->orderBy('sort_order')->get(),
            'timeline'=>TimelineEntry::where('is_published',true)->orderBy('sort_order')->get(),
            'wishes'=>BirthdayWish::where('is_published',true)->orderBy('sort_order')->get(),
            'surprises'=>Surprise::where('is_published',true)->orderBy('sort_order')->get(),
            'dreams'=>FutureDream::where('is_published',true)->orderBy('sort_order')->get(),
            'music'=>MusicSetting::where('enabled',true)->latest('id')->first(),
        ]);
    }
    public function section(string $section): View { return $this->show(); }
}
