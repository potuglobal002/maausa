<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_pathways', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120);
            $table->string('description', 300)->nullable();
            $table->string('icon', 80)->default('volunteer_activism');
            $table->string('link_url', 1000);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['page_id', 'is_active', 'sort_order']);
        });

        $pageId = DB::table('pages')->where('slug', 'home')->value('id');
        if (! $pageId) return;

        $now = now();
        DB::table('home_pathways')->insert([
            [
                'page_id' => $pageId,
                'title' => 'Child & family support',
                'description' => 'Guidance, resources and empathetic support for your family.',
                'icon' => 'family_restroom',
                'link_url' => '/contact-us',
                'sort_order' => 10,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page_id' => $pageId,
                'title' => 'Mothers\' well-being',
                'description' => 'Care, connection and tools to support your well-being.',
                'icon' => 'spa',
                'link_url' => '#programs',
                'sort_order' => 20,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page_id' => $pageId,
                'title' => 'Community & events',
                'description' => 'Gather, learn and grow with other mothers and families.',
                'icon' => 'calendar_month',
                'link_url' => '#community',
                'sort_order' => 30,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pathways');
    }
};
