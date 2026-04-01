<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            // Home Hero
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide1_title', 'value' => 'Lend a <br> Helping Hand <br> & get involved.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide1_subtitle', 'value' => 'We are here to support you every step of the way', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide1_image', 'value' => 'images/slider-main-1.jpg', 'type' => 'image'],

            ['page' => 'home', 'section' => 'hero', 'key' => 'slide2_title', 'value' => 'SPEAK Campaign', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide2_subtitle', 'value' => 'We are here to support you every step of the way', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide2_image', 'value' => 'images/slider-main-2.jpg', 'type' => 'image'],

            ['page' => 'home', 'section' => 'hero', 'key' => 'slide3_title', 'value' => 'Wonder Store', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide3_subtitle', 'value' => 'We are here to support you every step of the way', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'slide3_image', 'value' => 'images/slider-main-3.jpg', 'type' => 'image'],

            // We Believe
            ['page' => 'home', 'section' => 'we_believe', 'key' => 'tagline', 'value' => 'Welcome to YWP;', 'type' => 'text'],
            ['page' => 'home', 'section' => 'we_believe', 'key' => 'title', 'value' => 'We believe that we can save <br> more lives with you', 'type' => 'textarea'],

            // Welcome One
            ['page' => 'home', 'section' => 'welcome_one', 'key' => 'title', 'value' => 'YWP; is creating a safe space for the youth.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'welcome_one', 'key' => 'description', 'value' => 'We at YWP; believe in providing a safe space to individuals struggling with mental health issues to give expression to their distressing feelings and thoughts without judgment and stigma. As such our work so far has not only included giving people a platform to share their stories but also provide peer counselling in view of curbing growing cases of suicide and self-harm.', 'type' => 'textarea'],

            // Gallery
            ['page' => 'gallery', 'section' => 'header', 'key' => 'title', 'value' => 'Gallery', 'type' => 'text'],
            ['page' => 'gallery', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/gallery/gal-head.jpg', 'type' => 'image'],
        ];

        foreach ($contents as $content) {
            \App\Models\PageContent::updateOrCreate(
                ['page' => $content['page'], 'section' => $content['section'], 'key' => $content['key']],
                ['value' => $content['value'], 'type' => $content['type']]
            );
        }
    }
}
