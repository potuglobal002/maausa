<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $services = [
            ['Understanding & accepting a diagnosis', 'Compassionate guidance to help families understand a diagnosis, process what it means and move forward with confidence.'],
            ['Assessment & early diagnosis', 'Support with getting started, understanding assessment pathways and identifying appropriate next steps for an early diagnosis.'],
            ['Early intervention consultation', 'Practical consultation on how to begin early intervention services and prepare for conversations with service providers.'],
            ['IEP meeting support', 'Preparation and advocacy support to help families participate confidently in Individualized Education Program meetings.'],
            ['Social group activities', 'Inclusive social activities where neurodivergent children can connect, participate and build confidence in a welcoming environment.'],
            ['Special webinars', 'Accessible webinars featuring practical information, professional perspectives and relevant guidance for families and caregivers.'],
            ['CPSE & Turning 5 guidance', 'Guidance for understanding CPSE and preparing for the Turning 5 transition into school-age services.'],
            ['Mass awareness events', 'Community awareness initiatives that encourage understanding, acceptance and meaningful inclusion.'],
        ];

        $this->updatePage('home', [
            'programs_label' => '02 / Our services',
            'programs_title' => 'Guidance for every chapter.',
            'programs_intro' => 'Practical, compassionate guidance for neurodivergent individuals and the families who support them.',
        ], $services);

        $this->updatePage('programs', [
            'hero_eyebrow' => 'Our services',
            'hero_title' => 'Guidance for every chapter.',
            'hero_description' => 'Practical support designed around the real questions and needs of neurodivergent individuals, mothers, caregivers and families.',
            'programs_label' => 'How we help',
            'programs_title' => 'Support that meets families where they are.',
            'programs_intro' => 'From understanding a diagnosis to navigating educational services and finding community, MAA helps families take the next step with greater clarity and confidence.',
        ], $services);
    }

    private function updatePage(string $slug, array $section, array $services): void
    {
        $page = DB::table('pages')->where('slug', $slug)->first();
        if (! $page) return;

        $body = array_merge(json_decode($page->body ?? '{}', true) ?: [], $section);
        foreach ($services as $index => [$title, $description]) {
            $number = $index + 1;
            $body["program_{$number}_title"] = $title;
            $body["program_{$number}_text"] = $description;
        }

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
