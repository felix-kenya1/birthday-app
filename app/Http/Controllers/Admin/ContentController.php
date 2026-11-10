<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\{LoveLetter,Reason,Memory,TimelineEntry,BirthdayWish,Surprise,FutureDream,MusicSetting};

class ContentController extends Controller
{
    private array $types = [
        'letters'=>[LoveLetter::class,'Love letters'], 'reasons'=>[Reason::class,'Reasons'],
        'memories'=>[Memory::class,'Memories'], 'timeline'=>[TimelineEntry::class,'Timeline'],
        'wishes'=>[BirthdayWish::class,'Birthday wishes'], 'surprises'=>[Surprise::class,'Surprises'],
        'dreams'=>[FutureDream::class,'Future dreams'], 'music'=>[MusicSetting::class,'Music settings'],
    ];
    private function model(string $type): array { abort_unless(isset($this->types[$type]),404); return $this->types[$type]; }
    public function index(string $type) { [$class,$label]=$this->model($type); $items=$class::orderBy('sort_order')->latest('id')->paginate(15); return view('admin.content.index',compact('items','type','label')); }
    public function create(string $type) { [, $label]=$this->model($type); return view('admin.content.form',compact('type','label'))->with('item',null); }
    public function store(Request $request,string $type) { [$class]=$this->model($type); $data=$this->validated($request,$type); $this->handleUploads($request,$data,$type); $class::create($data); return redirect()->route('admin.content.index',$type)->with('status','Content created.'); }
    public function edit(string $type,int $id) { [$class,$label]=$this->model($type); $item=$class::findOrFail($id); return view('admin.content.form',compact('item','type','label')); }
    public function update(Request $request,string $type,int $id) { [$class]=$this->model($type); $item=$class::findOrFail($id); $data=$this->validated($request,$type); $oldFiles=$this->handleUploads($request,$data,$type,$item); $item->update($data); $this->deleteStoredFiles($oldFiles); return redirect()->route('admin.content.index',$type)->with('status','Content updated.'); }
    public function destroy(string $type,int $id) { [$class]=$this->model($type); $item=$class::findOrFail($id); $paths=collect(['media_path','thumbnail_path','audio_path','cover_path'])->map(fn($field)=>$item->{$field})->filter()->all(); $item->delete(); $this->deleteStoredFiles($paths); return back()->with('status','Content deleted.'); }
    private function validated(Request $r,string $type): array {
        $common=['is_published'=>'sometimes|boolean','sort_order'=>'nullable|integer|min:0'];
        $rules=match($type){
            'letters'=>['title'=>'required|string|max:180','greeting'=>'nullable|string|max:180','body'=>'required|string','signature'=>'nullable|string|max:180',...$common],
            'reasons'=>['title'=>'required|string|max:180','short_text'=>'nullable|string|max:255','reveal_text'=>'required|string','icon'=>'nullable|string|max:40',...$common],
            'memories'=>['title'=>'required|string|max:180','caption'=>'nullable|string','media_type'=>['required',Rule::in(['image','video'])],'alt_text'=>'nullable|string|max:255','media'=>'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480','thumbnail'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',...$common],
            'timeline'=>['eyebrow'=>'nullable|string|max:100','title'=>'required|string|max:180','description'=>'nullable|string','event_date'=>'nullable|date',...$common],
            'wishes'=>['title'=>'nullable|string|max:180','body'=>'required|string',...$common],
            'surprises'=>['title'=>'required|string|max:180','subtitle'=>'nullable|string|max:255','message'=>'required|string','icon'=>'nullable|string|max:40',...$common],
            'dreams'=>['title'=>'required|string|max:180','body'=>'required|string',...$common],
            'music'=>['track_title'=>'nullable|string|max:180','artist'=>'nullable|string|max:180','enabled'=>'sometimes|boolean','autoplay'=>'sometimes|boolean','audio'=>'nullable|file|mimes:mp3,m4a,ogg,wav|max:20480','cover'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'],
        }; return $r->validate($rules);
    }
    private function handleUploads(Request $r,array &$data,string $type,$item=null): array {
        $oldFiles = [];
        if($type==='memories') {
            foreach(['media'=>'media_path','thumbnail'=>'thumbnail_path'] as $input=>$field) {
                if($r->hasFile($input)) {
                    if($item && $item->{$field}) $oldFiles[] = $item->{$field};
                    $data[$field]=$r->file($input)->store('birthday/memories','public');
                }
            }
        }
        if($type==='music') {
            foreach(['audio'=>'audio_path','cover'=>'cover_path'] as $input=>$field) {
                if($r->hasFile($input)) {
                    if($item && $item->{$field}) $oldFiles[] = $item->{$field};
                    $data[$field]=$r->file($input)->store('birthday/music','public');
                }
            }
        }
        unset($data['media'],$data['thumbnail'],$data['audio'],$data['cover']);
        if(in_array($type,['letters','reasons','memories','timeline','wishes','surprises','dreams'])) $data['is_published']=$r->boolean('is_published');
        if($type==='music'){ $data['enabled']=$r->boolean('enabled'); $data['autoplay']=false; }
        return $oldFiles;
    }

    private function deleteStoredFiles(array $paths): void {
        foreach (array_filter($paths) as $path) {
            if (Storage::disk('public')->exists($path)) Storage::disk('public')->delete($path);
        }
    }

}
