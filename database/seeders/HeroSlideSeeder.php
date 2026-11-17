<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Page;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->where('slug','home')->firstOrFail();
        if (HeroSlide::query()->where('page_id',$page->id)->exists()) return;
        $slides = [
            ['Mothers for Advocacy & Awareness',"Stronger mothers.\nSupported families.\nConnected communities.",'A welcoming space for guidance, advocacy and belonging.','https://maausa.org/wp-content/uploads/2022/04/gal3-1.jpg','center center','Contact MAA','/contact-us','Discover MAA','#purpose'],
            ['Guidance for every chapter',"Clarity for today.\nConfidence for what comes next.",'Practical advocacy and culturally responsive guidance for mothers and caregivers.','https://maausa.org/wp-content/uploads/2022/04/gal-7-2.jpg','center center','Explore programs','/programs','Watch videos','/video-gallery'],
            ['A community that understands',"A village where\nevery family belongs.",'Connect through shared experiences, welcoming events and support grounded in empathy.','https://maausa.org/wp-content/uploads/2022/04/gal-7.jpg','center center','Meet our community','/gallery','Get involved','/contact-us'],
        ];
        foreach ($slides as $index=>$slide) HeroSlide::query()->create(['page_id'=>$page->id,'eyebrow'=>$slide[0],'title'=>$slide[1],'description'=>$slide[2],'image'=>$slide[3],'image_position'=>$slide[4],'primary_label'=>$slide[5],'primary_url'=>$slide[6],'secondary_label'=>$slide[7],'secondary_url'=>$slide[8],'sort_order'=>($index+1)*10,'is_active'=>true]);
    }
}
