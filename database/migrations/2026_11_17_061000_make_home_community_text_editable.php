<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private const CONTENT = [
        'community_card_1_label' => 'Community',
        'community_card_1_title' => 'Moments that bring us together.',
        'community_card_1_text' => 'Space to connect, exchange experiences and celebrate every family.',
        'community_card_2_label' => 'Conversations',
        'community_card_2_title' => 'Support starts with being heard.',
        'community_card_2_text' => 'Real discussions, shared experiences and practical support from mothers who understand.',
    ];

    public function up(): void
    {
        $this->updateBody(false);
    }

    public function down(): void
    {
        $this->updateBody(true);
    }

    private function updateBody(bool $remove): void
    {
        $page = DB::table('pages')->where('slug', 'home')->first();
        if (! $page) return;

        $body = json_decode($page->body ?? '{}', true) ?: [];
        foreach (self::CONTENT as $key => $value) {
            if ($remove) unset($body[$key]);
            elseif (! array_key_exists($key, $body)) $body[$key] = $value;
        }

        DB::table('pages')->where('id', $page->id)->update([
            'body' => json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
        ]);
    }
};
