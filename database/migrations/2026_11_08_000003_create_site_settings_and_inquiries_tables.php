<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
 Schema::create('site_settings',function(Blueprint $t){$t->id();$t->string('key')->unique();$t->longText('value')->nullable();$t->timestamps();});
 Schema::create('inquiries',function(Blueprint $t){$t->id();$t->string('name',120);$t->string('email',180);$t->string('subject',180)->nullable();$t->longText('message');$t->string('status',20)->default('new')->index();$t->text('admin_notes')->nullable();$t->timestamp('read_at')->nullable();$t->timestamps();});
 } public function down(): void {Schema::dropIfExists('inquiries');Schema::dropIfExists('site_settings');}};
