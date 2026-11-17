<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table): void {
            $table->id(); $table->string('disk')->default('public'); $table->string('path'); $table->string('mime_type', 120); $table->unsignedBigInteger('size'); $table->unsignedInteger('width')->nullable(); $table->unsignedInteger('height')->nullable(); $table->string('alt_text')->nullable(); $table->string('credit')->nullable(); $table->timestamps(); $table->unique(['disk', 'path']);
        });
        Schema::create('pages', function (Blueprint $table): void {
            $table->id(); $table->string('slug')->unique(); $table->string('title'); $table->longText('body')->nullable(); $table->string('status')->default('draft')->index(); $table->timestamp('published_at')->nullable()->index(); $table->string('seo_title')->nullable(); $table->text('seo_description')->nullable(); $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete(); $table->timestamps();
        });
        Schema::create('page_sections', function (Blueprint $table): void {
            $table->id(); $table->foreignId('page_id')->constrained()->cascadeOnDelete(); $table->string('type'); $table->json('content'); $table->unsignedInteger('sort_order')->default(0); $table->boolean('is_enabled')->default(true); $table->timestamps(); $table->index(['page_id', 'sort_order']);
        });
        Schema::create('programs', function (Blueprint $table): void {
            $table->id(); $table->string('slug')->unique(); $table->string('title'); $table->text('summary')->nullable(); $table->longText('body')->nullable(); $table->foreignId('image_id')->nullable()->constrained('media')->nullOnDelete(); $table->string('status')->default('draft')->index(); $table->unsignedInteger('sort_order')->default(0); $table->timestamps();
        });
        Schema::create('resources', function (Blueprint $table): void {
            $table->id(); $table->string('slug')->unique(); $table->string('title'); $table->text('summary')->nullable(); $table->longText('body')->nullable(); $table->string('format')->nullable(); $table->string('language', 10)->default('en'); $table->string('video_url')->nullable(); $table->foreignId('file_id')->nullable()->constrained('media')->nullOnDelete(); $table->string('status')->default('draft')->index(); $table->timestamp('published_at')->nullable()->index(); $table->timestamps();
        });
        Schema::create('events', function (Blueprint $table): void {
            $table->id(); $table->string('slug')->unique(); $table->string('title'); $table->longText('body')->nullable(); $table->timestamp('starts_at')->index(); $table->timestamp('ends_at')->nullable(); $table->string('timezone')->default('America/New_York'); $table->string('venue')->nullable(); $table->unsignedInteger('capacity')->nullable(); $table->boolean('registration_enabled')->default(false); $table->string('status')->default('draft')->index(); $table->foreignId('image_id')->nullable()->constrained('media')->nullOnDelete(); $table->timestamps();
        });
        Schema::create('inquiries', function (Blueprint $table): void {
            $table->id(); $table->string('type')->index(); $table->string('name'); $table->string('email')->nullable(); $table->string('phone')->nullable(); $table->text('message'); $table->string('status')->default('new')->index(); $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete(); $table->timestamp('consent_at'); $table->timestamp('handled_at')->nullable(); $table->timestamps();
        });
        Schema::create('settings', function (Blueprint $table): void { $table->id(); $table->string('key')->unique(); $table->json('value')->nullable(); $table->timestamps(); });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings'); Schema::dropIfExists('inquiries'); Schema::dropIfExists('events'); Schema::dropIfExists('resources'); Schema::dropIfExists('programs'); Schema::dropIfExists('page_sections'); Schema::dropIfExists('pages'); Schema::dropIfExists('media');
    }
};
