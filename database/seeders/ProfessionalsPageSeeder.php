<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class ProfessionalsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            ['page' => 'on-board-professionals', 'section' => 'header', 'key' => 'title', 'value' => 'On-Board Professionals', 'type' => 'text'],
            ['page' => 'on-board-professionals', 'section' => 'header', 'key' => 'bg_image', 'value' => 'images/advisery.jpg', 'type' => 'image'],
        ];

        foreach ($contents as $data) {
            PageContent::updateOrCreate(
                ['page' => $data['page'], 'section' => $data['section'], 'key' => $data['key']],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }
    }
}
