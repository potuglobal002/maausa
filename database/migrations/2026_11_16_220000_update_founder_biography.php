<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'who-we-are')->first();

        if (! $page) {
            return;
        }

        $body = json_decode($page->body ?? '{}', true) ?: [];
        $body = array_merge($body, [
            'founder_name' => 'Anowara Aana Aman',
            'founder_credentials' => 'MA, LCAT-LP',
            'founder_role' => 'Founder · Art therapist · Artist · Mental health advocate and practitioner',
            'founder_intro_1' => 'I am Anowara Aman, MA, LCAT-LP, an art therapist, artist, mental health advocate and practitioner.',
            'founder_intro_2' => 'My clinical experience includes working with children, adolescents, and adults across community, residential, and inpatient mental health settings. I have worked with individuals with a wide range of emotional, developmental, and communication needs, with a particular interest in supporting autistic and neurodivergent individuals and their families.',
            'founder_intro_3' => 'My interest in neurodiversity advocacy grew from my own experience as a mother of neurodivergent children. I began educating myself about neurodiversity, learning from professionals, families, and—most importantly—from neurodivergent individuals themselves.',
            'founder_intro_4' => 'As an artist, I have experienced personally how powerful the creative process can be. I believe art can offer another way to communicate—helping us express what may be difficult to put into words, discover our strengths, build connections, and tell our stories.',
        ]);

        DB::table('pages')->where('id', $page->id)->update([
            'body' => json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // Content migrations are intentionally non-destructive.
    }
};
