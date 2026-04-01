<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class OurMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            // Header section
            ['page' => 'our-mission', 'section' => 'header', 'key' => 'title', 'value' => 'Our Mission', 'type' => 'text'],
            ['page' => 'our-mission', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/page-header-bg.jpg', 'type' => 'image'],

            // Mission Details section
            ['page' => 'our-mission', 'section' => 'mission', 'key' => 'title', 'value' => 'Our Mission', 'type' => 'text'],
            ['page' => 'our-mission', 'section' => 'mission', 'key' => 'content', 'value' => "Started as a student-run organisation, You’re wonderful project; works towards mental health awareness and accessibility. It tackles mental health-related issues and works towards removing the stigma around the same. The aim of the organisation is 4 fold which includes raising awareness, encouraging acceptance of mental health, promoting prevention and facilitating intervention. With a dedicated team of members from different walks of life, the organisation provides a forum for expression by individuals mainly through art, dialogues and articles that are research-oriented. YWP; is a 12A/80G/CSR certified, ITA registered trust.", 'type' => 'textarea'],
            ['page' => 'our-mission', 'section' => 'mission', 'key' => 'image1', 'value' => 'images/donation-details-content-img-1.jpg', 'type' => 'image'],
            ['page' => 'our-mission', 'section' => 'mission', 'key' => 'image2', 'value' => 'images/donation-details-content-img-2.jpg', 'type' => 'image'],
        ];

        foreach ($contents as $data) {
            PageContent::updateOrCreate(
                ['page' => $data['page'], 'section' => $data['section'], 'key' => $data['key']],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }
    }
}
