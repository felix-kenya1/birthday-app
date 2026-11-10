<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('birthday_settings', function (Blueprint $table) { $table->id(); $table->string('key')->unique(); $table->json('value')->nullable(); $table->timestamps(); });
        Schema::create('love_letters', function (Blueprint $table) { $table->id(); $table->string('title'); $table->string('greeting')->nullable(); $table->longText('body'); $table->string('signature')->nullable(); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('reasons', function (Blueprint $table) { $table->id(); $table->string('title'); $table->string('short_text')->nullable(); $table->text('reveal_text'); $table->string('icon',40)->nullable(); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('memories', function (Blueprint $table) { $table->id(); $table->string('title'); $table->text('caption')->nullable(); $table->enum('media_type',['image','video'])->default('image'); $table->string('media_path')->nullable(); $table->string('thumbnail_path')->nullable(); $table->string('alt_text')->nullable(); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('timeline_entries', function (Blueprint $table) { $table->id(); $table->string('eyebrow')->nullable(); $table->string('title'); $table->text('description')->nullable(); $table->date('event_date')->nullable(); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('birthday_wishes', function (Blueprint $table) { $table->id(); $table->string('title')->nullable(); $table->longText('body'); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('surprises', function (Blueprint $table) { $table->id(); $table->string('title'); $table->string('subtitle')->nullable(); $table->longText('message'); $table->string('icon',40)->nullable(); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('future_dreams', function (Blueprint $table) { $table->id(); $table->string('title'); $table->longText('body'); $table->boolean('is_published')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); });
        Schema::create('music_settings', function (Blueprint $table) { $table->id(); $table->string('track_title')->nullable(); $table->string('artist')->nullable(); $table->string('audio_path')->nullable(); $table->string('cover_path')->nullable(); $table->boolean('enabled')->default(false); $table->boolean('autoplay')->default(false); $table->timestamps(); });
    }
    public function down(): void
    {
        Schema::dropIfExists('music_settings');
        Schema::dropIfExists('future_dreams');
        Schema::dropIfExists('surprises');
        Schema::dropIfExists('birthday_wishes');
        Schema::dropIfExists('timeline_entries');
        Schema::dropIfExists('memories');
        Schema::dropIfExists('reasons');
        Schema::dropIfExists('love_letters');
        Schema::dropIfExists('birthday_settings');
    }
};
