<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private function updatedServices(): array
    {
        return [
            1 => [
                'title' => 'Understanding & Navigating a Diagnosis',
                'text' => 'Compassionate guidance to help families understand a diagnosis, navigate what it means and move forward with clarity and confidence.',
            ],
            2 => [
                'title' => 'Developmental Screening & Evaluation Guidance',
                'text' => 'Guidance on developmental screening, evaluation pathways and the next steps families can take to access appropriate support.',
            ],
            3 => [
                'title' => 'Early Intervention Guidance',
                'text' => 'Practical guidance on beginning early intervention services and preparing for conversations with providers and support teams.',
            ],
            4 => [
                'title' => 'IEP Advocacy & Meeting Support',
                'text' => 'Preparation and advocacy support to help families participate confidently in Individualized Education Program meetings.',
            ],
            5 => [
                'title' => 'Inclusive Social & Community Activities',
                'text' => 'Welcoming activities where neurodivergent children and families can connect, participate and build confidence together.',
            ],
            6 => [
                'title' => 'Parent Education & Resource Workshops',
                'text' => 'Accessible learning sessions and practical resource workshops designed for parents, caregivers and families.',
            ],
            7 => [
                'title' => 'CPSE, CSE & Turning Five Guidance',
                'text' => 'Guidance for understanding CPSE and CSE processes and preparing for the Turning Five transition into school-age services.',
            ],
            8 => [
                'title' => 'Community Awareness & Advocacy Events',
                'text' => 'Community events that promote awareness, strengthen advocacy and encourage meaningful understanding, acceptance and inclusion.',
            ],
        ];
    }

    private function previousServices(): array
    {
        return [
            1 => ['title' => 'Understanding & accepting a diagnosis', 'text' => 'Compassionate guidance to help families understand a diagnosis, process what it means and move forward with confidence.'],
            2 => ['title' => 'Assessment & early diagnosis', 'text' => 'Support with getting started, understanding assessment pathways and identifying appropriate next steps for an early diagnosis.'],
            3 => ['title' => 'Early intervention consultation', 'text' => 'Practical consultation on how to begin early intervention services and prepare for conversations with service providers.'],
            4 => ['title' => 'IEP meeting support', 'text' => 'Preparation and advocacy support to help families participate confidently in Individualized Education Program meetings.'],
            5 => ['title' => 'Social group activities', 'text' => 'Inclusive social activities where neurodivergent children can connect, participate and build confidence in a welcoming environment.'],
            6 => ['title' => 'Special webinars', 'text' => 'Accessible webinars featuring practical information, professional perspectives and relevant guidance for families and caregivers.'],
            7 => ['title' => 'CPSE & Turning 5 guidance', 'text' => 'Guidance for understanding CPSE and preparing for the Turning 5 transition into school-age services.'],
            8 => ['title' => 'Mass awareness events', 'text' => 'Community awareness initiatives that encourage understanding, acceptance and meaningful inclusion.'],
        ];
    }

    public function up(): void
    {
        $this->applyServices($this->updatedServices());
    }

    public function down(): void
    {
        $this->applyServices($this->previousServices());
    }

    private function applyServices(array $services): void
    {
        DB::table('pages')->whereIn('slug', ['home', 'programs'])->get()->each(function ($page) use ($services): void {
            $body = json_decode($page->body ?? '{}', true) ?: [];
            foreach ($services as $number => $service) {
                $body["program_{$number}_title"] = $service['title'];
                $body["program_{$number}_text"] = $service['text'];
            }

            DB::table('pages')->where('id', $page->id)->update([
                'body' => json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);
        });
    }
};
