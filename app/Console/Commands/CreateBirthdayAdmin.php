<?php
namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateBirthdayAdmin extends Command {
    protected $signature = 'birthday:make-admin {name} {email}';
    protected $description = 'Create an administrator for the birthday website';
    public function handle(): int {
        $email = strtolower($this->argument('email'));
        if (User::where('email',$email)->exists()) { $this->error('That email already exists.'); return self::FAILURE; }
        $password = $this->secret('Enter a strong password (at least 12 characters)');
        if (!is_string($password) || strlen($password) < 12) { $this->error('Password must be at least 12 characters.'); return self::FAILURE; }
        User::unguarded(fn()=>User::create(['name'=>$this->argument('name'),'email'=>$email,'password'=>Hash::make($password),'role'=>'admin','is_active'=>true]));
        $this->info('Administrator account created.'); return self::SUCCESS;
    }
}
