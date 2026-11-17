<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('eyebrow')->nullable();
            $table->text('title');
            $table->text('description')->nullable();
            $table->string('image', 1200);
            $table->string('image_position')->default('center center');
            $table->string('primary_label')->nullable();
            $table->string('primary_url', 1000)->nullable();
            $table->string('secondary_label')->nullable();
            $table->string('secondary_url', 1000)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['page_id', 'is_active', 'sort_order']);
        });
    }

    public function down(): void { Schema::dropIfExists('hero_slides'); }
};
