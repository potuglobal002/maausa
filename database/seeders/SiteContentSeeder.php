<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => ['Home', [
                'hero_eyebrow' => 'Mothers for Advocacy & Awareness',
                'hero_title' => "Stronger mothers.\nSupported families.\nConnected communities.",
                'hero_lead' => 'A welcoming space for guidance, advocacy and belonging.',
                'hero_image' => 'https://maausa.org/wp-content/uploads/2022/04/gal3-1.jpg',
                'hero_image_position' => 'center center',
                'hero_primary_label' => 'Contact MAA', 'hero_primary_url' => '/contact-us',
                'hero_secondary_label' => 'Discover MAA', 'hero_secondary_url' => '#purpose',
                'purpose_label' => '01 / Our purpose', 'purpose_title' => "You deserve\na village.",
                'purpose_text' => 'Motherhood brings questions, challenges and extraordinary moments. MAA connects mothers and caregivers with understanding, advocacy and community.',
                'purpose_image' => 'https://maausa.org/wp-content/uploads/2022/04/gal3-1.jpg',
                'purpose_card_title' => 'Rooted in understanding.', 'purpose_card_text' => 'Culturally responsive support, resources and advocacy for South Asian families.',
                'programs_label' => '02 / Our services', 'programs_title' => 'Guidance for every chapter.', 'programs_intro' => 'Practical, compassionate guidance for neurodivergent individuals and the families who support them.',
                'program_1_title' => 'Understanding & accepting a diagnosis', 'program_1_text' => 'Compassionate guidance to help families understand a diagnosis, process what it means and move forward with confidence.',
                'program_2_title' => 'Assessment & early diagnosis', 'program_2_text' => 'Support with getting started, understanding assessment pathways and identifying appropriate next steps for an early diagnosis.',
                'program_3_title' => 'Early intervention consultation', 'program_3_text' => 'Practical consultation on how to begin early intervention services and prepare for conversations with service providers.',
                'program_4_title' => 'IEP meeting support', 'program_4_text' => 'Preparation and advocacy support to help families participate confidently in Individualized Education Program meetings.',
                'program_5_title' => 'Social group activities', 'program_5_text' => 'Inclusive social activities where neurodivergent children can connect, participate and build confidence in a welcoming environment.',
                'program_6_title' => 'Special webinars', 'program_6_text' => 'Accessible webinars featuring practical information, professional perspectives and relevant guidance for families and caregivers.',
                'program_7_title' => 'CPSE & Turning 5 guidance', 'program_7_text' => 'Guidance for understanding CPSE and preparing for the Turning 5 transition into school-age services.',
                'program_8_title' => 'Mass awareness events', 'program_8_text' => 'Community awareness initiatives that encourage understanding, acceptance and meaningful inclusion.',
                'community_label' => '03 / Our community', 'community_title' => 'Small moments. Stronger connections.',
                'community_image_1' => 'https://maausa.org/wp-content/uploads/2022/04/gal-7-2.jpg', 'community_image_2' => 'https://maausa.org/wp-content/uploads/2022/04/gal-7.jpg',
                'cta_title' => "Let’s build\nthe village.\nTogether.", 'cta_text' => 'Your time, voice and support can make a difference.',
            ]],
            'who-we-are' => ['Who We Are', [
                'hero_eyebrow' => 'Who we are', 'hero_title' => 'A village built around mothers.', 'hero_description' => 'MAA helps mothers and caregivers find guidance, advocate for their children and feel supported by a community that understands.',
                'founder_image' => 'https://maausa.org/wp-content/uploads/2022/04/mam-pic.png', 'founder_name' => 'Anowara Aana Aman',
                'founder_credentials' => 'MA, LCAT-LP', 'founder_role' => 'Founder · Art therapist · Artist · Mental health advocate and practitioner',
                'founder_intro_1' => 'I am Anowara Aman, MA, LCAT-LP, an art therapist, artist, mental health advocate and practitioner.',
                'founder_intro_2' => 'My clinical experience includes working with children, adolescents, and adults across community, residential, and inpatient mental health settings. I have worked with individuals with a wide range of emotional, developmental, and communication needs, with a particular interest in supporting autistic and neurodivergent individuals and their families.',
                'founder_intro_3' => 'My interest in neurodiversity advocacy grew from my own experience as a mother of neurodivergent children. I began educating myself about neurodiversity, learning from professionals, families, and—most importantly—from neurodivergent individuals themselves.',
                'founder_intro_4' => 'As an artist, I have experienced personally how powerful the creative process can be. I believe art can offer another way to communicate—helping us express what may be difficult to put into words, discover our strengths, build connections, and tell our stories.',
                'stats_eyebrow' => 'Our impact', 'stats_title' => 'A growing village of support.', 'stats_intro' => 'Every number represents a family reached, a conversation started and a stronger community built together.',
                'stat_1_value' => '2', 'stat_1_suffix' => '+', 'stat_1_label' => 'Years in Charity',
                'stat_2_value' => '20', 'stat_2_suffix' => '+', 'stat_2_label' => 'Staff Members',
                'stat_3_value' => '2', 'stat_3_suffix' => '+', 'stat_3_label' => 'Countries',
                'stat_4_value' => '200', 'stat_4_suffix' => '+', 'stat_4_label' => 'People Helped',
                'story_title' => 'Every mother deserves to be heard.',
                'story_1' => 'Across the world, mothers are connected by a common priority: the well-being of their children. Mothers are often their children’s strongest advocates and, at times, their only voice.',
                'story_2' => 'Mothers for Advocacy & Awareness (MAA) is a nonprofit organization that supports mothers and caregivers with practical resources throughout motherhood. Alongside caring for children’s mental and physical health, MAA recognizes that caregivers also need support for their own mental well-being.',
                'story_3' => 'MAA provides a welcoming, judgment-free community where mothers can share opinions, struggles, frustrations and achievements. Through honest conversation and connection, mothers can encourage and inspire others travelling a similar path.',
                'story_4' => 'Families of neurodivergent children can feel overwhelmed while navigating diagnosis, education and therapy. Cultural and language barriers may make it harder to understand available services, seek appropriate guidance and advocate confidently for a child’s rights.',
                'story_5' => 'MAA helps mothers and caregivers navigate systems, understand Individualized Education Programs and identify appropriate services. With particular attention to South Asian families, MAA works to reduce cultural and language barriers so families feel informed, connected and supported at every step.',
                'quote' => "It takes a village to raise a child. Let's build the village.",
                'mission' => 'To support mothers and caregivers with culturally responsive resources, practical guidance and advocacy throughout motherhood, helping families understand services and make informed decisions.',
                'vision' => 'A welcoming, judgment-free community where mothers can share struggles, achievements and ideas, and where neurodivergent individuals and their families feel understood, connected and empowered.',
                'nonprofit' => 'MAA is a federally recognized 501(c)(3) tax-exempt nonprofit organization. Contributions are tax-deductible to the fullest extent permitted by law.',
            ]],
            'gallery' => ['Gallery', [
                'hero_eyebrow' => 'Our gallery', 'hero_title' => 'Moments that connect our community.', 'hero_description' => 'A look at MAA gatherings, advocacy programs, family activities and the people who make the village stronger.',
                'images' => implode("\n", [
                    'https://maausa.org/wp-content/uploads/2022/04/gal4.jpg', 'https://maausa.org/wp-content/uploads/2022/08/20.jpg',
                    'https://maausa.org/wp-content/uploads/2022/04/gal-9-1.jpg', 'https://maausa.org/wp-content/uploads/2022/04/gal3-1.jpg',
                    'https://maausa.org/wp-content/uploads/2022/04/gal-4.jpg', 'https://maausa.org/wp-content/uploads/2022/04/gal-2-1.jpg',
                    'https://maausa.org/wp-content/uploads/2022/04/gal-1-1.jpg', 'https://maausa.org/wp-content/uploads/2022/04/gal-19.jpg',
                    'https://maausa.org/wp-content/uploads/2022/04/gal-14.jpg', 'https://maausa.org/wp-content/uploads/2022/04/gal-16.jpg',
                    'https://maausa.org/wp-content/uploads/2022/08/15.jpg', 'https://maausa.org/wp-content/uploads/2022/08/6.jpg',
                ]),
            ]],
            'video-gallery' => ['Video Gallery', [
                'hero_eyebrow' => 'Video gallery', 'hero_title' => 'Stories, guidance and shared voices.', 'hero_description' => 'Explore conversations and community moments created to inform, encourage and connect mothers and caregivers.',
                'video_1_title' => 'Community conversations', 'video_1_text' => 'Stories and conversations that help mothers and caregivers feel heard and connected.', 'video_1_image' => 'https://maausa.org/wp-content/uploads/2022/04/gal-7.jpg',
                'video_2_title' => 'Advocacy and guidance', 'video_2_text' => 'Practical discussions about understanding services and advocating for children and families.', 'video_2_image' => 'https://maausa.org/wp-content/uploads/2022/04/gal3-1.jpg',
                'video_3_title' => 'Events and awareness', 'video_3_text' => 'Highlights from community programs, awareness activities and family gatherings.', 'video_3_image' => 'https://maausa.org/wp-content/uploads/2022/08/20.jpg',
                'archive_title' => 'More MAA videos are being prepared for the new library.', 'archive_text' => 'The original video gallery remains available while verified video links, captions and descriptions are organized for this website.',
            ]],
            'news-pr' => ['News & PR', [
                'hero_eyebrow' => 'News & public relations', 'hero_title' => 'Updates from the MAA village.', 'hero_description' => 'Community news, program announcements, public awareness initiatives and media information.',
                'featured_image' => 'https://maausa.org/wp-content/uploads/2022/08/20.jpg', 'featured_label' => 'Community program', 'featured_title' => 'Mental Health Matters',
                'featured_text' => 'MAA Foundation and Shetu Foundation brought parents, caregivers, service providers and community leaders together to discuss mental health and share resources for South Asian families in New York.',
                'program_focus' => 'Understanding, acceptance and action', 'community' => 'Parents and caregivers of neurodivergent family members',
                'press_title' => 'Connect with MAA.', 'press_text' => 'For interviews, program information, partnerships and press inquiries, contact the MAA team.',
            ]],
            'contact-us' => ['Contact Us', [
                'hero_eyebrow' => 'Contact MAA', 'hero_title' => 'Start a conversation.', 'hero_description' => 'Have a question, need guidance or want to work with MAA? Our team is ready to listen.',
                'form_title' => 'How can we support you?',
            ]],
            'programs' => ['Programs', [
                'hero_eyebrow' => 'Our services', 'hero_title' => 'Guidance for every chapter.', 'hero_description' => 'Practical support designed around the real questions and needs of neurodivergent individuals, mothers, caregivers and families.',
                'programs_label' => 'How we help', 'programs_title' => 'Support that meets families where they are.', 'programs_intro' => 'From understanding a diagnosis to navigating educational services and finding community, MAA helps families take the next step with greater clarity and confidence.',
                'program_1_title' => 'Understanding & accepting a diagnosis', 'program_1_text' => 'Compassionate guidance to help families understand a diagnosis, process what it means and move forward with confidence.',
                'program_2_title' => 'Assessment & early diagnosis', 'program_2_text' => 'Support with getting started, understanding assessment pathways and identifying appropriate next steps for an early diagnosis.',
                'program_3_title' => 'Early intervention consultation', 'program_3_text' => 'Practical consultation on how to begin early intervention services and prepare for conversations with service providers.',
                'program_4_title' => 'IEP meeting support', 'program_4_text' => 'Preparation and advocacy support to help families participate confidently in Individualized Education Program meetings.',
                'program_5_title' => 'Social group activities', 'program_5_text' => 'Inclusive social activities where neurodivergent children can connect, participate and build confidence in a welcoming environment.',
                'program_6_title' => 'Special webinars', 'program_6_text' => 'Accessible webinars featuring practical information, professional perspectives and relevant guidance for families and caregivers.',
                'program_7_title' => 'CPSE & Turning 5 guidance', 'program_7_text' => 'Guidance for understanding CPSE and preparing for the Turning 5 transition into school-age services.',
                'program_8_title' => 'Mass awareness events', 'program_8_text' => 'Community awareness initiatives that encourage understanding, acceptance and meaningful inclusion.',
            ]],
            'events' => ['Events', ['hero_eyebrow' => 'Community events', 'hero_title' => 'Gather, learn and connect.', 'hero_description' => 'Upcoming MAA programs and community gatherings.', 'content_title' => 'New events will appear here.', 'content_body' => 'Event details and registration availability will be managed by the MAA team.']],
            'get-involved' => ['Get Involved', ['hero_eyebrow' => 'Get involved', 'hero_title' => 'Help us build the village.', 'hero_description' => 'Share your time, knowledge or partnership to strengthen support for families.', 'content_title' => 'Partner with MAA.', 'content_body' => 'Volunteer and partnership opportunities will be published through the CMS.']],
            'donate' => ['Donate', ['hero_eyebrow' => 'Support MAA', 'hero_title' => 'Your support strengthens the village.', 'hero_description' => 'Help MAA continue providing advocacy, resources and community connection.', 'content_title' => 'Make an impact.', 'content_body' => 'Donation information and the verified hosted giving link will be managed here.']],
        ];

        foreach ($pages as $slug => [$title, $body]) {
            Page::query()->updateOrCreate(['slug' => $slug], ['title' => $title, 'body' => $body, 'status' => 'published', 'published_at' => now()]);
        }

        $navigation = [
            ['Who we are', '/who-we-are', 'main', 10], ['Gallery', '/gallery', 'both', 20], ['Videos', '/video-gallery', 'both', 30],
            ['News & PR', '/news-pr', 'both', 40], ['Contact', '/contact-us', 'both', 50], ['Programs', '/programs', 'footer', 60],
        ];
        foreach ($navigation as [$label, $url, $location, $order]) {
            NavigationItem::query()->updateOrCreate(['url' => $url, 'location' => $location], ['label' => $label, 'sort_order' => $order, 'target' => '_self', 'is_active' => true]);
        }

        foreach ([
            'site_name' => 'Mothers for Advocacy & Awareness', 'logo_text' => 'Maa', 'logo_path' => '/images/maa-logo.png', 'email' => 'info@maausa.org',
            'phone' => '(347) 394-2979', 'phone_link' => '+13473942979', 'address' => "Commonwealth Blvd\nBellerose, NY 11426",
            'footer_description' => 'A nonprofit creating a welcoming space for mothers and families through advocacy, guidance and culturally responsive support.',
        ] as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
