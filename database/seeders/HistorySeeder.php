<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
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
            ['page' => 'history', 'section' => 'header', 'key' => 'title', 'value' => 'History', 'type' => 'text'],
            ['page' => 'history', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/fundraishing-bg.jpg', 'type' => 'image'],

            // History Details section
            ['page' => 'history', 'section' => 'history', 'key' => 'title', 'value' => 'History', 'type' => 'text'],
            ['page' => 'history', 'section' => 'history', 'key' => 'content', 'value' => "You're Wonderful Project; started informally in 2014 as a student-run initiative by a few young minds who believed in forming a collective that helps each other through their mental health struggles. The Project eventually grew into a larger collective with people joining from across the country. In 2017 December, the organization was registered as an NGO under the Indian Trusts Act.", 'type' => 'textarea'],
            ['page' => 'history', 'section' => 'history', 'key' => 'image1', 'value' => 'images/his-1.jpg', 'type' => 'image'],
            ['page' => 'history', 'section' => 'history', 'key' => 'image2', 'value' => 'images/his-2.jpg', 'type' => 'image'],
        ];

        foreach ($contents as $data) {
            PageContent::updateOrCreate(
                ['page' => $data['page'], 'section' => $data['section'], 'key' => $data['key']],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }
    }
}
