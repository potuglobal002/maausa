<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('navigation_items', function (Blueprint $table): void {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->string('location')->default('main')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('target', 20)->default('_self');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
};
