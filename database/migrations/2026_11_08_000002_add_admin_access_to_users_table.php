<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { if (Schema::hasTable('users')) Schema::table('users', function(Blueprint $t){ if(!Schema::hasColumn('users','role')) $t->string('role',20)->default('viewer')->index(); if(!Schema::hasColumn('users','is_active')) $t->boolean('is_active')->default(true)->index(); if(!Schema::hasColumn('users','last_login_at')) $t->timestamp('last_login_at')->nullable(); }); }
 public function down(): void { if(Schema::hasTable('users')) Schema::table('users', function(Blueprint $t){ foreach(['role','is_active','last_login_at'] as $c) if(Schema::hasColumn('users',$c)) $t->dropColumn($c); }); }
};
