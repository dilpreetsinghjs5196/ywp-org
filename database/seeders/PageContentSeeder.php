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

            // Work with YWP
            ['page' => 'work-with-ywp', 'section' => 'header', 'key' => 'title', 'value' => 'Work with YWP', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/campaigns-1-5.jpg', 'type' => 'image'],
            
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'intro', 'value' => 'Recruitment for any position at YWP; follows a 4 Tier-process', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'round_1', 'value' => 'Round 1: Application Screening', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'round_2', 'value' => 'Round 2: HR- Round', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'round_3', 'value' => 'Round 3: Technical Round (with the department head)', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'round_4', 'value' => 'Round 4: Founder\'s Round', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'recruitment_process', 'key' => 'footer_note', 'value' => 'We don\'t intimate about rejected applications. Best of luck!', 'type' => 'text'],

            ['page' => 'work-with-ywp', 'section' => 'form_content', 'key' => 'tagline', 'value' => 'Work with us', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'form_content', 'key' => 'title', 'value' => 'YWP; Recruitment Form \'23', 'type' => 'text'],
            ['page' => 'work-with-ywp', 'section' => 'form_content', 'key' => 'description_1', 'value' => 'You\'re Wonderful Project; is a registered trust (2017) that works on mental health awareness, increasing the accessibility of mental health services and providing peer support. On the ground, we execute this through a strong research-oriented course of action, and a range of events and campaigns. We have support teams in the organization which help in enabling this process, namely, the Design team, the Research and Development team, the Fundraising team, HR, the Creative (content) team, the Events team, the Merchandise team and the Photography & Videography team.', 'type' => 'textarea'],
            ['page' => 'work-with-ywp', 'section' => 'form_content', 'key' => 'description_2', 'value' => 'You will be asked for your preference of departments, below. However, that doesn\'t necessarily imply you getting into the departments of only your choice. After a meticulous interview process, the organisation would deem it appropriate as to what department might suit you the best. Please note that this is a 6- month volunteer opportunity. This can be extended as per your wishes and motivation to work with the organization', 'type' => 'textarea'],
        ];

        foreach ($contents as $content) {
            \App\Models\PageContent::updateOrCreate(
                ['page' => $content['page'], 'section' => $content['section'], 'key' => $content['key']],
                ['value' => $content['value'], 'type' => $content['type']]
            );
        }
    }
}
