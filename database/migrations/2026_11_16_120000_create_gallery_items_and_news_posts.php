<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table): void {
            $table->id();
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->string('category')->default('Community');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('published')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('news_posts', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category')->default('News')->index();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->string('status')->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });

        $galleryPage = DB::table('pages')->where('slug', 'gallery')->first();
        $galleryBody = $galleryPage ? json_decode($galleryPage->body ?? '{}', true) : [];
        $images = preg_split('/\r\n|\r|\n/', $galleryBody['images'] ?? '') ?: [];
        foreach (array_values(array_filter(array_map('trim', $images))) as $index => $image) {
            DB::table('gallery_items')->insert([
                'title' => 'MAA community moment '.($index + 1), 'image' => $image,
                'alt_text' => 'MAA community gathering photograph '.($index + 1),
                'category' => $index < 5 ? 'Community' : 'Programs', 'sort_order' => ($index + 1) * 10,
                'is_featured' => $index < 2, 'status' => 'published', 'published_at' => now(),
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        $newsPage = DB::table('pages')->where('slug', 'news-pr')->first();
        $newsBody = $newsPage ? json_decode($newsPage->body ?? '{}', true) : [];
        if (! empty($newsBody['featured_title'])) {
            DB::table('news_posts')->insert([
                'slug' => Str::slug($newsBody['featured_title']), 'title' => $newsBody['featured_title'],
                'category' => $newsBody['featured_label'] ?? 'Community', 'excerpt' => $newsBody['featured_text'] ?? null,
                'body' => '<p>'.e($newsBody['featured_text'] ?? '').'</p>', 'featured_image' => $newsBody['featured_image'] ?? null,
                'image_alt' => $newsBody['featured_title'], 'author' => 'MAA', 'is_featured' => true,
                'status' => 'published', 'published_at' => now(), 'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('news_posts');
        Schema::dropIfExists('gallery_items');
    }
};
