<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash; use Illuminate\Validation\Rule;
class UserManagementController extends Controller {
 public function index(){return view('admin.users.index',['users'=>User::orderBy('name')->paginate(20)]);}
 public function create(){return view('admin.users.form',['user'=>null]);}
 public function store(Request $r){$d=$r->validate(['name'=>'required|string|max:120','email'=>'required|email|max:180|unique:users,email','password'=>'required|string|min:12|confirmed','role'=>['required',Rule::in(['admin','editor'])],'is_active'=>'sometimes|boolean']);User::unguarded(fn()=>User::create(['name'=>$d['name'],'email'=>$d['email'],'password'=>Hash::make($d['password']),'role'=>$d['role'],'is_active'=>$r->boolean('is_active')]));return redirect()->route('admin.users.index')->with('status','Administrator account created.');}
 public function edit(User $user){return view('admin.users.form',compact('user'));}
 public function update(Request $r,User $user){$d=$r->validate(['name'=>'required|string|max:120','email'=>['required','email','max:180',Rule::unique('users')->ignore($user->id)],'password'=>'nullable|string|min:12|confirmed','role'=>['required',Rule::in(['admin','editor'])],'is_active'=>'sometimes|boolean']);if($user->id===$r->user()->id && (!$r->boolean('is_active')||$d['role']!=='admin')) return back()->withErrors(['role'=>'You cannot deactivate or demote your own account.'])->withInput();$user->name=$d['name'];$user->email=$d['email'];$user->role=$d['role'];$user->is_active=$r->boolean('is_active');if(!empty($d['password']))$user->password=Hash::make($d['password']);$user->save();return redirect()->route('admin.users.index')->with('status','Account updated.');}
 public function destroy(Request $r,User $user){abort_if($user->id===$r->user()->id,422,'You cannot delete your own account.');abort_if($user->role==='admin' && User::where('role','admin')->count()<=1,422,'At least one administrator must remain.');$user->delete();return back()->with('status','Account deleted.');}
}
