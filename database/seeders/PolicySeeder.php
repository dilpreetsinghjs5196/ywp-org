<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            [
                'title' => 'Breaks and Sabbaticals|YWP;',
                'description' => null,
                'link' => 'https://drive.google.com/file/d/1jaaviNQrMLbNfR_hbks21NcAhkhUqwL6/view',
                'order' => 1,
            ],
            [
                'title' => 'Misconduct at Workplace_YWP',
                'description' => null,
                'link' => 'https://docs.google.com/document/d/1zga-vJEFOEOmtVBvJ1n80ZeC9XVqNbB_/edit',
                'order' => 2,
            ],
            [
                'title' => 'Exit Policy',
                'description' => null,
                'link' => 'https://docs.google.com/document/d/1pvs2L223__QZ2HsMEHzmTm4ALw7RCVedD8XfCss-T8Q/edit?usp=sharing',
                'order' => 3,
            ],
            [
                'title' => 'Transfer Policy',
                'description' => null,
                'link' => 'https://docs.google.com/document/d/1ir_1zsR0LZ_GIxqmFHeT3NUvYd-CFX5Q3YhPdbWo2Os/edit?usp=sharing',
                'order' => 4,
            ],
            [
                'title' => 'Break And Sabbaticals',
                'description' => null,
                'link' => 'https://docs.google.com/document/d/1byUl9R1mBhzxSqK9fcOLZG1rOsoQX3rS2wn-pEtv5L8/edit?usp=sharing',
                'order' => 5,
            ],
        ];

        foreach ($policies as $p) {
            Policy::create($p);
        }
    }
}
